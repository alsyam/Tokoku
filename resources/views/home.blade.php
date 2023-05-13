@extends('layouts.main')

@section('container')
    {{-- for slider --}}
    <div class="card mb-5">
        {{-- @if ($clothes[0]->image) --}}
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>

            </div>
            <div class="carousel-inner">
                @if ($count)
                    <div class="carousel-item active">
                        <img src="{{ asset('storage/' . $home->banner) }}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('storage/' . $home->banner2) }}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('storage/' . $home->banner3) }}" class="d-block w-100" alt="...">
                    </div>
                @else
                    <div class="carousel-item active">
                        <img src="https://source.unsplash.com/1200x400?sale" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="https://source.unsplash.com/1200x400?sale" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="https://source.unsplash.com/1200x400?sale" class="d-block w-100" alt="...">
                    </div>
                @endif
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <h4>Shop Our Category</h4>
    <div class="row mt-2">
        @foreach ($categories as $category)
            <div class="col-md-4">
                <a href="/clothes/?category={{ $category->slug }}">
                    <div class="card bg-dark text-white">
                        <img src="{{ asset('storage/' . $category->background) }}" class="card-img"
                            alt="{{ $category->name }}">
                        <div class="card-img-overlay d-flex align-items-center p-0">
                            <h5 class="card-title text-center flex-fill p-4 fs-3" style="background-color: rgba(0,0,0,0.7)">
                                {{ $category->name }}</h5>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <p class="text-end ">
        <a href="/categories" class="text-dark text-decoration-none">View more</a>
    </p>


    <h4>Latest Products</h4>
    <div class="row mt-2">
        @foreach ($clothes as $cloth)
            <div class="col-md-3 mb-5">
                <div class="card">
                    <div class="position-absolute px-3 py-2 text-white" style="background-color: rgba( 0,0,0, 0.7)">
                        <a href="/clothes?category={{ $cloth->category->slug }}"
                            class="text-decoration-none text-white">{{ $cloth->category->name }}</a>
                    </div>


                    {{-- pengecekan apakah ada image atau tidak --}}
                    @if ($cloth->image)
                        <a href="/clothes/{{ $cloth->slug }}">
                            <img src="{{ asset('storage/' . $cloth->image) }}" class="img-fluid" max="500px"
                                alt="{{ $cloth->category->name }}">
                        </a>
                    @else
                        <img src="https://source.unsplash.com/500x400?{{ $cloth->category->name }}" class="card-img-top"
                            alt="{{ $cloth->category->name }}">
                    @endif

                    <div class="card-body">
                        <a href="/clothes/{{ $cloth->slug }}" class="text-decoration-none text-dark">
                            <p class="card-title">{{ $cloth->product }}</p>
                        </a>
                        <h6 class="card-text">Rp. {{ number_format($cloth->price, 0, ',', '.') }}</h6>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
