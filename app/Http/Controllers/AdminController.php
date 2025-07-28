<?php

namespace App\Http\Controllers;

use App\Models\Cover;
use App\Models\Mobile;
use App\Models\offers;
use App\Models\contact;
use App\Models\order;
use Illuminate\Http\Request;

use app\Models\User;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{

  
    public function index()
    {
        $mobile=Mobile::count();
        $order=Order::count();
        $cover=Cover::count();
        $user=User::count();
        return view('admin.index',compact('mobile', 'order', 'cover', 'user'));
    }


    public function mobile()
    {
        $mobiles = Mobile::all();
        return view('admin.mobile', compact('mobiles'));
    }

    public function add_mobile(Request $request)
    {
        $request->validate(
            [
                'mobile' => 'required|alpha',
                'model' => 'required|',
            ],

        );
        $mobile = new Mobile();
        $mobile->mobile = $request->mobile;
        $mobile->mobile_model = $request->model;
        $mobile->save();
        return redirect()->back()->with('message', 'Mobile Added Successfully');
    }

    public function delete_mobile($id)
    {
        $mobile = Mobile::find($id);
        $mobile->delete();
        return redirect()->back()->with('message', 'Mobile Deleted Successfully');
    }

    public function manage_orders()
    {
        $order = order::all();
        return view('admin.manage_orders',compact('order'));
    }

    public function delete_cover($id)
    {
        $cover = Cover::find($id);
        $cover->delete();
        return redirect()->back()->with('message', 'Cover Deleted Successfully');
    }

    public function case()
    {
        $mobile = Mobile::all();
        return view('admin.case', compact('mobile'));
    }

    public function view_cover()
    {
        $cover = Cover::all();

        return view('admin.view_cover', compact('cover'));
    }

    public function store_cover(Request $request)
    {
        $request->validate([
            'cover_name' => 'required',
            'cover_price' => 'required|numeric|min:1',
            'description' => 'required|min:20',
            'mobile' => 'required',
            'model' => 'required',
            'cover_img' => 'required|file|mimes:jpeg,png,gif,bmp,webp,svg|max:2048',
        ]);

        return redirect()->back()->with('message', 'Cover Added Successfully');
    }


    public function store_case(Request $request)
    {
        $request->validate([
            'cover_name' => 'required',
            'cover_price' => 'required|numeric|min:1',
            'cover_quantity' => 'required|numeric|min:1',
            'description' => 'required|min:20',
            'model' => 'required',
            'type' => 'required',
            'cover_img' => 'required|file|mimes:jpeg,png,gif,bmp,webp,svg|max:2048',
        ]);
        $cover = new Cover();
        $cover->cover_type = $request->type;
        $cover->cover_name = $request->cover_name;
        $cover->cover_price = $request->cover_price;
        $cover->cover_quantity = $request->cover_quantity;
        $cover->description = $request->description;
        $cover->mobile_id = $request->model;
        if ($request->hasFile('cover_img')) {
            if ($cover->cover_img && file_exists(public_path('assets/image/' . $cover->cover_img))) {
                unlink(public_path('assets/image/' . $cover->cover_img));
            }
            $image = $request->file('cover_img');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('assets/image'), $imageName);
            $cover->cover_img = $imageName;
        }

        $cover->save();
        return redirect()->back()->with('message', 'Case Added Successfully');
    }

    public function edit_cover($id)
    {
        $cover = Cover::find($id);
        $mobile= Mobile::all();
        return view('admin.edit_cover', compact('cover','mobile'));
    }

    public function update_case(Request $request, $id)
    {
        $request->validate([
            'cover_name' => 'required',
            'cover_price' => 'required|numeric|min:1',
            'cover_quantity' => 'required|numeric|min:1',
            'description' => 'required|min:20',
            'model' => 'required|',
            'type' => 'required',
            'cover_img' => 'nullable|file|mimes:jpeg,png,gif,bmp,webp,svg|max:2048',
        ]);

        $cover = Cover::findOrFail($id);
        $cover->cover_name = $request->cover_name;
        $cover->cover_price = $request->cover_price;
        $cover->cover_quantity = $request->cover_quantity;
        $cover->description = $request->description;
        $cover->cover_type = $request->type;

        if ($request->hasFile('cover_img')) {
            if ($cover->cover_img && file_exists(public_path('assets/image/' . $cover->cover_img))) {
                unlink(public_path('assets/image/' . $cover->cover_img));
            }
            $image = $request->file('cover_img');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('assets/image'), $imageName);
            $cover->cover_img = $imageName;
        }

        $cover->save();
        return redirect()->back()->with('message', 'Case Updated Successfully');
    }


    public function profile()
    {

        $user = auth()->user();
        if (Auth::user()->usertype == 'admin') {
            return view('admin.profile', compact('user'));
        }
        return view('home.profile', compact('user'));

    }
    public function edit_profile()
    {
        $user = auth()->user();
        if (Auth::user()->usertype == 'admin') {
            return view('admin.edit_profile', compact('user'));
        }
        return view('home.edit_profile', compact('user'));

    }

    public function update_profile(Request $request)
    {
        // Validate the input data
        $request->validate([
            'name' => 'required|string|min:2|max:255|regex:/^(?!.* {2})[A-Za-z]+( [A-Za-z]+)*$/',            'email' => 'required|email',
            'phone' => 'required|digits_between:10,15',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'profile_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,bmp,webp|max:2048',
        ],
        [
                'name.regex' => 'Name only should contains alphabets and no extra spaces',
        ]
    );

        // Get the logged-in user
        $user = auth()->user();

        if ($request->hasFile('profile_img')) {
            // Check if there's already a profile image
            if ($user->profile_photo && file_exists(public_path('assets/image/' . $user->profile_photo))) {
                // Delete the old profile image
                unlink(public_path('assets/image/' . $user->profile_photo));
            }

            // Upload the new image
            $image = $request->file('profile_img');
            $imageName =  $image->getClientOriginalName();
            $image->move(public_path('assets/image'), $imageName);

            // Update the user's profile photo path
            $user->profile_photo = $imageName;
        }

        // Update user details
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->state = $request->input('state');
        $user->city = $request->input('city');
        $user->address = $request->input('address');

        // Save user data
        $user->save();

        // Redirect back with a success message
        return redirect()->back()->with('message', 'Profile Updated Successfully');
    }


    public function users()
    {
        $user = User::where('usertype','user')->get();
        return view('admin.users', compact('user'));
    }

    public function delete_user($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('message', 'User Deleted Successfully');
    }

    public function confirm_order($id)
    {
        $order=Order::find($id);
        $order_quantity=$order->quantity;
        $cover=Cover::where('cover_name',$order->product_names)->first();
        $quantity=$cover->cover_quantity;
        $cover->cover_quantity=$quantity-$order_quantity;
        $cover->save();
        $order->status='Confirmed';
        $order->save();
        return redirect()->back()->with('message', 'Order Confirmed Successfully');
    }

    public function cancel_order($id){

        $order=Order::find($id);
        $order_quantity = $order->quantity;

        $cover = Cover::where('cover_name', $order->product_names)->first();
        $quantity = $cover->cover_quantity;
        $cover->cover_quantity = $quantity + $order_quantity;
        $cover->save();
        $order->status='Cancelled';
        $order->save();
        return redirect()->back()->with('message', 'Order Cancelled Successfully');
    }


    public function delete_order($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect()->back()->with('message', 'Order Deleted Successfully');
    }

    public function ship_order($id){
        $order=Order::find($id);
        $order->status='Shipped';
        $order->save();
        return redirect()->back()->with('message', 'Order Shipped Successfully');
    }

    public function deliver_order($id){
        $order=Order::find($id);
        $order->status='Delivered';
        $order->save();
        return redirect()->back()->with('message', 'Order Delivered Successfully');
    }

    public function manage_offer()
    {

        $offer = offers::all();
        return view('admin.offers', compact('offer'));
    }

    public function store_offer(Request $request)
    {

        $request->validate([
            'coupon_code' => 'required|',
            'minimum_purchase' => 'required|min:3|',
            'discount' => 'required|',
        ]);

        $offer = new offers();
        $offer->coupon_code = $request->coupon_code;
        $offer->minimum_purchase = $request->minimum_purchase;
        $offer->discount = $request->discount;
        $offer->save();
        return redirect()->back()->with('message', 'Offer Added Successfully');
    }

    public function edit_offer($id)
    {
        $offer = offers::find($id);
        return view('admin.edit_offer', compact('offer'));
    }

    public function update_offer(Request $request, $id)
    {
        $request->validate([
            'coupon_code' => 'required|',
            'minimum_purchase' => 'required|min:3|',
            'discount' => 'required|',
        ]);

        $offer = offers::findOrFail($id);
        $offer->coupon_code = $request->coupon_code;
        $offer->minimum_purchase = $request->minimum_purchase;
        $offer->discount = $request->discount;
        $offer->save();
        return redirect()->back()->with('message', 'Offer Updated Successfully');
    }


    public function delete_offer($id)
    {
        $offer = offers::find($id);
        $offer->delete();
        return redirect()->back()->with('message', 'User Deleted Successfully');
    }

    public function message(){
        $contact= Contact::all();
        return view('admin.message', compact('contact'));
    }

    public function delete_message($id){
        $contact= Contact::find($id);
        $contact->delete();
        return redirect()->back()->with('message', 'Message Deleted Successfully'); 
    }

    


}
