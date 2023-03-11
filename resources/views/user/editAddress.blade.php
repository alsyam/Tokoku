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
                    {{-- <h6>{{ $users->name }}</h6> --}}
                    <form action="/register" method="POST" class="row g-3">
                        @csrf
                        <div class="col-12">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control rounded @error('address') is-invalid @enderror"
                                id="address" name="address" value="{{ $users->address }}">
                        </div>
                        <div class="col-md-6">
                            <label for="province" class="form-label">Province</label>
                            <select class="form-select" name="province" onchange="findCity(this.value)">
                                <option selected>Choose City...</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->province_id }}">{{ $province->province }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">City</label>
                            <select id="city" name="city" class="form-select">
                                <option selected>Choose City...</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="zip_code" class="form-label">Zip Code</label>
                            <input type="text" class="form-control rounded @error('zip_code') is-invalid @enderror"
                                id="zip_code" name="zip_code" value="{{ }}">
                        </div>
                        <div class="col-md-6">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control rounded @error('phone_number') is-invalid @enderror"
                                id="phone_number" name="phone_number" value="{{ old('phone_number') }}">
                        </div>
                        <div class="col-12">
                            <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function findCity(id_provinsi) {

        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
            document.getElementById("city").innerHTML = this.responseText;
        }
        xmlhttp.open("GET", "http://127.0.0.1:8000/city?id_provinsi=" + id_provinsi, true);
        xmlhttp.send();

    }
</script>
