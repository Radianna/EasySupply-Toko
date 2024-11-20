@extends('layout.main')
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
        <div class="bg-gray-100 rounded-lg p-4 mb-3 shadow flex justify-between items-center">
            <div>
                <div class="text-lg font-bold text-gray-800">IDR Rp 1.713.850</div>
                <div class="text-sm text-gray-500">AYO.241113114057.57186</div>
                <div class="text-sm text-gray-600">Rabu, 13 Nov 2024</div>
            </div>
            <a href="{{ url('detail-pesanan') }}" class="bg-[#008080] text-white px-4 py-2 rounded text-center text-sm">
                Lihat Pesanan
            </a>
        </div>

        <div class="bg-gray-100 rounded-lg p-4 mb-3 shadow flex justify-between items-center">
            <div>
                <div class="text-lg font-bold text-gray-800">IDR Rp 2.552.000</div>
                <div class="text-sm text-gray-500">Sedang Dikirim</div>
                <div class="text-sm text-gray-600">Rabu, 13 Nov 2024</div>
            </div>
            <div class="bg-[#008080] text-white px-4 py-2 rounded text-center text-sm">
                Lihat Pesanan
            </div>
        </div>

        <div class="bg-gray-100 rounded-lg p-4 mb-3 shadow flex justify-between items-center">
            <div>
                <div class="text-lg font-bold text-gray-800">IDR Rp 1.613.500</div>
                <div class="text-sm text-gray-500">Sedang Dikirim</div>
                <div class="text-sm text-gray-600">Rabu, 30 Okt 2024</div>
            </div>
            <div class="bg-[#008080] text-white px-4 py-2 rounded text-center text-sm">
                Lihat Pesanan
            </div>
        </div>

        <div class="bg-gray-100 rounded-lg p-4 mb-3 shadow flex justify-between items-center">
            <div>
                <div class="text-lg font-bold text-gray-800">IDR Rp 2.468.500</div>
                <div class="text-sm text-gray-500">Sedang Dikirim</div>
                <div class="text-sm text-gray-600">Rabu, 30 Okt 2024</div>
            </div>
            <div class="bg-[#008080] text-white px-4 py-2 rounded text-center text-sm">
                Lihat Pesanan
            </div>
        </div>

        <div class="bg-gray-100 rounded-lg p-4 mb-3 shadow flex justify-between items-center">
            <div>
                <div class="text-lg font-bold text-gray-800">IDR Rp 1.836.050</div>
                <div class="text-sm text-gray-500">Pesanan Selesai</div>
                <div class="text-sm text-gray-600">Rabu, 23 Okt 2024</div>
            </div>
            <div class="bg-[#008080] text-white px-4 py-2 rounded text-center text-sm">
                Lihat Pesanan
            </div>
        </div>
    </div>
@endsection
