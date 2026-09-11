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
            'data' => $cartItem,
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
        $user = $request->user();

        $cart = $user->cart;

        if (!$cart) {
            return response()->json([
                'message' => 'You dont have cart'
            ], 404);
        }

        $cartItem = CartItem::where('id', $id)->where('cart_id', $cart->id)->first();

        if (!$cartItem) {
            return response()->json([
                'message' => 'This Item does not exist'
            ], 404);
        }

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);


        $cartItem->update(['quantity'=>$validated['quantity']]);

        $cartItems = CartItem::where('cart_id', $cart->id)->with('product')->get();

        return response()->json([
            'message' => 'Item updated successfully',
            'data' => $cartItems
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {

        // Get the user making the request
        $user = $request->user();


        //get their cart id
        $cart = $user->cart;

        //if they dont have a cart return a message
        if (!$cart) {
            return response()->json([
                'message' => 'You dont have a cart',
            ], 404);
        }

        $cartItem = CartItem::where('id', $id)->where('cart_id', $cart->id)->first();

        if (!$cartItem) {
            return response()->json(['message' => 'Item not found in your cart'], 404);
        }

        $cartItem->delete();


        //return remaining cart items
        $cartItems = CartItem::where('cart_id', $cart->id)->with('product')->get();

        return response()->json([
            'message' => "Item deleted sucessfully",
            'data' => $cartItems
        ]);
    }
}
