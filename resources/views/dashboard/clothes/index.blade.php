@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Catalog</h1>
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

        <a href="/dashboard/clothes/create" class="btn btn-primary mb-3">Add a product</a>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Product</th>
                    <th scope="col">Category</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clothes as $cloth)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $cloth->product }}</td>
                        <td>{{ $cloth->category->name }}</td>
                        <td class="card-text">{{ $cloth->s + $cloth->m + $cloth->l + $cloth->xl + $cloth->xxl }}</td>

                        {{-- <td>{{ $cloth->description }}</td> --}}
                        <td>Rp. {{ $cloth->price }}</td>
                        <td>
                            <a href="/dashboard/clothes/{{ $cloth->slug }}" class="badge bg-info"><span
                                    data-feather="eye"></span></a>
                            <a href="/dashboard/clothes/{{ $cloth->slug }}/edit" class="badge bg-warning"><span
                                    data-feather="edit"></span></a>
                            <form action="/dashboard/clothes/{{ $cloth->slug }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span
                                        data-feather="delete"></span></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
