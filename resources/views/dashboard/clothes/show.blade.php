@extends('dashboard.layouts.main')

@section('container')
    <div class="container">
        <div class="row my-3">
            <div class="col-lg-11">
                <h1 class="mb-3">{{ $clothes->product }}</h1>
                <a href="/dashboard/clothes" class="btn btn-success"><span data-feather="arrow-left"></span> Back to my
                    Catalog</a>
                <a href="/dashboard/clothes/{{ $clothes->slug }}/edit" class="btn btn-warning"><span
                        data-feather="edit"></span> Edit</a>

                <form action="/dashboard/clothes/{{ $clothes->slug }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><span
                            data-feather="delete"></span> Delete</button>
                </form>



                <div class="row g-5 mb-5 mt-3">
                    <div class="col-md-5 col-lg-7 order-md-last">
                        <h4 class="mb-3">{{ $clothes->product }}</h4>
                        <h3>Rp. {{ number_format($clothes->price, 2, ',', '.') }} </h3>
                        <h6>Size: </h6>
                        <button type="button"
                            class="btn btn-outline-danger {{ $clothes->s > 0 ? 'active' : 'disabled' }}">S
                            {{ $clothes->s }}</button>
                        <button type="button"
                            class="btn btn-outline-danger {{ $clothes->m > 0 ? 'active' : 'disabled' }}">M
                            {{ $clothes->m }}</button>
                        <button type="button"
                            class="btn btn-outline-danger {{ $clothes->l > 0 ? 'active' : 'disabled' }}">L
                            {{ $clothes->l }}</button>
                        <button type="button"
                            class="btn btn-outline-danger {{ $clothes->xl > 0 ? 'active' : 'disabled' }}">XL
                            {{ $clothes->xl }}</button>
                        <button type="button"
                            class="btn btn-outline-danger {{ $clothes->xxl > 0 ? 'active' : 'disabled' }}">XXL
                            {{ $clothes->xxl }}</button>

                        <article class="my-3 fs-9">
                            <hr>
                            <p>Category: {{ $clothes->category->name }}</p>
                            {!! $clothes->description !!}

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





                {{-- 
                <article class="my-3 fs-5">
                    @if ($clothes->image)
                        <img src="{{ asset('storage/' . $clothes->image) }}" class="img-fluid mt-3"
                            alt="{{ $clothes->category->name }}">
                    @else
                        <img src="https://source.unsplash.com/1200x400?{{ $clothes->category->name }}"
                            class="img-fluid mt-3" alt="{{ $clothes->category->name }}">
                    @endif


                    {!! $clothes->description !!}
                </article> --}}
            </div>
        </div>
    </div>
@endsection
