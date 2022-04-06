<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\CartHistoryDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function showCart()
    {
        $cart = $this->getUserCart();

        $cart_details = CartDetail::where('cart_id','=',$cart->id)->get();

        $total = 0;

        return view('member.cart', compact('cart_details','total'));
    }

    public function addCartDetail(Request $request)
    {   
        $this->validateCart($request);

        $cart = $this->getUserCart();

        $cart_detail = CartDetail::where('product_id','=',$request->id)
                                ->where('cart_id','=',$cart->id)
                                ->first();

        if($cart_detail)
        {
            return $this->updateCartDetail($request, $cart_detail);
        }

        $cart_detail = new CartDetail();
        $cart_detail->cart_id = $cart->id;
        $cart_detail->product_id = $request->id;
        $cart_detail->quantity = $request->qty;
        $cart_detail->save();

        return redirect()->back()->with('message', 'Product added to cart.');
    }

    public function showEditCartDetail($id)
    {
        $detail = CartDetail::where('id','=',$id)->first();
        return view('member.cart_detail', compact('detail'));
    }

    public function updateCartDetail(Request $request, $cart_detail)
    {
        $cart_detail->quantity = $request->qty;
        $cart_detail->save();

        return redirect()->back()->with('message', 'Updated product quantity.');
    }

    public function deleteCartDetail(Request $request)
    {
        CartDetail::where('id','=',$request->id)->first()->delete();
        return redirect()->back();
    }

    public function checkOut(Request $request)
    {
        $cart = $this->getUserCart();

        $cart_details = CartDetail::where('cart_id','=',$cart->id)->get();

        $total = 0;
        
        foreach ($cart_details as $detail)
        {
            $history = new CartHistoryDetail();
            $history->cart_id = $cart->id;
            $history->name = $detail->product->name;
            $history->price = $detail->product->price;
            $history->image_path = $detail->product->image_path;
            $history->quantity = $detail->quantity;
            $history->subtotal = $detail->quantity * $detail->product->price;
            $history->save();

            $total += $history->subtotal;
            $detail->delete();
        }

        $cart->checked_out = 1;
        $cart->check_out_datetime = now();
        $cart->check_out_price = $total;
        $cart->save();

        $this->createNewCart();

        return redirect()->route('home');
    }

    public function showTransactionHistory()
    {
        $carts = Cart::where('checked_out','=','1')
                        ->where('user_id','=',Auth::id())
                        ->get();
        return view('member.transaction_history', compact('carts'));
    }

    protected function getUserCart()
    {
        $id = Auth::id();
        return Cart::where('user_id','=',$id)
                    ->where('checked_out','=','0')
                    ->first();
    }

    protected function createNewCart()
    {
        $cart = new Cart();
        $cart->user_id = Auth::id();
        $cart->checked_out = 0;

        $cart->save();
    }

    protected function validateCart(Request $request)
    {
        $messages = [
            'qty.required' => 'Please fill in the quantity.',
            'qty.gt' => 'Quantity cannot be 0.',
        ];

        $request->validate([
            'qty' => 'required|gt:0',
        ], $messages);
    }
}
