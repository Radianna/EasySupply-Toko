<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = env('API_URL');
    }

    public function addToCart(Request $request)
    {
        $produkId = $request->input('id');
        $quantity = $request->input('quantity');
        $token = $request->input('token');

        // Ambil keranjang dari session atau buat array kosong
        $cart = session()->get('cart', []);

        if ($quantity == 0) {
            // Hapus produk dari keranjang jika quantity adalah 0
            $cart = array_filter($cart, function ($item) use ($produkId) {
                return $item['id'] != $produkId;
            });

            // Simpan keranjang kembali ke session
            session()->put('cart', $cart);

            $totalQuantity = array_sum(array_column($cart, 'quantity'));

            return response()->json([
                'success' => true,
                'message' => 'Product removed from cart successfully',
                'totalQuantity' => $totalQuantity,
                'cart' => $cart,
            ]);
        }

        // Mengambil data produk dari API berdasarkan produk ID
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($this->apiUrl . '/api/get-data-produk' . '/' . $produkId);

        if ($response->successful()) {
            $productData = $response->json();

            // Pastikan data yang dikembalikan adalah array dan ambil item pertama
            $product = is_array($productData) ? $productData[0] : $productData;

            // Membuat item keranjang
            $cartItem = [
                'id' => $product['id'],
                'gambar' => $product['gambar'],
                'name' => $product['name'],
                'quantity' => $quantity,
                'harga' => $product['harga'],
                'unit' => $product['unit'],
            ];

            // Cari produk berdasarkan ID menggunakan array_search
            $index = array_search($produkId, array_column($cart, 'id'));

            if ($index !== false) {
                // Jika produk sudah ada di keranjang, tambahkan quantity
                $cart[$index]['quantity'] = $quantity;
            } else {
                // Jika produk belum ada, tambahkan sebagai item baru
                $cart[] = $cartItem;
            }

            // Simpan keranjang kembali ke session
            session()->put('cart', $cart);

            $totalQuantity = array_sum(array_column($cart, 'quantity'));

            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully',
                'totalQuantity' => $totalQuantity,
                'cart' => $cart,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Product not found or unable to fetch details',
            ], 404);
        }
    }

    public function getCart(Request $request)
    {
        // session()->forget('cart');
        $cart = session()->get('cart', []);

        //hitung total quantity
        $totalQuantity = 0;
        foreach ($cart as $item) {
            $totalQuantity += $item['quantity'];
        }

        return response()->json([
            'cart' => $cart,
            'totalPesanan' => $totalQuantity
        ]);
    }

    public function removeFromCart(Request $request, $produkId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$produkId])) {
            unset($cart[$produkId]);
            session()->put('cart', $cart);

            return response()->json([
                'success' => true,
                'message' => 'Product removed from cart successfully',
                'cart' => $cart,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Product not found in cart',
        ], 404);
    }

    public function checkout(Request $request)
    {
        try {
            $validated = $request->validate([
                'id' => 'required|numeric',
                'token' => 'required|string',
            ]);

            $user_id = $validated['id'];
            $token = $validated['token'];

            $cart = session()->get('cart', []);
            if (empty($cart)) {
                return redirect()->route('list-produk')->withErrors(['message' => 'Keranjang kosong!']);
            }

            $totalQuantity = array_sum(array_column($cart, 'quantity'));
            $totalPrice = array_sum(array_column($cart, 'harga'));

            $pesanan = [
                'user_id' => $user_id,
                'detail_pesanan' => $cart,
                'totalPesanan' => $totalQuantity,
                'totalHarga' => $totalPrice,
            ];

            $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token])
                ->post($this->apiUrl . '/api/checkout', $pesanan);

            if ($response->successful()) {
                session()->forget('cart');
                return response()->json([
                    'status' => 'success',
                    'message' => 'Checkout berhasil!',
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Checkout gagal. Silakan coba lagi.',
                ]);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
