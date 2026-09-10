<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Cart;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->user();


        $cart = $user->cart;

        if (!$cart) {
            $cart = Cart::firstOrCreate(['user_id' => $user->id]);
        }

        $validated = $request->validate([
            'product_id' => 'required|numeric|exists:products,id',
            'quantity' => 'nullable|integer|min:1'
        ]);


        $cartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $validated['product_id'])->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $validated['quantity'] ?? 1);
        } else {
            $cartItem = CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $validated['product_id'],
                'quantity' => $validated['quantity'] ?? 1,
            ]);
        }

        $cartItem->load('product');


        return response()->json([
            'message' => 'Item added to cart succesfully',
            'item' => $cartItem,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
