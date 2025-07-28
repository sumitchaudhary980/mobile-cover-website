<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\Cart;
use App\Models\address;
use Illuminate\Support\Facades\Auth;

class EsewaController extends Controller
{
    public function initiatePayment(Request $request)
    {
        // Validate request
        $request->validate([
            'amount' => 'required|numeric|min:10',
            'order_id' => 'required|string',
            'address' => 'required|string',
        ]);

        $user = Auth::user();
        $amount = $request->amount;
        $taxAmount = 0; // Adjust based on your needs (e.g., tax)
        $serviceCharge = 0; // Adjust based on your needs
        $deliveryCharge = 0; // Adjust based on your needs
        $totalAmount = $amount + $taxAmount + $serviceCharge + $deliveryCharge;
        $transactionUuid = Str::uuid()->toString();

        // Prepare form data for eSewa sandbox
        $formData = [
            'tAmt' => $totalAmount,
            'amt' => $amount,
            'txAmt' => $taxAmount,
            'psc' => $serviceCharge,
            'pdc' => $deliveryCharge,
            'scd' => env('ESEWA_MERCHANT_CODE', 'EPAYTEST'),
            'pid' => $transactionUuid,
            'su' => route('esewa.success'),
            'fu' => route('esewa.failure'),
        ];

        // Store order details in session for verification
        session([
            'order_id' => $request->order_id,
            'transaction_uuid' => $transactionUuid,
            'amount' => $totalAmount,
            'address' => $request->address,
        ]);

        // Return view to auto-submit to eSewa
        return view('esewa.payment', compact('formData'));
    }

    public function verifyPayment(Request $request)
    {
        // Retrieve session data
        $orderId = session('order_id');
        $transactionUuid = session('transaction_uuid');
        $amount = session('amount');

        // Get parameters from eSewa redirect
        $refId = $request->query('refId');
        $oid = $request->query('oid');
        $amt = $request->query('amt');

        // Verify payment with eSewa sandbox
        $url = env('ESEWA_API_URL') . '/api/epay/transaction/v2/';
        $data = [
            'amt' => $amount,
            'scd' => env('ESEWA_MERCHANT_CODE', 'EPAYTEST'),
            'pid' => $transactionUuid,
            'rid' => $refId,
        ];

        $response = Http::get($url, $data);
        $responseBody = $response->body();

        // Check for success in response
        if (strpos($responseBody, '"status":"SUCCESS"') !== false || strpos($responseBody, '<response_code>Success</response_code>') !== false) {
            // Payment successful, update order status (optional for portfolio)
            // Example: Order::where('id', $orderId)->update(['payment_status' => 'completed', 'transaction_id' => $refId, 'address' => session('address')]);

            return redirect()->route('esewa.success')->with('message', 'Payment successful! Thank you for your purchase.');
        }

        // Payment failed
        return redirect()->route('esewa.failure')->with('message', 'Payment verification failed.');
    }

    public function paymentFailure(Request $request)
    {
        // Handle failed payment
        return view('esewa.failure')->with('message', 'Payment failed. Please try again.');
    }

    public function addAddress(Request $request)
    {
        // Validate new address
        $request->validate([
            'phone' => 'required|numeric',
            'state' => 'required|string',
            'city' => 'required|string',
            'area' => 'required|string',
            'landmark' => 'required|string',
            'pincode' => 'required|numeric',
        ]);

        $user = Auth::user();
        $address = new address();
        $address->email = $user->email;
        $address->phone = $request->phone;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->area = $request->area;
        $address->landmark = $request->landmark;
        $address->pincode = $request->pincode;
        $address->save();

        return redirect()->route('checkout')->with('message', 'Address added successfully!');
    }
}
