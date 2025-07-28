<?php

namespace App\Http\Controllers;

use App\Models\offers;
use App\Models\user;
use App\Models\address;
use App\Models\order;
use App\Models\Cover;
use App\Models\Mobile;
use App\Models\Cart;
use App\Models\contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->usertype == 'admin') {
                return redirect()->to('/dashboard');
            }
        }

        return view('home.index');
    }



    public function forget_password()
    {
        return view('home.forget_password');
    }


    // public function mobile_cover()
    // {
    //     $data = Mobile::all();
    //     return view('home.mobile_cover', compact('data'));
    // }

    public function mobile_cover(Request $request)
    {
        $sort = $request->input('sort', 'Default Sorting');
        $query = Cover::query();

        if ($sort === 'Sort by latest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort === 'Sort by price: low to high') {
            $query->orderBy('cover_price', 'asc');
        } elseif ($sort === 'Sort by price: high to low') {
            $query->orderBy('cover_price', 'desc');
        }
        $cover = $query->get();

        return view('home.back-cover', compact('cover', 'sort'));

    }

    public function back_cover()
    {

        $cover = Cover::all();

        $sort = "Default Sorting";
        return view('home.back-cover', compact('cover', 'sort'));
    }
    public function cover_details($id)
    {
        $cover = Cover::find($id);
        $mobile = Mobile::find($cover->mobile_id);
        return view('home.mobile-cover-details', compact('cover', 'mobile'));
    }

    public function snap_mobile_cover()
    {

        $cover = Cover::all()->where('cover_type', 'Snap Case');

        return view('home.snap_mobile_cover', compact('cover'));
    }

    // public function back_cover_details($id)
    // {
    //     $cover = Cover::find($id);
    //     $mobile = Mobile::find($cover->mobile_id);
    //     return view('home.cover-details', compact('cover', 'mobile'));
    // }


    public function silicone_mobile_cover()
    {
        $cover = Cover::all()->where('cover_type', 'Soft Silicone Case');
        return view('home.silicone_mobile_cover', compact('cover'));
    }


    public function glossy_metal_tpu_mobile_cover()
    {
        $cover = Cover::all()->where('cover_type', 'Glossy Metal TPU Case');
        return view('home.glossy-metal-tpu-mobile-cover', compact('cover'));
    }

    public function offer()
    {
        $offer = offers::all();
        return view('home.offer', compact('offer'));
    }

    public function contact()
    {
        return view('home.contact');
    }

    public function contact_form(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|min:2|max:255|regex:/^(?!.* {2})[A-Za-z]+( [A-Za-z]+)*$/',
            'email' => 'required|email',
            'phone_number' => 'required|numeric|digits:10|min:1',
            'message' => 'required|',
        ]);

        $contact = new Contact();
        $contact->name = $request->full_name;
        $contact->email = $request->email;
        $contact->number = $request->phone_number;
        $contact->message = $request->message;
        $contact->save();
        return redirect()->back()->with('message', 'Our Team wil shortly get in touch with you via email');
    }

    public function my_orders()
    {
        $user = Auth::user();
        $order = order::where('email', $user->email)->get();
        $count=$order->count();
        return view('home.orders', compact('order','count'));
    }

    public function cart()
    {
        $user = auth::user();
        $cart = Cart::all()->where('email', $user->email);
        $totalPrice = $cart->sum(function ($item) {
            return $item->total_price;
        });
        return view('home.cart', compact('cart', 'totalPrice'));
    }
    // public function profile()
    // {
    //     $user = auth()->user();
    //     return view('home.profile',compact('user'));
    // }

    // public function edit_profile()
    // {
    //     $user = auth()->user();
    //     return view('home.edit_profile', compact('user'));
    // }

    public function checkout()
    {
        $user = Auth::user();
        $cart = Cart::all()->where('email', $user->email);
        if ($cart->isEmpty()) {
            return redirect()->back()->with('error', 'Cart is empty');
        }
        $address = address::all()->where('email', $user->email);
       
        return view('home.checkout', compact('address','user'));
    }

    public function add_cart($id)
    {
        $cover = Cover::find($id);
        $user = Auth::user();

        // Check if the product is already in the cart for this user
        $existingCart = Cart::where('email', $user->email)
            ->where('product_name', $cover->cover_name)
            ->first();

        if ($existingCart) {
            return redirect()->back()->with('error', 'Item already exists in cart.');
        }

        $available = $cover->cover_quantity;

        if ($available == 0) {
            return redirect()->back()->with('error', 'Item is out of stock.');
        }


        $cart = new Cart();
        $cart->product_id = $id;
        $cart->email = $user->email;
        $cart->product_name = $cover->cover_name;
        $cart->product_image = $cover->cover_img;
        $cart->product_price = $cover->cover_price;
        $cart->total_price = $cover->cover_price;
        $cart->save();
        return redirect()->back()->with('message', 'Item added to cart successfully');
    }

    public function delete_cart($id)
    {

        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back()->with('message', 'Item deleted from cart successfully');
    }

    // CartController.php
    public function updateQuantity(Request $request)
    {

        // Retrieve the cart item
        $cart = Cart::where('id', $request->input('pid'))->firstOrFail();

        $totalPrice = $request->input('qnt') * $cart->product_price;
        // Update the quantity
        $cart->quantity = $request->input('qnt');
        $cart->total_price = $totalPrice;
        $cart->save();

        return redirect()->back()->with('message', 'Quantity updated successfully!');
    }



    public function apply_coupon(Request $request)
    {
        $user = Auth::user();

        $totalPrice = Cart::where('email', $user->email)->sum('total_price');

        $request->validate([
            'coupon' => 'required|string'
        ]);

        $couponCode = $request->coupon;

        $coupon = offers::where('coupon_code', $couponCode)->first();

        if ($coupon) {
            $minimumPurchaseAmount = $coupon->minimum_purchase;

            // Check if the total price is enough to apply the coupon
            if ($totalPrice >= $minimumPurchaseAmount) {
                $discount = $coupon->discount;
                session()->put('discount', $discount);


                return redirect()->back()->with([
                    'message' => 'Coupon applied successfully',
                ]);
            } else {
                return redirect()->back()->with('error', 'Minimum purchase amount of $' . $minimumPurchaseAmount . ' not met');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid coupon code');
        }
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $search = trim($search);

        $query = Cover::query()->where('cover_name', 'LIKE', '%' . $search . '%');;

        $data = $query->get();
        return view('home.search', compact('data', 'search'));

    }

    public function search_cover(Request $request)
    {
        $sort = $request->input('sort', 'Default Sorting');
        $query = Cover::query();

        if ($sort === 'Sort by latest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort === 'Sort by price: low to high') {
            $query->orderBy('cover_price', 'asc');
        } elseif ($sort === 'Sort by price: high to low') {
            $query->orderBy('cover_price', 'desc');
        }
        $cover = $query->get();

        return view('home.search', compact('cover', 'sort'));

    }

    public function add_address(Request $request)
    {

        $request->validate([
            'phone' => 'required|digits:10',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'area' => 'required|string|max:500',
            'landmark' => 'required|string|max:100',
            'pincode' => 'required|digits:6',
        ]);
        $user = Auth::user();
        $address = new address();
        $address->email = $user->email;
        $address->number = $request->phone;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->area = $request->area;
        $address->landmark = $request->landmark; 
        $address->pincode = $request->pincode;
        $address->save();
        return redirect()->back()->with('message', 'Address added successfully.');
    }

    public function cancel_order($id)
    {
        $order = Order::find($id);
        $order_quantity = $order->quantity;
        $cover = Cover::where('cover_name', $order->product_names)->first();
        $quantity = $cover->cover_quantity;
        $cover->cover_quantity = $quantity + $order_quantity;
        $cover->save();
        $order->status = 'Cancelled';
        $order->save();
        return redirect()->back()->with('message', 'Order Cancelled Successfully');
    }
}
