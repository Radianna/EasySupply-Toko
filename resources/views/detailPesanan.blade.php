@extends('layout.main')
@section('content')
    <!-- Container Utama -->
    <div class="px-6 mt-4">
        <!-- Header -->
        <div class="flex items-center justify-between border-b pb-4 mb-4">
            <a href="{{ url('beranda') }}" class="text-2xl text-gray-600 font-bold">&larr;</a>
            <h2 class="text-lg font-semibold text-[#387478]">Detail Transaksi</h2>
        </div>

        <!-- Nomor Order -->
        <div class="flex items-center justify-between mb-4">
            <div class="text-gray-600">No. Order</div>
            <div class="flex items-center gap-2">
                <span class="font-semibold text-gray-800">AYO.241113114057.57186</span>
                <button class="text-red-500 text-lg">&#x1F4CB;</button>
            </div>
        </div>

        <!-- Status Tracking -->
        <div class="space-y-4">
            <!-- Status Item 1 -->
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-5 h-5 flex items-center justify-center bg-[#387478] rounded-full text-white text-sm">
                        &#10003;</div>
                    <span class="text-gray-700">Pesanan Baru</span>
                </div>
                <div class="text-gray-500 text-sm text-right">
                    13 <br> 11:40
                </div>
            </div>

            <!-- Status Item 2 -->
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-5 h-5 flex items-center justify-center bg-[#387478] rounded-full text-white text-sm">
                        &#10003;</div>
                    <span class="text-gray-700">Pesanan Disetujui</span>
                </div>
                <div class="text-gray-500 text-sm text-right">
                    13 <br> 11:45
                </div>
            </div>

            <!-- Status Item 3 -->
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-5 h-5 flex items-center justify-center bg-[#387478] rounded-full text-white text-sm">
                        &#10003;</div>
                    <span class="text-gray-700">Pesanan Dikirim</span>
                </div>
                <div class="text-gray-500 text-sm text-right">
                    13 <br> 2:31 siang
                </div>
            </div>

            <!-- Status Item 4 (Belum Selesai) -->
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-5 h-5 flex items-center justify-center bg-gray-300 rounded-full text-white text-sm">•
                    </div>
                    <span class="text-gray-400">Pesanan Selesai</span>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="mt-8 space-y-3">
            <button class="w-full py-2 bg-gray-300 text-gray-600 rounded-md font-semibold">BATALKAN</button>
        </div>

        <!-- Metode Pengiriman -->
        <div class="flex items-center justify-between mt-8 py-4 border-t">
            <span class="font-semibold text-gray-800">Metode Pengiriman</span>
            <span class="text-gray-600">Diambil</span>
        </div>

        <!-- Alamat & Chat -->
        <div class="mt-4">
            <div class="flex items-center gap-2 text-gray-700">
                <span class="text-red-500">&#x1F4CD;</span>
                <span>Alamat</span>
            </div>
        </div>

        <!-- Daftar Produk -->
        <div class="space-y-4 bg-white p-4 rounded-b-lg shadow-lg mt-4">
            <!-- Produk Item -->
            <div class="flex items-start space-x-4 border-b pb-4">
                <img src="https://via.placeholder.com/80" alt="Produk" class="w-20 h-20 object-cover rounded-lg">
                <div class="flex-1">
                    <h2 class="text-gray-800 font-semibold">magnum hitam 12</h2>
                    <p class="text-sm text-gray-500">Dji Sam Soe Magnum Filter 12</p>
                    <p class="text-red-500 font-bold">Rp 243.000</p>
                </div>
                <div class="text-gray-500 text-sm text-right">1 X PRES</div>
            </div>

            <!-- Produk Item 2 -->
            <div class="flex items-start space-x-4 border-b pb-4">
                <img src="https://via.placeholder.com/80" alt="Produk" class="w-20 h-20 object-cover rounded-lg">
                <div class="flex-1">
                    <h2 class="text-gray-800 font-semibold">TALIROSO SEJATI</h2>
                    <p class="text-red-500 font-bold">Rp 73.000</p>
                </div>
                <div class="text-gray-500 text-sm text-right">1 X PRES</div>
            </div>

            <!-- Produk Item 3 -->
            <div class="flex items-start space-x-4 border-b pb-4">
                <img src="https://via.placeholder.com/80" alt="Produk" class="w-20 h-20 object-cover rounded-lg">
                <div class="flex-1">
                    <h2 class="text-gray-800 font-semibold">Djarum 76 12</h2>
                    <p class="text-red-500 font-bold">Rp 146.000</p>
                </div>
                <div class="text-gray-500 text-sm text-right">1 X PRES</div>
            </div>

            <!-- Produk Item 4 -->
            <div class="flex items-start space-x-4">
                <img src="https://via.placeholder.com/80" alt="Produk" class="w-20 h-20 object-cover rounded-lg">
                <div class="flex-1">
                    <h2 class="text-gray-800 font-semibold">Sampoerna Hijau Limited Ed 12</h2>
                    <p class="text-red-500 font-bold">Rp 145.000</p>
                </div>
                <div class="text-gray-500 text-sm text-right">1 X PRES</div>
            </div>
        </div>

        <!-- Subtotal dan Total Pesanan -->
        <div class="mt-6 bg-white p-4 rounded-lg shadow-lg space-y-2">
            <div class="flex justify-between">
                <span class="text-gray-500">Subtotal</span>
                <span class="font-bold">Rp 1.713.850</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Total Pesanan</span>
                <span class="font-bold">Rp 1.713.850</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Total Poin</span>
                <span class="font-bold">6</span>
            </div>
        </div>

        <!-- Metode Pembayaran -->
        <div class="mt-4 bg-white p-4 rounded-lg shadow-lg flex justify-between items-center mb-16">
            <span class="text-gray-800 font-semibold">Metode Pembayaran</span>
            <button class="text-gray-500">Bayar Di Tempat</button>
        </div>

        <!-- Chat Button -->
        <div class="fixed bottom-4 left-0 right-0 flex justify-center">
            <button class="bg-red-500 text-white py-2 px-6 rounded-full shadow-lg">Chat Agen</button>
        </div>
    </div>
@endsection
