@extends('layouts.main')

@section('container')
    <h1 class="mb-3 text-center">{{ $title }}</h1>
    @if (session()->has('success'))
        <div class="alert alert-info text-center" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="row justify-content-center mb-3">
        <div class="col-6">
            <form action="/clothes">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if (request('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
                @endif
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="search" name="search"
                        value="{{ request('search') }}">
                    <button class="btn btn-outline-danger" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>


    {{-- for slider --}}
    @if ($clothes->count())
        {{-- <div class="card mb-3">
            @if ($clothes[0]->image)
                <img style="width: 500px; height: 300px;" src="{{ asset('storage/' . $clothes[0]->image) }}"
                    class="card-img-top" alt="{{ $clothes[0]->category->name }}">
            @else
                <img src="https://source.unsplash.com/1200x400?{{ $clothes[0]->category->name }}" class="card-img-top"
                    alt="{{ $clothes[0]->category->name }}">
            @endif


            <div class="card-body text-center">
                <a href="/clothes/{{ $clothes[0]->slug }}" class="text-decoration-none text-dark">
                    <h3 class="card-title">{{ $clothes[0]->brand }}</h3>
                </a>
                <p>
                    <small class="text-muted">
                        By. <a href="/clothes?author={{ $clothes[0]->author->username }}"
                            class="text-decoration-none">{{ $clothes[0]->author->name }}</a>
                        in
                        <a href="/clothes?category={{ $clothes[0]->category->slug }} "
                            class="text-decoration-none">{{ $clothes[0]->category->name }} </a>
                        {{ $clothes[0]->created_at->diffForHumans() }}
                    </small>
                </p>
                <p class="card-text">{!! $clothes[0]->description !!}</p>

                <a href="/clothes/{{ $clothes[0]->slug }}" class="text-decoration-none btn btn-primary">Read more..</a>
            </div>
        </div> --}}

        <div class="container">
            <div class="row">
                @foreach ($clothes as $cloth)
                    <div class="col-md-3 mb-5">
                        <div class="card">
                            <div class="position-absolute px-3 py-2 text-white" style="background-color: rgba( 0,0,0, 0.7)">
                                <a href="/clothes?category={{ $cloth->category->slug }}"
                                    class="text-decoration-none text-white">{{ $cloth->category->name }}</a>
                            </div>


                            {{-- pengecekan apakah ada image atau tidak --}}
                            @if ($cloth->image)
                                <img src="{{ asset('storage/' . $cloth->image) }}" class="img-fluid" max="500px"
                                    alt="{{ $cloth->category->name }}">
                            @else
                                <img src="https://source.unsplash.com/500x400?{{ $cloth->category->name }}"
                                    class="card-img-top" alt="{{ $cloth->category->name }}">
                            @endif

                            <div class="card-body">
                                <a href="/clothes/{{ $cloth->slug }}" class="text-decoration-none text-dark">
                                    <h5 class="card-title">{{ $cloth->brand }}</h5>
                                </a>
                                {{-- <p>
                                    <small class="text-muted">
                                        By. <a href="/clothes?author={{ $cloth->author->username }}"
                                            class="text-decoration-none">{{ $cloth->author->name }}</a>
                                        {{ $cloth->created_at->diffForHumans() }}
                                    </small>
                                </p> --}}
                                <p class="card-text">{{ $cloth->product }}</p>
                                {{-- <p class="card-text">{{ $cloth->author->name }}</p> --}}
                                <p class="card-text">Rp. {{ number_format($cloth->price, 0, ',', '.') }}</p>
                                <a href="/clothes/{{ $cloth->slug }}" class="btn btn-primary btn-sm">Read more..</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <p class="text-center fs-4">NO CLOTHES FOUND!</p>
    @endif

    <div class="d-flex justify-content-end">

        {{ $clothes->links() }}
    </div>
@endsection
