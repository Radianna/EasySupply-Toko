<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{
    private $baseUrl;

    public function __construct() {
        $this->baseUrl = env('BASE_URL') . '/api/produk/';
    }

    public function addToCart(Request $request) {
        $request->validate([
            'id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        $produkId = $request->input('id');
        $quantity = $request->input('quantity');

        $response = Http::get($this->baseUrl . $produkId);

        if ($response->successful()) {
            $product = $response->json();

            $cartItem = [
                'id' => $product['id'],
                'gambar' => $product['gambar'],
                'name' => $product['name'],
                'quantity' => $quantity,
                'price' => $product['harga'],
                'image' => $product['gambar'],
            ];

            $cart = session()->get('cart', []);

            if (isset($cart[$produkId])) {
                $cart[$produkId]['quantity'] += $quantity;
            } else {
                $cart[$produkId] = $cartItem;
            }

            session()->put('cart', $cart);

            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully',
                'quantity' => $quantity,
                'cart' => $cart,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Product not found or unable to fetch details',
            ], 404);
        }
    }

    public function viewCart(Request $request) {
        $cart = session()->get('cart', []);

        return response()->json([
            'success' => true,
            'cart' => $cart,
        ]);
    }

    public function removeFromCart(Request $request, $produkId) {
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
}