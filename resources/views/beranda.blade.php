@extends('layout.main')

@section('title', 'Beranda')

@section('style')
    <style>
        .material-icons {
            font-size: 1rem;
            vertical-align: middle;
        }
    </style>
@endsection
@section('content')
    {{-- <!-- Menu Bar -->
    <div class="flex bg-white shadow justify-around py-4 px-4">
        <div class="text-center">
            <div class="relative">
                <span class="absolute top-0 right-0 bg-red-600 text-white text-xs rounded-full px-2">5</span>
                <img src="https://img.icons8.com/ios-glyphs/30/000000/shopping-bag.png" alt="Pesanan">
            </div>
            <div>Pesanan</div>
        </div>
        <div class="text-center">
            <img src="https://img.icons8.com/ios-glyphs/30/000000/coin.png" alt="Poin">
            <div>Poin: 284</div>
        </div>
        <div class="text-center">
            <img src="https://img.icons8.com/ios-glyphs/30/000000/discount.png" alt="Voucher">
            <div>Voucher: 0</div>
        </div>
    </div>
 --}}
    <!-- Category Section -->
    <div class="bg-white shadow mt-4 px-6 py-4 grid grid-cols-4 md:grid-cols-6 gap-4 ">
        <a href="{{ url('list-produk') }}" class="text-center">
            <img class="mx-auto border-4 rounded-md border-[#008080]" src="{{ asset('image/makanan.png') }}" alt="Makanan">
            <div class="mt-2 text-sm text-[#333333]">MAKANAN</div>
        </a>
        <div class="text-center">
            <img class="mx-auto border-4 rounded-md border-[#008080]" src="{{ asset('image/minuman.png') }}" alt="Minuman">
            <div class="mt-2 text-sm text-[#333333]">MINUMAN</div>
        </div>
        <div class="text-center">
            <img class="mx-auto border-4 rounded-md border-[#008080]" src="{{ asset('image/perabotan.png') }}"
                alt="Perabotan">
            <div class="mt-2 text-sm text-[#333333]">PERABOTAN</div>
        </div>
        <div class="text-center">
            <img class="mx-auto border-4 rounded-md border-[#008080]" src="{{ asset('image/lain-lain.png') }}"
                alt="Lain Lain">
            <div class="mt-2 text-sm text-[#333333]">LAIN LAIN</div>
        </div>
    </div>

    <!-- Products Section -->
    <div class="bg-[#E0E0E0] mt-4 px-6 py-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-[#333333]">Pesan Lagi</h2>
            <a href="#" class="text-[#008080] hover:text-[#FF6347]">Lihat Semua</a>
        </div>
        <!-- Horizontal Scroll Container -->
        <div class="flex overflow-x-auto space-x-4 pb-4">
            <div class="bg-[#FFFFFF] rounded-lg shadow-lg p-4 min-w-[200px] max-w-[200px] flex flex-col justify-between">
                <img src="{{ asset('image/tolak-angin.png') }}" alt="Produk" class="w-full h-32 object-cover rounded">
                <h3 class="mt-2 font-semibold text-gray-800 overflow-hidden text-ellipsis"
                    style="height: 4.5rem; line-height: 1.5rem; white-space: normal;">
                    Tolak Angin Cair Extra Herbal
                </h3>
                <p class="text-red-600 font-bold mt-2">Rp. 2.000</p>
                <div class="flex items-center mt-2">
                    <select class="border border-gray-300 text-sm rounded p-1 mr-2">
                        <option>pcs</option>
                        <option>dus</option>
                    </select>
                    <div class="flex items-center border rounded">
                        <button class="px-2 py-1 bg-[#008080] text-white">-</button>
                        <input type="number" value="0" class="w-10 text-center border-l border-r outline-none" />
                        <button class="px-2 py-1 bg-[#008080] text-white">+</button>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-4 min-w-[200px] max-w-[200px] flex flex-col justify-between">
                <img src="{{ asset('image/air-mineral.png') }}" alt="Produk" class="w-full h-32 object-cover rounded">
                <h3 class="mt-2 font-semibold text-gray-800 overflow-hidden text-ellipsis"
                    style="height: 4.5rem; line-height: 1.5rem; white-space: normal;">
                    Le Mineral
                </h3>
                <p class="text-red-600 font-bold mt-2">Rp. 3.000</p>
                <div class="flex items-center mt-2">
                    <select class="border border-gray-300 text-sm rounded p-1 mr-2">
                        <option>pcs</option>
                        <option>dus</option>
                    </select>
                    <div class="flex items-center border rounded">
                        <button class="px-2 py-1 bg-[#008080] text-white">-</button>
                        <input type="number" value="0" class="w-10 text-center border-l border-r outline-none" />
                        <button class="px-2 py-1 bg-[#008080] text-white">+</button>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-4 min-w-[200px] max-w-[200px] flex flex-col justify-between">
                <img src="{{ asset('image/tolak-angin.png') }}" alt="Produk" class="w-full h-32 object-cover rounded">
                <h3 class="mt-2 font-semibold text-gray-800 overflow-hidden text-ellipsis"
                    style="height: 4.5rem; line-height: 1.5rem; white-space: normal;">
                    Tolak Angin Cair Extra Herbal
                </h3>
                <p class="text-red-600 font-bold mt-2">Rp. 10.000</p>
                <div class="flex items-center mt-2">
                    <select class="border border-gray-300 text-sm rounded p-1 mr-2">
                        <option>pcs</option>
                        <option>dus</option>
                    </select>
                    <div class="flex items-center border rounded">
                        <button class="px-2 py-1 bg-[#008080] text-white">-</button>
                        <input type="number" value="0" class="w-10 text-center border-l border-r outline-none" />
                        <button class="px-2 py-1 bg-[#008080] text-white">+</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="p-4">
        <!-- Header Pesanan -->
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold">Pesanan Saya</h3>
            <a href="#" class="text-[#008080] hover:text-[#FF6347]">Lihat Semuanya &gt;&gt;</a>
        </div>

        <!-- Card Pesanan -->
        <div id="order-list"></div>
    </div>

    <div id="order-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
        <div class="bg-white rounded-lg w-full max-w-md p-6">
            <h3 class="text-lg font-bold mb-4">Detail Pesanan</h3>
            <p class="text-sm text-gray-600">Tanggal Pesanan: 27 November 2024</p>
            <p class="text-sm text-gray-600">Status: Menunggu Konfirmasi</p>
            <p class="text-sm text-gray-600">Total Harga: Rp 21.500</p>
            <button onclick="closeModalPesanan()" class="mt-4 bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded">
                Tutup
            </button>
        </div>
    </div>

