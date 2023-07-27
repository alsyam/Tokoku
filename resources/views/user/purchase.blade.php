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
                        {{-- <li class="nav-item">
                            <a class="nav-link {{ $activeNavItem === 'Access Data' ? 'active' : '' }}" href="#">Access
                                Data</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeNavItem === 'Whislits' ? 'active' : '' }}"
                                href="#">Whislits</a>
                        </li> --}}
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
                                        <a href="/purchase/{{ $order->order_id }}"
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
    @include('partials.footer')
@endsection
