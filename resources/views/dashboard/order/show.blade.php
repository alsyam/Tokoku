@extends('dashboard.layouts.main')

@section('container')
    <div class="container">
        <div class="row my-3">
            <div class="col-lg-8">
                <h3>Transaction Detail</h3>
                <p> No. Invoice : {{ $order->order_id }} </p>
                <p>Tanggal Pembelian : {{ $order->created_at->format('d-M-Y h:i') }}</p>



                <h3>Product Details</h3>
                <table class="table border border-4">
                    @foreach ($orders as $index => $order)
                        <tr>
                            <td class="col-2"><img src="{{ asset('storage/' . $order->clothes->image) }}" width="100px"
                                    alt="">
                            </td>
                            <td class="col-4">{{ $order->clothes->product }}
                                <br>
                                <div style="text-transform: uppercase;">
                                    {{ $order->size_cloth }}
                                </div>
                                {{ $order->quantity }} ({{ $order->clothes->weight }} gr) x
                                Rp.{{ number_format($order->clothes->price, 0, ',', '.') }}
                            </td>
                            <td class="col-2">Total Price
                                <br>
                                Rp. {{ number_format($order->quantity * $order->clothes->price, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </table>
                <h3>Shipping Info</h3>
                <p>Ongkir kembali jika pesanan tiba lebih dari
                    {{ intval($order->etd) + intval($day) . ' ' . $month . ' ' . $year }} 23:59 (ada
                    keterlambatan
                    penyerahan barang ke
                    kurir).</p>
                <table class="table  border border-4">
                    <tr>
                        <td class="">Courier</td>
                        <td style="text-transform: uppercase;">: {{ $order->courier . ' - ' . $order->service }}
                        </td>
                    </tr>
                    <tr>
                        <td class="">Order Id</td>
                        <td>: {{ $order->order_id }}</td>
                    </tr>
                    <tr>
                        <td class="">Address</td>
                        <td>: <b>{{ $order->author->name }}</b>
                            <p>{{ $order->author->phone_number }}
                                <br>{{ $order->author->address }}

                                @foreach ($provinces as $provinces)
                                    @if ($provinces->province_id === $order->author->province)
                                        {{ $provinces->province }},
                                    @endif
                                @endforeach
                                @foreach ($cities as $city)
                                    @if ($city->city_id === $order->author->city)
                                        {{ $city->type }}
                                        {{ $city->city_name }},
                                    @endif
                                @endforeach
                                {{ $order->author->zip_code }}
                            </p>
                        </td>
                    </tr>
                </table>

                <hr>
                <h3>Payment Details</h3>

                <table class="table border border-4">
                    <tr>
                        <td>Payment Method</td>
                        <td align="right">{{ $order->payment_type }}</td>
                    </tr>
                    <tr>
                        <td>Total Price</td>
                        <td align="right">
                            @php
                                $totalPrice = 0;
                            @endphp
                            @foreach ($orders as $order)
                                <?php $totalPrice += $order->clothes->price * $order->quantity; ?>
                            @endforeach
                            Rp. {{ number_format($totalPrice, 0, ',', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <td>Total Shipping Cost</td>
                        <td align="right">Rp. {{ number_format($order->gross_amount - $totalPrice, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>
                            <h6>Total Spend</h6>
                        </td>
                        <td align="right">
                            <h6>Rp. {{ number_format($order->gross_amount, 0, ',', '.') }}</h6>
                        </td>
                    </tr>
                </table>
            </div>
        </div>


    </div>
@endsection
