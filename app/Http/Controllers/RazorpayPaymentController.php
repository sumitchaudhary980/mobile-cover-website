<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Mail;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class RazorpayPaymentController extends Controller
{
    /**
     * Show the payment view.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        if (!Auth::check()) {
            abort(401); // Unauthorized
        }

        if (!$request->has('access_token') || $request->input('access_token') !== csrf_token()) {
            abort(401);
        }

        $user = Auth::user();
        $cartItems = Cart::where('email', $user->email)->get();

        $totalPrice = $cartItems->sum(function ($item) {
            return $item->total_price;
        });

        // Pass the final totalPrice to the view
        return view('razorpayView', compact('totalPrice'));
    }

    /**
     * Handle the payment capture.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            abort(401); // Return a 401 Unauthorized response
        }

        $input = $request->all();
        $api = new Api("rzp_test_3aVy5s2zsD2lFO", "CMzbGWbJAeZ2zmsjzySeWCey");

        if (isset($input['razorpay_payment_id']) && !empty($input['razorpay_payment_id'])) {
            try {
                // Fetch the payment details
                $payment = $api->payment->fetch($input['razorpay_payment_id']);

                // Capture the payment amount
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture([
                    'amount' => $payment->amount // Amount should be in smallest currency unit
                ]);

                $user = Auth::user();
                $cartItems = Cart::where('email', $user->email)->get();
                $totalItems = Cart::where('email', $user->email)->sum('quantity');
                $discountPerItem = 0;

                if (session()->has('discount')) {
                    $discount = session('discount');
                    $discountPerItem = $discount / $totalItems;
                }

                $totalPrice = 0; // Initialize total price for the whole order

                foreach ($cartItems as $item) {
                    $order = new Order();
                    $order->product_id = $item->product_id;
                    $order->email = $user->email;
                    $order->product_names = $item->product_name;
                    $order->product_image = $item->product_image;
                    $order->quantity = $item->quantity;

                    // If there is a discount session, apply it, otherwise, just use the original total price
                    if (session()->has('discount')) {
                        $total_price = $item->total_price - $discountPerItem;
                    } else {
                        $total_price = $item->total_price;
                    }

                    $order->total_price = $total_price;
                    $totalPrice += $total_price; // Add this item to the total price for the whole order
                    $order->name = $user->name;
                    $order->address = urldecode($request->input('address'));
                    $order->save();


                }
               

                $mailData = [
                    'name' => $user->name,
                    'address' => $request->input('address'),
                    'total_price' => $totalPrice,
                    'orders' => $cartItems->map(function ($item) use ($discountPerItem) {
                        return [
                            'product_names' => $item->product_name,
                            'product_image' => $item->product_image,
                            'quantity' => $item->quantity,
                            'total_price' => $item->total_price - $discountPerItem, // Adjust for discount per item
                        ];
                    })->toArray(),
                ];


                try {
                    \Log::info('Mail Data: ' . json_encode($mailData));

                    Mail::to($user->email)->send(new OrderMail($mailData));

                    if (session()->has('discount')) {
                        session()->forget('discount');
                    }
                    Cart::where('email', $user->email)->delete();
                    return redirect('my_orders')->with('message', 'Order placed successfully. Please check your email for order details.');
                } catch (\Exception $e) {
                    \Log::error('Email sending error: ' . $e->getMessage());

                    return redirect('my_orders')->with('error', 'Order Placed but failed to send order confirmation email. Please try again later.');
                }

            } catch (\Exception $e) {
                // Redirect back with an error message
                return redirect()->back()->with('error', $e->getMessage());
            }
        } else {
            // Handle case where payment ID is missing
            return redirect()->back()->with('error', 'Invalid Payment ID');
        }
    }
}
