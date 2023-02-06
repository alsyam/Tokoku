<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('order.checkout', [
            'title' => 'Checkout',
            "active" => "booking",
            'booking' => Booking::where('user_booking_id', Auth()->user()->id)->get()
        ]);
    }
}
