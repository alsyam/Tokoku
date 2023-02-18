@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Order List</h1>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-info col-lg-8" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('alert-success'))
        <script>
            alert('{{ session('alert-success') }}')
        </script>
    @elseif (session('alert-failed'))
        <script>
            alert('{{ session('alert-failed') }}')
        </script>
    @endif
    <div class="table-responsive col-lg-8">

        {{-- <a href="/dashboard/clothes/create" class="btn btn-primary mb-3">Add a product</a> --}}
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Date</th>
                    <th scope="col">Order Id</th>
                    {{-- <th scope="col">Product</th> --}}
                    <th scope="col">Customer</th>
                    {{-- <th scope="col">Size</th> --}}
                    {{-- <th scope="col">Qty</th> --}}
                    <th scope="col">Price</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- {{ $nomor = 1 }} --}}
                @foreach ($orders as $index => $order)
                    @if ($index == 0 || $orders[$index - 1]->order_id != $order->order_id)
                        <tr>
                            {{-- @if ($order->id != $last_order_id + 1)
                                <td>{{ $nomor += $order->id - ($last_order_id + 1) }}</td>
                            @endif --}}
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $order->created_at->format('l, j F Y, H:i:s') }}</td>
                            <td>{{ $order->order_id }}</td>
                            {{-- <td>{{ $order->clothes->product }}</td> --}}
                            <td>{{ $order->author->name }}</td>
                            {{-- <td>{{ $order->size_cloth }}</td> --}}
                            {{-- <td> {{ $order->quantity }} pcs</td> --}}
                            <td>Rp. {{ number_format($order->gross_amount, 0, ',', '.') }}</td>
                            @if ($order->status === 'settlement')
                                <td class="text-success font-weight-bold text-uppercase">{{ $order->status }}</td>
                            @elseif($order->status === 'pending')
                                <td class="text-danger font-weight-bold text-uppercase">{{ $order->status }}</td>
                            @endif

                            <td>
                                <a href="/dashboard/order/{{ $order->order_id }}" class="badge bg-info"><span
                                        data-feather="eye"></span></a>
                                <form action="/dashboard/order/{{ $order->id }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span
                                            data-feather="delete"></span></button>
                                </form>
                            </td>
                        </tr>
                        {{-- {{ $last_order_id = $order->id
                        $nomor++ }} --}}
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