@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            fetchOrders();
        });

        // Fetch pesanan
        async function fetchOrders() {
            try {
                const response = await fetch(`${apiUrl}/api/get-list-pesanan/${localStorage.getItem('id')}`, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('token')}`
                    }
                });

                // Pastikan response diparsing ke JSON
                const result = await response.json();

                if (result.status === 'success') {
                    const orders = result.data; // Ambil data pesanan
                    console.log(orders);
                    renderOrderList(orders);
                } else {
                    console.warn(result.message);
                }
            } catch (error) {
                console.error("Error fetching orders:", error);
            }
        }

        // Render daftar pesanan
        function renderOrderList(orders) {
            const orderList = document.getElementById('order-list');
            let pesananHTML = '';

            orders.forEach(order => {
                // filter data berdasarkan id pesanan untuk menampilkan data yang sesuai
                const filteredOrder = orderList.filter(orderList => orderList.id === order.id);
                pesananHTML += `
                    <div class="bg-white rounded-lg p-4 mb-3 shadow-lg flex justify-between items-start">
                        <!-- Informasi Pesanan -->
                        <div>
                            <div class="text-2xl font-bold text-gray-900 mb-2">Rp ${order.total_harga.toLocaleString('id-ID')}</div>
                            <div class="flex items-center text-sm text-gray-500 mb-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 16l-4-4m0 0l4-4m-4 4h16" />
                                </svg>
                                <span>${order.status_pesanan}</span>
                            </div>
                            <div class="text-sm text-gray-600">
                                ${new Date(order.tanggal_pesanan).toLocaleDateString('id-ID', {
                                        year: 'numeric', month: 'long', day: 'numeric'
                                    })}</div>
                        </div>
                        <!-- Tombol -->
                        <button onclick="openDetailPesanan(${filteredOrder})"
                            class="bg-teal-500 hover:bg-teal-600 text-white px-6 py-2 rounded-lg shadow transition transform hover:scale-105">
                            Detail>>
                        </button>
                    </div>
                `;
            });

            orderList.innerHTML = pesananHTML; // Tambahkan ke elemen HTML
        }

        function openDetailPesanan($data) {
            window.location.href = `/detail-pesanan/${$data[0].id}`
        }
    </script>
@endsection
