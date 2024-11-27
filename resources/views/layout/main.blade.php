<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- csrf token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EasySupply | @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
    #cart-container {
        transition: opacity 0.3s ease-in-out;
    }

    #cart-container.hidden {
        opacity: 0;
        visibility: hidden;
    }

    #cart-container:not(.hidden) {
        opacity: 1;
        visibility: visible;
    }

    #cart-items {
        max-height: 300px;
        overflow-y: auto;
    }
</style>

<body class="bg-[#F8F9FA]">
    <!-- Header -->
    <nav class="navbar bg-teal-700 p-2 flex items-center justify-between top-0 left-0 right-0 z-10">
        <!-- Nama Aplikasi -->
        <div class="flex items-center">
            <img src="{{ asset('image\logo-EasySupply.png') }}" alt="Logo" class="w-12 mr-1">
            <div class="text-white text-xl font-bold">EasySupply</div>
        </div>

        <!-- Bagian Profil -->
        <div class="relative mr-1 mt-1">
            <button id="profileButton" class="focus:outline-none">
                <img src="{{ asset('image/person.png') }}" alt="Profile"
                    class="w-10 h-10 rounded-full border-2 border-white">
            </button>
            <!-- Dropdown Menu -->
            <div id="profileMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg z-30">
                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Profile</a>
                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Settings</a>
                <button id="logoutButton" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Logout</button>
            </div>
        </div>
    </nav>

    <!-- Search & Partner Info -->
    <div id="search"
        class="mb-5 px-6 py-2 bg-white flex justify-between shadow items-center top-16 left-0 right-0 z-20">
        <input type="text" placeholder="Mau Belanja apa hari ini?" class="p-2 border border-gray-300 rounded w-full">
    </div>

    <!-- Keranjang -->
    <div id="cart-container" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden z-50">
        <div class="absolute inset-x-0 bottom-0 bg-white rounded-t-lg shadow-lg p-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Keranjang Anda</h2>
                <button onclick="closeCart()" class="text-red-500 text-lg font-bold">✖</button>
            </div>

            <!-- Daftar Item di Keranjang -->
            <div id="cart-items" class="space-y-4">
                <!-- Contoh item -->
                <!-- Diisi dinamis oleh JavaScript -->
            </div>

            <!-- Total Harga -->
            <div class="border-t pt-4 mt-4">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-semibold">Total:</span>
                    <span id="cart-total" class="text-lg font-bold text-teal-500">Rp. 0</span>
                </div>
            </div>

            <!-- Tombol Checkout -->
            <div class="mt-4">
                <button onclick="checkout()"
                    class="w-full bg-teal-700 text-white py-2 px-4 rounded-lg font-bold shadow-lg hover:bg-teal-900">
                    Lanjutkan ke Pembayaran
                </button>
            </div>
        </div>
    </div>


    @yield('content')

    <!-- Chat Button -->
    <div id="keranjang"></div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let cart = []; // Keranjang diinisialisasi sebagai array kosong
        const apiUrl = "<?php echo env('API_URL'); ?>";

        // Helper untuk menemukan item di keranjang
        function findCartItemById(mappingId) {
            return cart.find(item => item.id == mappingId);
        }

        // Fetch data keranjang
        async function fetchCart() {
            try {
                const response = await $.ajax({
                    url: `{{ route('getCart') }}`,
                    method: 'GET',
                    dataType: 'json',
                });

                cart = Array.isArray(response.cart) ? response.cart : [];
                updateCartView(response.totalPesanan || 0);
            } catch (error) {
                console.error('Error fetching cart:', error);
                cart = [];
            }
        }

        async function fetchProducts() {
            try {
                await fetchCart(); // Pastikan data keranjang sudah diambil.

                const response = await fetch(`${apiUrl}/api/get-list-produk`, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('token')}`
                    }
                });

                if (!response.ok) throw new Error("Failed to fetch product data");

                const products = await response.json();
                const imageUrls = products.map(product => product.gambar); // Ambil path gambar
                await fetchImagesInBatch(imageUrls); // Fetch batch image

                renderProductList(products); // Render daftar produk
            } catch (error) {
                console.error('Error fetching products:', error);
            }
        }

        async function fetchImagesInBatch(filePaths, batchSize = 10) {
            if (!Array.isArray(filePaths) || filePaths.length === 0) {
                console.error("Invalid file paths provided.");
                return;
            }

            // Bagi filePaths ke dalam batch
            const batches = [];
            for (let i = 0; i < filePaths.length; i += batchSize) {
                batches.push(filePaths.slice(i, i + batchSize));
            }

            for (const batch of batches) {
                try {
                    const response = await fetch(`${apiUrl}/api/get-batch-image-produk`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': `Bearer ${localStorage.getItem('token')}`
                        },
                        body: JSON.stringify({
                            file_paths: batch
                        })
                    });

                    if (!response.ok) throw new Error(`Batch fetch failed: ${response.statusText}`);

                    const images = await response.json();
                    images.forEach(image => {
                        if (image.path) {
                            // Cache hasil ke localStorage
                            localStorage.setItem(image.filename, image.path);
                        } else if (image.error) {
                            console.warn(`Error for file ${image.filename}: ${image.error}`);
                        }
                    });
                } catch (error) {
                    console.error('Batch fetch error:', error);
                }
            }
            console.log('All batches processed.');
        }



        // Render daftar produk ke UI
        function renderProductList(products) {
            const productContainer = document.getElementById('product-list');
            let productHTML = '';

            products.forEach(product => {
                // kondisi jika gambar sudah ada didalam storage/produk
                // maka tidak perlu lagi fetch
                const defaultUnit = product.units[0];
                const cartItem = findCartItemById(defaultUnit.id);
                const quantity = cartItem ? cartItem.quantity : 0;

                productHTML += `
            <div class="bg-white rounded-lg shadow-md p-4 flex items-start mb-4">
                <img src="{{ asset('storage/produk') }}/${product.gambar}" alt="${product.name}" class="w-20 h-20 object-cover mr-4">
                <div class="flex-1">
                    <h2 class="text-lg font-semibold">${product.name}</h2>
                    <p class="text-xl font-bold text-gray-800" id="harga-${product.id}">
                        Rp. ${defaultUnit.harga.toLocaleString()}
                    </p>
                    <div class="flex items-center mt-2">
                        <select class="border border-gray-300 rounded-lg text-sm p-2" onchange="updateHarga(${product.id}, this)">
                            ${product.units.map(unit => `
                                                <option value="${unit.harga}" data-mapping-id="${unit.id}" 
                                                    ${unit.id === defaultUnit.id ? 'selected' : ''}>
                                                    ${unit.unit_name}
                                                </option>
                                            `).join('')}
                        </select>
                        <div class="flex ml-2">
                            <button onclick="decreaseQty(${product.id})" class="bg-gray-200 text-gray-700 px-2 mx-2">-</button>
                            <input onchange="inputQty(${product.id})" type="text" name="qty" value="${quantity}" 
                                id="qty-${product.id}" class="w-10 text-center border rounded">
                            <button onclick="increaseQty(${product.id})" class="bg-gray-200 text-gray-700 px-2 mx-2">+</button>
                        </div>
                    </div>
                </div>
            </div>
            `;
            });

            productContainer.innerHTML = productHTML;
        }

        // Update harga berdasarkan unit yang dipilih
        function updateHarga(productId, selectElement) {
            const selectedHarga = parseInt(selectElement.value);
            const hargaElement = document.getElementById(`harga-${productId}`);
            const qtyInput = document.getElementById(`qty-${productId}`);

            if (hargaElement && qtyInput) {
                hargaElement.textContent = `Rp. ${selectedHarga.toLocaleString()}`;
                const mappingId = selectElement.selectedOptions[0].getAttribute('data-mapping-id');
                const cartItem = findCartItemById(mappingId);

                qtyInput.value = cartItem ? cartItem.quantity : 0;
            }
        }
        // Input jumlah produk secara manual
        function inputQty(productId) {
            const qtyInput = document.getElementById(`qty-${productId}`);
            const selectedUnit = document.querySelector(`select[onchange="updateHarga(${productId}, this)"]`)
                .selectedOptions[0];
            const mappingId = selectedUnit.getAttribute('data-mapping-id');

            if (qtyInput && mappingId) {
                let qty = parseInt(qtyInput.value);
                if (isNaN(qty) || qty < 1) qty = 1; // Set minimal kuantitas ke 1
                qtyInput.value = qty;
                addToCart(mappingId, qty);
            }
        }

        // Kurangi jumlah produk
        function decreaseQty(productId) {
            const qtyInput = document.getElementById(`qty-${productId}`);
            if (qtyInput) {
                const currentQty = parseInt(qtyInput.value) || 0;
                if (currentQty > 0) {
                    qtyInput.value = currentQty - 1;
                    inputQty(productId);
                }
            }
        }

        // Tambah jumlah produk
        function increaseQty(productId) {
            const qtyInput = document.getElementById(`qty-${productId}`);
            if (qtyInput) {
                const currentQty = parseInt(qtyInput.value) || 0;
                qtyInput.value = currentQty + 1;
                inputQty(productId);
            }
        }

        // Tambahkan produk ke keranjang
        async function addToCart(id, quantity) {
            if (isNaN(quantity)) {
                console.error("Invalid quantity");
                return;
            }

            try {
                const token = localStorage.getItem('token');
                const response = await $.ajax({
                    url: `{{ route('addToCart') }}`,
                    method: 'POST',
                    data: {
                        id,
                        quantity,
                        token,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                });

                if (response.success) {
                    console.log("Product added to cart:", response);
                    await fetchCart(); // Refresh data keranjang
                } else {
                    console.warn(response.message);
                }
            } catch (error) {
                console.error("Error adding to cart:", error);
            }
        }

        // Update tampilan jumlah keranjang
        function updateCartView(totalPesanan) {
            const cartElement = document.getElementById('keranjang');
            if (totalPesanan > 0) {
                cartElement.innerHTML = `
            <div id="keranjang" class="fixed bottom-0 left-0 right-0 flex justify-center bg-white z-20">
                <button onclick="openCart()"
                    class="bg-teal-700 text-white py-2 px-6 my-2 mx-4 w-full rounded shadow-lg">
                    Keranjang | ${totalPesanan} Pesanan
                </button>
            </div>
            `;
            } else {
                cartElement.innerHTML = '';
            }
        }

        // Muat data saat halaman selesai di-load
        document.addEventListener('DOMContentLoaded', () => {
            fetchProducts();
        });


        // Fungsi untuk membuka keranjang
        function openCart() {
            document.getElementById('cart-container').classList.remove('hidden');
            renderCart();
        }

        // Fungsi untuk menutup keranjang
        function closeCart() {
            document.getElementById('cart-container').classList.add('hidden');
        }

        // Fungsi untuk merender item di keranjang
        function renderCart() {
            const cartItemsContainer = document.getElementById('cart-items');
            const cartTotalElement = document.getElementById('cart-total');
            cartItemsContainer.innerHTML = ''; // Kosongkan keranjang

            let total = 0;
            console.log("Cart:", cart);


            cart.forEach(item => {
                const itemHTML = `
                <div class="flex items-center justify-between border-b pb-2">
                    <div>
                        <p class="text-sm font-semibold">${item.name}</p>
                        <p class="text-xs text-gray-500">Unit: ${item.unit}</p>
                    </div>
                    <div class="flex items-center">
                        <button onclick="decreaseCartQty(${item.id})"
                            class="bg-gray-200 text-gray-700 px-2 mx-1 rounded">-</button>
                        <span class="w-8 text-center">${item.quantity}</span>
                        <button onclick="increaseCartQty(${item.id})"
                            class="bg-gray-200 text-gray-700 px-2 mx-1 rounded">+</button>
                    </div>
                    <div class="flex items-center">
                        <span class="text-sm font-bold text-gray-700 mr-4">
                            Rp. ${(item.harga * item.quantity).toLocaleString()}
                        </span>
                        <button onclick="removeCartItem(${item.id})" 
                            class="text-red-500 text-lg font-bold">✖</button>
                    </div>
                </div>`;

                cartItemsContainer.innerHTML += itemHTML;
                total += item.harga * item.quantity;
            });

            cartTotalElement.textContent = `Rp. ${total.toLocaleString()}`;
        }

        async function removeCartItem(id) {
            try {
                const response = await $.ajax({
                    url: `{{ route('removeFromCart') }}`,
                    method: 'POST',
                    data: {
                        id,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                });

                if (response.success) {
                    console.log("Item removed from cart:", response);
                    await fetchCart(); // Refresh data keranjang
                } else {
                    console.warn(response.message);
                }
            } catch (error) {
                console.error("Error removing item from cart:", error);
            }
        }

        // check out
        async function checkout() {
            if (cart.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Keranjang kosong!',
                    text: 'Silakan tambahkan produk ke keranjang sebelum checkout.',
                });
                return;
            }

            const id = localStorage.getItem('id');
            const token = localStorage.getItem('token');

            if (!id || !token) {
                Swal.fire({
                    icon: 'error',
                    title: 'ID atau Token tidak valid',
                    text: 'Silakan login ulang.',
                });
                return;
            }

            try {
                const response = await $.ajax({
                    url: `{{ route('checkout') }}`,
                    method: 'POST',
                    data: {
                        id,
                        token,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    }
                });
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Checkout berhasil!',
                        text: 'Pesanan Anda telah diproses.',
                    });
                    fetchProducts();
                    closeCart();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: response.message || 'Terjadi kesalahan saat checkout.',
                    });
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi kesalahan',
                    text: 'Silakan coba lagi nanti.',
                });
                console.error("Checkout failed:", error);
            }
        }

        const profileButton = document.getElementById('profileButton');
        const profileMenu = document.getElementById('profileMenu');

        profileButton.addEventListener('click', () => {
            profileMenu.classList.toggle('hidden');
        });

        // Menutup dropdown saat klik di luar menu
        window.addEventListener('click', (e) => {
            if (!profileButton.contains(e.target) && !profileMenu.contains(e.target)) {
                profileMenu.classList.add('hidden');
            }
        });
    </script>
    {{-- check token --}}
    <script>
        document.getElementById('logoutButton').addEventListener('click', async () => {
            try {
                await axios.post(`${apiUrl}/api/logout`, {}, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('token')}`
                    }
                });
            } catch (error) {
                console.error('Logout failed on server:', error);
            } finally {
                localStorage.removeItem('token'); // Hapus token lokal
                window.location.href = '/';
            }
        });

        const token = localStorage.getItem('token');
        if (!token) {
            window.location.href = '/';
        }

        // // Fetch data protected by token
        // axios.get(`${apiUrl}/api/protected-data`, {
        //     headers: {
        //         'Authorization': `Bearer ${localStorage.getItem('token')}`
        //     }
        // }).then(response => {
        //     console.log(response.data);
        // }).catch(error => {
        //     window.location.href = '/';
        // });
    </script>

    @yield('script')
</body>

</html>
