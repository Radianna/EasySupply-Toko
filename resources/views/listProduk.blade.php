@extends('layout.main')
@section('content')
    <!-- Navbar -->
    <div class="bg-[#243642] p-4 flex items-center justify-between">
        <a href="{{ url('beranda') }}" class="text-white text-xl font-bold">←</a>
        <input type="text" placeholder="Cari produk di sini" class="w-full ml-4 py-2 px-4 rounded-lg bg-white text-gray-700 outline-none" />
    </div>

    <!-- Daftar Produk -->
    <div class="p-4 space-y-6" id="product-list">
    </div>
@endsection

@section('script')
<?php
$baseUrl = env('BASE_URL');
?>
<script>
    const baseUrl = "<?php echo $baseUrl; ?>";
    async function fetchProducts() {
        try {
            const response = await fetch(baseUrl + '/api/produk');
            const products = await response.json();
            let productHTML = '';
            products.forEach(product => {
                productHTML += `
                    <div class="bg-white rounded-lg shadow-md p-4 flex items-start">
                        <img src="${product.gambar}" alt="${product.name}" class="w-20 h-20 object-cover mr-4">
                        <div class="flex-1">
                            <h2 class="text-lg font-semibold">${product.name}</h2>
                            <p class="text-xl font-bold text-gray-800">Rp. ${product.harga.toLocaleString()}</p>
                            <div class="flex items-center mt-2">
                                <select class="border border-gray-300 rounded-lg text-sm p-2">
                                    <option>Pack</option>
                                    <option>Dus</option>
                                </select>
                                <div class="flex ml-2">
                                    <button onclick="decreaseQty(${product.id})" class="bg-gray-200 text-gray-700 px-2 mx-2">-</button>
                                    <input type="text" name="qty" value="0" id="qty-${product.id}" class="w-10 text-center border rounded">
                                    <button onclick="increaseQty(${product.id})" class="bg-gray-200 text-gray-700 px-2 mx-2">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });
    
            document.getElementById('product-list').innerHTML = productHTML;
        } catch (error) {
            console.error('Error fetching products:', error);
        }
    }
    
    function decreaseQty(id) {
        const qtyInput = document.getElementById(`qty-${id}`);
        let currentQty = parseInt(qtyInput.value);
        if (currentQty > 0) qtyInput.value = currentQty - 1;

        keranjang(id);
    }
    
    function increaseQty(id) {
        const qtyInput = document.getElementById(`qty-${id}`);
        let currentQty = parseInt(qtyInput.value);
        qtyInput.value = currentQty + 1;

        keranjang(id);
    }
    
    fetchProducts();
    </script>
    @endsection