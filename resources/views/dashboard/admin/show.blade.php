@extends('dashboard.layouts.main')


@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Profile Admin</h1>
    </div>
    <div class="col-lg-8">
        <form action="/dashboard/admins/{{ $admins->id }}" method="POST" class="mb-5">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text"
                    class="form-control @error('name')
                    is-invalid
                @enderror"
                    id="name" name="name" required value="{{ old('name', $admins->name) }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text"
                    class="form-control @error('username')
                    is-invalid
                @enderror"
                    id="username" name="username" required value="{{ old('username', $admins->username) }}">
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email"
                    class="form-control @error('email')
                    is-invalid
                @enderror"
                    id="email" name="email" required readonly value="{{ old('email', $admins->email) }}">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text"
                    class="form-control @error('phone_number')
                    is-invalid
                @enderror"
                    id="phone_number" name="phone_number" required value="{{ old('phone_number', $admins->phone_number) }}">
                @error('phone_number')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text"
                    class="form-control @error('address')
                    is-invalid
                @enderror"
                    id="address" name="address" required value="{{ old('address', $admins->address) }}">
                @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="province" class="form-label">Province</label>
                <select class="form-select" name="province" onchange="findCity(this.value)">
                    <option selected>Choose City...</option>
                    @foreach ($provinces as $province)
                        <option value="{{ $province->province_id }}">{{ $province->province }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">City</label>
                <select id="city" name="city" class="form-select">
                    <option selected>Choose City...</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="zip_code" class="form-label">Zip Code</label>
                <input type="text"
                    class="form-control @error('zip_code')
                    is-invalid
                @enderror"
                    id="zip_code" name="zip_code" required value="{{ old('zip_code', $admins->zip_code) }}">
                @error('zip_code')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update Admin Profile</button>
            <a href="/dashboard/admins/" class="btn btn-outline-dark text-decoration-none">Back</a></button>
        </form>
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
