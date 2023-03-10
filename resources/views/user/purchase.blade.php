@extends('layouts.main')

@section('container')
    <h1>Halaman Profile</h1>
    <div class="row">
        <div class="col-md-12">
            <!-- Content -->
            <div class="card">
                <div class="card-header">
                    <ul class="navbar-nav ms-auto flex-row justify-content-between">
                        <li class="nav-item">
                            <a class="nav-link {{ $activeNavItem === 'personalInfo' ? 'active' : '' }}"
                                href="/profile">Personal Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeNavItem === 'Purchase History' ? 'active' : '' }}"
                                href="/purchase">Purchase History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeNavItem === 'Address Book' ? 'active' : '' }}"
                                href="/address">Address Book</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeNavItem === 'Access Data' ? 'active' : '' }}" href="#">Access
                                Data</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeNavItem === 'Whislits' ? 'active' : '' }}"
                                href="#">Whislits</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    @foreach ($orders as $index => $order)
                        @if ($index == 0 || $orders[$index - 1]->order_id != $order->order_id)
                            <table class="table border border-4">
                                <tr>
                                    <td colspan="4">{{ $order->created_at->format('l, j F Y, H:i:s') }} <span
                                            class="badge bg-success">{{ $order->status }}</span>
                                        INV/{{ $order->order_id }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-2"><img src="{{ asset('storage/' . $order->clothes->image) }}"
                                            width="100px" alt="">
                                    </td>
                                    <td class="col-4">
                                        <div>
                                            <h6>{{ $order->clothes->product }}</h6>
                                        </div>
                                        <div class="fw-light" style="text-transform: uppercase;">
                                            {{ $order->size_cloth }}
                                        </div>
                                        <div class="fw-light">
                                            {{ $order->quantity }} ({{ $order->clothes->weight }} gr) x
                                            Rp.{{ number_format($order->clothes->price, 0, ',', '.') }}
                                        </div>
                                    </td>
                                    <td class="col-2">Total Price
                                        <br>
                                        Rp. {{ number_format($order->gross_amount, 0, ',', '.') }}
                                        <br>
                                        <!-- Button trigger modal -->
                                        <a href="/profile/purchase/{{ $order->order_id }}"
                                            class="text-decoration-none badge bg-primary mt-2" data-feather="eye">Detail</a>
                                        {{-- <span type="button" class="badge bg-primary mt-2" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal" data-order-id="{{ $order->order_id }}">
                                            Detail
                                        </span> --}}

                                    </td>
                                </tr>
                            </table class="mb-5">
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Transaction Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                {{-- {{ $orderDetail->order_id }} --}}
                {{-- <h3>Transaction Detail</h3>
                <p> No. Invoice : {{ $order->order_id }} </p>
                <p>Tanggal Pembelian : {{ $order->created_at->format('d-M-Y h:i') }}</p>



                <h3>Product Details</h3>
                <table class="table border border-4">
                    @foreach ($orders as $index => $order)
                        <tr>
                            <td class="col-2"><img src="{{ asset('storage/' . $order->clothes->image) }}"
                                    width="100px" alt="">
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
                                {{ $totalPrice += $order->clothes->price * $order->quantity }}
                            @endforeach
                            Rp. {{ number_format($totalPrice, 0, ',', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <td>Total Shipping Cost</td>
                        <td align="right">Rp. {{ number_format($order->gross_amount - $totalPrice, 0, ',', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h6>Total Spend</h6>
                        </td>
                        <td align="right">
                            <h6>Rp. {{ number_format($order->gross_amount, 0, ',', '.') }}</h6>
                        </td>
                    </tr>
                </table> --}}
            </div>
        </div>
    </div>
</div>
