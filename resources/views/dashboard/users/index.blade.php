@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Users</h1>
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
    <div class="table-responsive col-lg-12">

        <a href="/dashboard/users/export" class="btn btn-success mb-3 "><span data-feather="align-justify"></span> Export
            Excel</a>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Address</th>
                    <th scope="col">Province</th>
                    <th scope="col">City</th>
                    <th scope="col">Zip Code</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Start at</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->address }}</td>
                        <td>
                            @foreach ($cities as $city)
                                @if ($city->city_id === $user->city)
                                    {{ $city->province }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($cities as $city)
                                @if ($city->city_id === $user->city)
                                    {{ $city->type }}
                                    {{ $city->province_id }}
                                    {{ $city->province }}
                                    {{ $city->city_name }},
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $user->zip_code }}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td>{{ $user->created_at }}</td>

                        <td>
                            <a href="/dashboard/users/{{ $user->username }}" class="badge bg-info"><span
                                    data-feather="eye"></span></a>
                            <form action="/dashboard/users/{{ $user->id }}" method="post" class="d-inline">
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
