@extends('layouts.main')


@section('container')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <main class="form-registration">
                <h1 class="h3 mb-3 fw-normal text-center">Registration Form</h1>

                <form action="/register" method="POST" class="row g-3">
                    @csrf
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control rounded @error('name') is-invalid @enderror"
                            id="name" name="name" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control rounded @error('username') is-invalid  @enderror"
                            id="username" name="username" value="{{ old('username') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control rounded @error('email') is-invalid @enderror"
                            id="email" name="email" value="{{ old('email') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control rounded @error('password') is-invalid @enderror"
                            id="password" name="password">
                        <label for="password">
                    </div>
                    <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control rounded @error('address') is-invalid @enderror"
                            id="address" name="address" value="{{ old('address') }}">
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
                            id="zip_code" name="zip_code" value="{{ old('zip_code') }}">
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
                <small class="d-block  mt-3">Already registered? <a href="/login"> Login</a></small>
            </main>
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





{{-- <form action="/register" method="POST">
                    @csrf
                    <div class="form-floating">
                        <input type="text" name="name"
                            class="form-control rounded-top @error('name') is-invalid @enderror" id="name"
                            placeholder="name" required value="{{ old('name') }}">
                        <label for="name">Name</label>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="text" name="username" class="form-control @error('username') is-invalid  @enderror"
                            id="username" placeholder="username" required value="{{ old('username') }}">
                        <label for="username">Username</label>
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>
                    <div class="form-floating">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" placeholder="email" required value="{{ old('email') }}">
                        <label for="email">Email Address</label>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password"
                            class="form-control rounded-bottom @error('password')
                        is-invalid 
                    @enderror"
                            id="password" placeholder="Password " required>
                        <label for="password">Password</label>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Register</button>
                </form>
                <small class="d-block  mt-3">Already registered? <a href="/login"> Login</a></small>
            </main>
        </div>
    </div>
@endsection --}}
