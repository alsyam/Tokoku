<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Checkout;
use App\Models\User;
use App\Models\Clothes;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('cart')->only(['index']);
    }



    public function index()
    {
        // $this->authorize('cart');

        return view('order.booking', [
            'title' => 'Shopping Cart',
            "active" => "booking",
            'booking' => Booking::where('user_booking_id', Auth()->user()->id)->get()
        ]);
    }


    // shipping costs
    public function shipping()
    {
        $id_hometown = $_GET['id_hometown'];
        $id_destination_city = $_GET['id_destination_city'];
        $weight = $_GET['weight'];
        $courier = $_GET['courier'];


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=" . $id_hometown . "&destination=" . $id_destination_city . "&weight=" . $weight . "&courier=" . $courier,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: 8717a7a6273120d5a841a3bf52623cc7"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            // echo $response;
            $cost = json_decode($response);
            // echo "<pre>";
            // print_r($cost);
            // "</pre>";
        }
        return view('order.shipping', [
            'cost' => $cost->rajaongkir->results[0]->costs
        ]);
    }

    public function checkout()
    {
        // for PROVINCE
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 8717a7a6273120d5a841a3bf52623cc7"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //   echo $response;
            $province = json_decode($response);
        }


        // for CITY
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 8717a7a6273120d5a841a3bf52623cc7"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $city = json_decode($response);
        }





        // $booking = Booking::where('user_booking_id', Auth()->user()->id)->get();

        $booking = Booking::where('user_booking_id', Auth()->user()->id)->get();
        $subtotal = $booking->sum('subtotal');
        $quantity = $booking->sum('quantity');
        $weight = $booking->sum('weight_product');

        return view('order.checkout', [
            'title' => 'Checkout',
            "active" => "booking",
            'booking' => Booking::where('user_booking_id', Auth()->user()->id)->get(),
            'subtotal' => $subtotal,
            'quantity' => $quantity,
            'weight' => $weight,
            'admin' => User::all(),
            'user' => Auth()->user(),
            'provinces' => $province->rajaongkir->results,
            'cities' => $city->rajaongkir->results

        ]);
    }






    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $clothes = Clothes::where('id', $request->get('clothes_id'))->value('price');

        $data['user_booking_id'] = auth()->user()->id;
        $data['clothes_id'] = $request->get('clothes_id');
        $data['size_cloth'] = $request->get('size_cloth');
        $data['quantity'] = $request->get('quantity');
        $data['weight_product'] = $request->get('weight_product');
        $data['admin_id'] = $request->get('admin_id');
        $data['subtotal'] = $request->get('quantity') *  $clothes;
        $data['order_desc'] = 'selesai';

        Booking::create($data);

        return redirect('/clothes/' . $request->slug)->with('success', 'New Product has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {



        $data['quantity'] = $request->get('quantity');
        $data['weight_product'] = $request->get('quantity') * $booking->clothes->weight;
        $data['subtotal'] = $request->get('quantity') * $booking->clothes->price;
        Booking::where('id', $booking->id)->update($data);

        return redirect('/booking');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Booking::destroy($id);

        return redirect('/booking')->with('success', 'Item has been deleted!');
    }
}
