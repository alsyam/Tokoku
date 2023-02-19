<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\Clothes;
use App\Models\Booking;


class PaymentController extends Controller
{

    // payment
    public function payment(Request $request)
    {

        $orders = Booking::where('user_booking_id', Auth()->user()->id)->get();
        $product = "";
        foreach ($orders as $order) {
            $product .= $order->clothes->product . ", ";
        }

        // Set your Merchant Server Key 
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;



        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $request->get('total'),
            ),
            'item_details' => array(
                [
                    'id' => 'a1',
                    'price' => $request->get('subtotal'),
                    'quantity' =>  1,
                    'name' => rtrim($product, ", ")
                ],
                [
                    'id' => 'b1',
                    'price' =>  $request->get('cost'),
                    'quantity' => 1,
                    'name' => 'Shipping Fee'
                ]


            ),
            'customer_details' => array(
                'first_name' => $request->get('name'),
                'last_name' => '',
                'email' => $request->get('email'),
                'phone' => $request->get('phone_number'),
            ),
        );


        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('order.payment', ['snap_token' => $snapToken]);
    }



    public function payment_post(Request $request)
    {
        $bookings = Booking::where('user_booking_id', Auth()->user()->id)->get();

        $json = json_decode($request->get('json'));



        foreach ($bookings as $booking) {
            $order['clothes_id'] = $booking->clothes_id;
            $order['user_booking_id'] = $request->get('user_booking_id');
            $order['admin_id'] = $request->get('admin_id');
            $order['status'] = $json->transaction_status;
            $order['courier'] = $request->get('courier_name');
            $order['service'] = $request->get('service');
            $order['etd'] = $request->get('etd');
            $order['quantity'] = $booking->quantity;
            $order['size_cloth'] = $booking->size_cloth;
            $order['transaction_id'] = $json->transaction_id;
            $order['order_id'] = $json->order_id;
            $order['gross_amount'] = $json->gross_amount;
            $order['payment_type'] = $json->payment_type;
            $order['payment_code'] = isset($json->payment_code) ? $json->payment_code : null;
            $order['pdf_url'] = isset($json->pdf_url) ? $json->pdf_url : null;
            Checkout::create($order);
        }

        // save to checkout

        // reduce stock
        foreach ($bookings as $booking) {
            $clothes = Clothes::where('id', $booking->clothes_id)->get();
            foreach ($clothes as $clothes) {
                $size = $clothes[$booking->size_cloth];
                $data[$booking->size_cloth] = $size - $booking->quantity;
                Clothes::where('id', $booking->clothes_id)->update($data);
            }
        }

        // deleted booking data
        foreach ($bookings as $booking) {
            Booking::destroy($booking->id);
        }

        return redirect('/clothes')->with('success', 'Verified payment and order confirmed!');

        // return $order->save() ? redirect('/clothes')->with('alert-success', 'Order berhasil dibuat') : redirect('/clothes')->with('alert-failed', 'Terjadi Kesalahan');
    }
}
