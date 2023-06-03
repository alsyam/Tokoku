@extends('layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Catalog</h1>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-info text-center" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="table-responsive col-lg-12">

        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Image</th>
                    <th scope="col">Product</th>
                    <th scope="col">Size</th>
                    <th scope="col">Quanity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($booking as $book)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ asset('storage/' . $book->clothes->image) }}" alt=""></td>
                        <td>{{ $book->clothes->product }}</td>
                        <td class="text-uppercase">{{ $book->size_cloth }}</td>
                        <form action="/booking/{{ $book->id }}" method="post">
                            @method('put')
                            @csrf
                            <td>
                                <input type="number" min="1" max="{{ $book->clothes[$book->size_cloth] }}"
                                    class="form-control mb-2" id="quantity" name="quantity" value="{{ $book->quantity }}">
                                <button type="submit" class="btn btn-outline-danger">Change</button>
                            </td>
                        </form>
                        <td>Rp. {{ number_format($book->clothes->price, 0, ',', '.') }} </td>
                        <td>Rp. {{ number_format($book->clothes->price * $book->quantity, 0, ',', '.') }} </td>
                        <td>
                            <form action="/booking/{{ $book->id }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><i
                                        class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="/checkout" class="btn btn-danger">Checkout</a>
    </div>
    @include('partials.footer')
@endsection
