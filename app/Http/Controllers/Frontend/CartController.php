<?php
// app/Http/Controllers/Frontend/CartController.php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use \App\Models\Book;
use \App\Models\Order;
use \App\Models\Orderitem;
use \App\Models\Countory;
use Validator;

class CartController extends Controller
{
    //add to cart section start
    public function show()
    {
        $user = Auth::guard('register')->user();

        $add_carts = Cart::with('book')->where('register_id', $user->id)->get();

        $subtotel = 0;
            foreach($add_carts as $cart){
                $subtotel += $cart->book->price * $cart->quantity;
            }

          $totaltex = 0.1;
          $tex = $subtotel * $totaltex;
          
          $shipping = 0;

          $grandtotel = $subtotel + $tex + $shipping;


          $countries = Countory :: all();
        return view('frontend.add-cart', compact('add_carts' , 'subtotel' , 'tex' , 'shipping' , 'grandtotel' , 'countries'));
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $user = Auth::guard('register')->user();

        $existing = Cart::where([
            ['book_id', $request->book_id],
            ['register_id', $user->id]
        ])->first();

        if ($existing) {
            return redirect()->route('cart.index')->with('error', 'Book already in cart.');
        }

        Cart::create([
            'register_id' => $user->id,
            'book_id' => $request->book_id,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('cart.index')->with('success', 'Book added to cart.');
    }


    public function destroy($id){
        $cart = Cart::find($id);
        $cart->delete();
        return back()->with('success', 'Item deleted successfully');
    }

//add to cart section end




// checkout section start
    public function placeorder(Request $request){

        $validation = Validator::make($request->all(),[
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'required|string|max:20',
                'address' => 'required|string',
                'city' => 'required|string',
                'country_id' => 'required|string|not_in:none',
                'zipcode' => 'required|string|max:10',
                'terms' => 'accepted',
        ]);
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }
            //phla hmm dakinga ka register howa ha user
            $user = Auth::guard('register')->user();

            //cart ka item hmm get kar dinga
           $cartitem = Cart::with('book')->where('register_id' , $user->id)->get();

            //pir hm calculate karinga subtotal ko
            $subtotel = 0;
            foreach($cartitem as $item){
                $subtotel += $item->book->price * $item->quantity;
            }

            //pir hmm agr tex lagye ga to osko hmm calculate karinga 
            $texitem = 0.1;
            $tex = $subtotel * $texitem;

            //pir agr hm chipping charges laga ta ha to calcuate kairnga wrna asa he rhna dinga 
            $shipping = 0;

            //pir hmm subtotel + tex + shipping ko grand totel karinga
            $grandtotel = $subtotel + $tex + $shipping;


            //pir hmm order  ko insert kainga
           $order = Order::create([
                'register_id' => $user->id,
                'name' => $request->name,
                 'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'country_id' => $request->country_id,
                'zipcode' => $request->zipcode,
                'subtotal' => $subtotel,
                'tax' => $tex,
                'shipping' => $shipping,
                'total_amount' => $grandtotel,
                'status' => 'panding',
            ]);


            //pir hmm order item k0 insert kainga
            foreach($cartitem as $item){
                Orderitem::create([
                    'order_id' => $order->id,
                    'book_id' =>$item->book->id,
                    'quantity' => $item->quantity,
                    'price' => $item->book->price
                ]);
            }

            Cart::with('book')->where('register_id' , $user->id)->delete();

             return redirect()->route('cart.index')->with('success', 'Your order has been placed successfully.');

    }
// checkout section end
    
}
