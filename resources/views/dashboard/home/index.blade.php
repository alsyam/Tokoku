@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Set the banner display on the home page</h1>
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
        @if ($count < 1)
            <a href="/dashboard/home/create" class="btn btn-primary mb-3">Add a Banner</a>
        @endif
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Banner 1</th>
                    <th scope="col">Banner 2</th>
                    <th scope="col">Banner 3</th>
                    <th scope="col">Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($homes as $home)
                    <tr>
                        <td> <img src="{{ asset('storage/' . $home->banner) }}" class="img-fluid" max="200px">
                        </td>
                        <td> <img src="{{ asset('storage/' . $home->banner2) }}" class="img-fluid" max="200px">
                        </td>
                        <td> <img src="{{ asset('storage/' . $home->banner3) }}" class="img-fluid" max="200px">
                        </td>
                        <td>
                            {{-- <a href="/dashboard/clothes/{{ $cloth->slug }}" class="badge bg-info"><span
                                data-feather="eye"></span></a> --}}
                            <a href="/dashboard/home/{{ $home->id }}/edit" class="badge bg-warning"><span
                                    data-feather="edit"></span></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
