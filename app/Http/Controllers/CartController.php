<?php
namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $carts = Cart::filter()->sort()->get()->paginate(10);
        return response()->json($carts);
    }

    public function store(CartRequest $request)
    {
        $cart = Cart::create($request->validated());
        return response()->json($cart, 201);
    }

    public function show(Cart $cart)
    {
        return response()->json($cart->load('product', 'user'));
    }

    public function update(CartRequest $request, Cart $cart)
    {
        $cart->update($request->validated());
        return response()->json($cart);
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return response()->json(['message' => 'Cart item deleted successfully']);
    }
}
