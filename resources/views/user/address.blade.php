@extends('layouts.main')

@section('container')
    <h1>
        Halaman Profile</h1>
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
                                href="/profile/purchase">Purchase History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeNavItem === 'Address Book' ? 'active' : '' }}"
                                href="/profile/address">Address Book</a>
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
                    <h6>{{ $users->name }}</h6>
                    <div>{{ $users->address }}
                        @foreach ($cities as $city)
                            @if ($city->city_id === $users->city)
                                {{ $city->type }}
                                {{ $city->city_name }},
                            @endif
                        @endforeach
                        @foreach ($provinces as $provinces)
                            @if ($provinces->province_id === $users->province)
                                {{ $provinces->province }},
                            @endif
                        @endforeach
                        {{ $users->zip_code }}
                    </div>
                    <a href="/profile/address/{{ $users->id }}"
                        class="text-decoration-none badge bg-primary mt-2">Edit</a>
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer')
@endsection
