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
                <span id="cart-total" class="text-lg font-bold text-green-500">Rp. 0</span>
            </div>
        </div>

        <!-- Tombol Checkout -->
        <div class="mt-4">
            <button onclick="checkout()"
                class="w-full bg-green-500 text-white py-2 px-4 rounded-lg font-bold shadow-lg hover:bg-green-600">
                Lanjutkan ke Pembayaran
            </button>
        </div>
    </div>
</div>
