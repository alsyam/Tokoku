<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function __construct()
    // {
    //     $this->middleware('verified')->only(['index']);
    // }


    public function index()
    {
        return view('user.index', [
            'title' => 'Profile',
            "active" => "profile",
            "activeNavItem" => 'personalInfo',
            'users' => User::where('id', Auth()->user()->id)->first()

        ]);
    }

    public function purchase()
    {
        $member = User::where('id', Auth()->user()->id)->first();
        $order = Checkout::where('user_booking_id',  $member->id)->get();
        return view('user.purchase', [
            'title' => 'Profile',
            "active" => "profile",
            "activeNavItem" => "purchaseHistory",
            'orders' => $order
        ]);
    }

    public function showPurchase($order_id)
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

        // $member = User::where('id', Auth()->user()->id)->first();
        // $order = Checkout::where('user_booking_id',  $member->id)->first();
        $order = Checkout::where('order_id',  $order_id)->first();

        $createdAt = \Carbon\Carbon::parse($order->created_at);



        return view('user.showPurchase', [
            'orders' => Checkout::where('order_id',  $order_id)->get(),
            'order' => $order,
            'provinces' => $province->rajaongkir->results,
            'cities' => $city->rajaongkir->results,
            'day' => $createdAt->day,
            'month' => $createdAt->monthName,
            'year' => $createdAt->year,
            'weekday' => $createdAt->englishDayOfWeek,
            'title' => 'Profile',
            "active" => "profile",
            "activeNavItem" => "purchaseHistory",
        ]);
    }

    public function address()
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


        return view('user.address', [
            'title' => 'Profile',
            "active" => "profile",
            "activeNavItem" => "address",
            'users' => User::where('id', Auth()->user()->id)->first(),
            'provinces' => $province->rajaongkir->results,
            'cities' => $city->rajaongkir->results,

        ]);
    }



    public function editAddress()
    {
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



        return view('user.editAddress', [
            'title' => 'Profile',
            "active" => "profile",
            "activeNavItem" => "address",
            'provinces' => $province->rajaongkir->results,
            'users' => User::where('id', Auth()->user()->id)->first(),
        ]);
    }


    public function updateAddress(Request $request)
    {
        $member = User::where('id', Auth()->user()->id)->first();

        $user['name'] = $member->name;
        $user['username'] = $member->username;
        $user['email'] = $member->email;
        $user['phone_number'] = $member->phone_number;
        $user['address'] = $request->get('address');
        $user['province'] = $request->get('province');
        $user['city'] = $request->get('city');
        $user['zip_code'] = $request->get('zip_code');



        // if (!empty($request->get('password'))) {
        //     $user['password'] = bcrypt($request->get('password'));
        // }
        // if (!empty($validatedData['password'])) {
        //     $user['password'] = bcrypt($validatedData['password']);
        // }



        User::where('id', $member->id)->update($user);
        return redirect('/address')->with('success', 'Address has been updated!');
    }







    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $users)
    {
        $member = User::where('id', Auth()->user()->id)->first();
        // $user = User::find($id);
        // $validatedData = $request->validate([
        //     'name' => 'required|max:255',
        //     'username' => 'required|min:3|max:255|unique:users',
        //     'email' => 'required|email:dns|unique:users',
        //     'password' =>  'required|min:5|max:255',
        //     'address' =>  'required|max:255',
        //     'province' =>  'required|max:255',
        //     'city' =>  'required|max:255',
        //     'zip_code' =>  'required|max:255',
        //     'phone_number' =>  'required|max:255',
        // ]);

        // $user['name'] = $validatedData['name'];
        // $user['username'] = $validatedData['username'];
        // $user['email'] = $validatedData['email'];
        // $user['address'] = $validatedData['address'];
        // $user['province'] = $validatedData['province'];
        // $user['city'] = $validatedData['city'];
        // $user['zip_code'] = $validatedData['zip_code'];
        // $user['phone_number'] = $validatedData['phone_number'];

        $user['name'] = $request->get('name');
        $user['username'] = $request->get('username');
        $user['email'] = $request->get('email');
        $user['phone_number'] = $request->get('phone_number');
        $user['address'] = $member->address;
        $user['province'] = $member->province;
        $user['city'] = $member->city;
        $user['zip_code'] = $member->zip_code;



        if (!empty($request->get('password'))) {
            $user['password'] = bcrypt($request->get('password'));
        }
        // if (!empty($validatedData['password'])) {
        //     $user['password'] = bcrypt($validatedData['password']);
        // }



        User::where('id', $request->id)->update($user);
        return redirect('/profile')->with('success', 'Personal data has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
