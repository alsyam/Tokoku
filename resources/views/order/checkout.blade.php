@extends('layouts/main')

@section('container')
    <div class="row g-5 mb-5">
        <div class="col-md-3 col-lg-7">
            <h3>Checkout</h3>
            <h6>Shipping Address</h6>
            <hr>
            <h6>{{ $user->name }}</h6>
            <p>{{ $user->phone_number }}
                <br>{{ $user->address }}

                @foreach ($provinces as $provinces)
                    @if ($provinces->province_id === $user->province)
                        {{ $provinces->province }},
                    @endif
                @endforeach

                @foreach ($cities as $city)
                    @if ($city->city_id === $user->city)
                        {{ $city->type }}
                        {{ $city->city_name }},
                    @endif
                @endforeach
                {{ $user->zip_code }}
            </p>
            <hr>

            <h6>Order Detail</h6>
            @foreach ($booking as $book)
                <table class="table table-border">

                    <tr>
                        <td rowspan="0"><img src="{{ asset('storage/' . $book->clothes->image) }}" alt=""
                                width="200px"></td>
                        <td class="mb-1">{{ $book->clothes->product }}</td>
                    </tr>
                    <tr>
                        <td>size: {{ $book->size_cloth }} | {{ $book->quantity }} items ({{ $book->weight_product }}
                            gr)
                        </td>
                    </tr>
                    <tr>
                        <td>Rp. {{ number_format($book->subtotal, 0, ',', '.') }} </td>
                    </tr>

                </table>
            @endforeach
            <hr>
            <h6 align='right'>Rp. {{ number_format($subtotal, 0, ',', '.') }}</h6>
        </div>


        <div class="col-md-8 col-lg-5 order-md-last">
            <h6 class="mb-3">Shipping Method</h6>
            @foreach ($booking as $book)
                @foreach ($admin as $item)
                    @if ($item->id === $book->admin_id)
                        <input type="hidden" value="{{ $item->city }}" id="id_hometown" name="id_hometown">
                    @endif
                @endforeach
            @endforeach

            <input type="hidden" value="{{ $user->city }}" id="id_destination_city" name="id_destination_city">
            <input type="hidden" value="{{ $weight }}" id="weight" name="weight">
            <select class="form-select mb-3" id="courier" name="courier" onchange="cekCost();">
                <option value="">Select Courier</option>
                <option value="jne">JNE</option>
                <option value="tiki">TIKI</option>
                <option value="pos">Pos Indonesia</option>
            </select>


            {{-- shiiping duration --}}
            <div id="cost"></div>


            <h6 class="mb-3">Shopping summary</h6>
            <table class="table table-borderless">
                <tr>
                    <td>Subtotal ({{ $quantity }} Products) </td>
                    <td Rp. align="right">Rp. {{ number_format($subtotal, 0, ',', '.') }}</td>
                    <input type="hidden" value="{{ $subtotal }}" id="subtotal">
                </tr>
                <tr>
                    <td>Shipping Fee</td>
                    <td align="right" id="result"></td>
                </tr>
                <tr class="border-top">
                    <td>Total</td>
                    <td align="right" id="total"></td>
                </tr>
            </table>
            <form action="/payment" method="get">
                @csrf
                {{-- <input type="hidden" value="{{ $subtotal }}" name="subtotal"> --}}
                <input type="hidden" id="costProduct" value="" name="cost">
                <input type="hidden" id="service" value="" name="service">
                <input type="hidden" id="etd" value="" name="etd">
                <input type="hidden" id="totalProduct" value="" name="total">
                <input type="hidden" id="courierName" value="" name="courier_name">
                <input type="hidden" value="{{ $user->id }}" name="user_booking_id">
                <input type="hidden" value="{{ $user->name }}" name="name">
                <input type="hidden" value="{{ $user->email }}" name="email">
                <input type="hidden" value="{{ $user->phone_number }}" name="phone_number">
                {{-- <input type="hidden" value="{{ $quantity }}" name="quantity"> --}}
                @foreach ($booking as $book)
                    <input type="hidden" value="{{ $book->quantity }}" name="quantity">
                    <input type="hidden" value="{{ $book->clothes_id }}" name="clothes_id">
                    <input type="hidden" value="{{ $book->clothes->product }}" name="product">
                    <input type="hidden" value="{{ $book->clothes->price }}" name="price">
                    <input type="hidden" value="{{ $book->id }}" name="booking_id">
                    <input type="hidden" value="{{ $book->admin_id }}" name="admin_id">
                    <input type="hidden" value="{{ $book->size_cloth }}" name="size_cloth">
                @endforeach

                <button type="submit">Lanjut</button>
            </form>
        </div>
    </div>
    </body>

    </html>
    <script>
        function cekCost() {
            var id_hometown = document.getElementById('id_hometown').value;
            var id_destination_city = document.getElementById('id_destination_city').value;
            var weight = document.getElementById('weight').value;
            var courier = document.getElementById('courier').value;

            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                document.getElementById("cost").innerHTML = this.responseText;
            }
            xmlhttp.open("GET",
                "http://127.0.0.1:8000/shipping?id_hometown=" + id_hometown + "&id_destination_city=" +
                id_destination_city + "&weight=" + weight + "&courier=" + courier, true);
            xmlhttp.send();

        }

        function costCourier() {

            var array = document.getElementById("shipping").value;
            var costs = JSON.parse(array);


            var subtotal = document.getElementById("subtotal").value;
            var total = parseInt(costs.cost) + parseInt(subtotal);
            var courier = document.getElementById('courier').value;
            document.getElementById("result").innerHTML = "Rp." + costs.cost;
            document.getElementById("total").innerHTML = "Rp." + total;
            document.getElementById("costProduct").value = costs.cost;
            document.getElementById("service").value = costs.service;
            document.getElementById("etd").value = costs.etd;
            document.getElementById("totalProduct").value = total;
            document.getElementById("courierName").value = courier;
        }
    </script>
@endsection
