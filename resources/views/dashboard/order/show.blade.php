@extends('dashboard.layouts.main')

@section('container')
    <div class="container">
        <div class="row my-3">
            <div class="col-lg-8">

                <h3>Transaction Detail</h3>
                <p> No. Invoice : {{ $orders->order_id }} </p>
                <p>Tanggal Pembelian : {{ $orders->created_at->format('d-M-Y h:i') }}</p>



                <h3>Product Details</h3>
                <table class="table border border-4">
                    <tr>
                        <td rowspan="3" class="col-2"><img src="{{ asset('storage/' . $orders->clothes->image) }}"
                                width="100px" alt="">
                        </td>
                        <td class="col-4">{{ $orders->clothes->product }}
                            <br>
                            <div style="text-transform: uppercase;">
                                {{ $orders->size_cloth }}
                            </div>
                            {{ $orders->quantity }} ({{ $orders->clothes->weight }} gr) x
                            Rp.{{ number_format($orders->clothes->price, 0, ',', '.') }}
                        </td>
                        <td class="col-2">Total Price
                            <br>
                            Rp. {{ number_format($orders->gross_amount, 0, ',', '.') }}
                        </td>
                    </tr>
                </table>
                <h3>Shipping Info</h3>
                <p>Ongkir kembali jika pesanan tiba lebih dari
                    {{ intval($orders->etd) + intval($day) . ' ' . $month . ' ' . $year }} 23:59 (ada
                    keterlambatan
                    penyerahan barang ke
                    kurir).</p>
                <table class="table  border border-4">
                    <tr>
                        <td class="">Courier</td>
                        <td style="text-transform: uppercase;">: {{ $orders->courier . ' - ' . $orders->service }}</td>
                    </tr>
                    <tr>
                        <td class="">Order Id</td>
                        <td>: {{ $orders->order_id }}</td>
                    </tr>
                    <tr>
                        <td class="">Address</td>
                        <td>: <b>{{ $orders->author->name }}</b>
                            <p>{{ $orders->author->phone_number }}
                                <br>{{ $orders->author->address }}

                                @foreach ($provinces as $provinces)
                                    @if ($provinces->province_id === $orders->author->province)
                                        {{ $provinces->province }},
                                    @endif
                                @endforeach
                                @foreach ($cities as $city)
                                    @if ($city->city_id === $orders->author->city)
                                        {{ $city->type }}
                                        {{ $city->city_name }},
                                    @endif
                                @endforeach
                                {{ $orders->author->zip_code }}
                            </p>
                        </td>
                    </tr>
                </table>

                <hr>
                <h3>Payment Details</h3>

                <table class="table border border-4">
                    <tr>
                        <td>Payment Method</td>
                        <td align="right">{{ $orders->payment_type }}</td>
                    </tr>
                    <tr>
                        <td>Total Price</td>
                        <td align="right">{{ $orders->payment_type }}</td>
                    </tr>
                    <tr>
                        <td>Total Shipping Cost</td>
                        <td align="right">{{ $orders->payment_type }}</td>
                    </tr>
                    <tr>
                        <td>
                            <h6>Total Spend</h6>
                        </td>
                        <td align="right">{{ $orders->gross_amount }}</td>
                    </tr>
                </table>
            </div>
        </div>


    </div>
@endsection
