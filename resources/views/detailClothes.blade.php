@extends('layouts/main')

@section('container')
    @if (session()->has('success'))
        <div class="alert alert-info text-center" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="row g-5 mb-5">
        <div class="col-md-5 col-lg-7 order-md-last">
            <h4 class="mb-3">{{ $clothes->product }}</h4>
            <h3>Rp. {{ number_format($clothes->price, 2, ',', '.') }} </h3>
            <article class="my-3 fs-9">
                <hr>
                <p>Category: {{ $clothes->category->name }}</p>
                {!! $clothes->description !!}


                <form action="/booking" method="POST" enctype="multipart/form-data">
                    @csrf
                    <select class="form-select mb-3" id="size_cloth" name="size_cloth">
                        <option value="s">Size: S</option>
                        <option value="m">Size: M</option>
                        <option value="l">Size: L</option>
                        <option value="xl">Size: XL</option>
                        <option value="xxl">Size: XXL </option>
                    </select>
                    <input type="number" min="1" max="5" class="form-control mb-3" id="quantity"
                        name="quantity" value="1">
                    <input type="hidden" value="{{ $clothes->weight }}" name="weight_product" id="weight_product">
                    <input type="hidden" value="{{ $clothes->user_id }}" name="admin_id" id="admin_id">
                    <input id="clothes_id" type="hidden" name="clothes_id" value="{{ $clothes->id }}">
                    <input id="slug" type="hidden" name="slug" value="{{ $clothes->slug }}">
                    <button type="submit" class="btn btn-danger">Add
                        to shopping cart</button>
                    <a href="/" class="btn btn-outline-secondary">Back to Clothes</a>
                </form>
                <hr>
            </article>




        </div>
        <div class="col-md-7 col-lg-5">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @if ($clothes->image)
                        <div class="carousel-item active">
                            <img src="{{ asset('storage/' . $clothes->image) }}" class="d-block w-100"
                                alt="{{ $clothes->category->name }}">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('storage/' . $clothes->image2) }}" class="d-block w-100"
                                alt="{{ $clothes->category->name }}">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('storage/' . $clothes->image3) }}" class="d-block w-100"
                                alt="{{ $clothes->category->name }}">
                        </div>
                    @else
                        <div class="carousel-item active">
                            <img src="https://source.unsplash.com/200x250?{{ $clothes->category->name }}"
                                class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="https://source.unsplash.com/200x250?{{ $clothes->category->name }}"
                                class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="https://source.unsplash.com/200x250?{{ $clothes->category->name }}"
                                class="d-block w-100" alt="...">
                        </div>
                    @endif




                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
@endsection





{{-- <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <h1 class="mb-3">{{ $clothes->brand }}</h1>
                <p>By. <a href="/clothes?author={{ $clothes->author->username }}"
                        class="text-decoration-none">{{ $clothes->author->name }}</a> in
                    <a href="/clothes?category={{ $clothes->category->slug }}"
                        class="text-decoration-none">{{ $clothes->category->name }}</a>
                </p>

                <img src="https://source.unsplash.com/1200x400?{{ $clothes->category->name }}" class="img-fluid"
                    alt="{{ $clothes->category->name }}">
                <article class="my-3 fs-5">

                    {!! $clothes->description !!}
                </article>

                <a href="/clothes" class="d-block mt-3">Back to Clothes</a>
            </div>
        </div>
    </div> --}}
{{-- @endsection --}}
