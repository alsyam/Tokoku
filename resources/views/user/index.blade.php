@extends('layouts.main')

@section('container')
    <h1>Halaman Profile</h1>
    <div class="row">
        <div class="col-md-12">
            <!-- Content -->
            <div class="card">
                <div class="card-header">
                    <ul class="navbar-nav ms-auto flex-row justify-content-between">
                        <li class="nav-item">
                            <a class="nav-link {{ $activeNavItem === 'personalInfo' ? 'active' : '' }}"
                                href="#">Personal Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeNavItem === 'Purchase History' ? 'active' : '' }}"
                                href="#">Purchase History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeNavItem === 'Address Book' ? 'active' : '' }}"
                                href="#">Address Book</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeNavItem === 'Access Data' ? 'active' : '' }}" href="#">Access
                                Data</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeNavItem === 'Whislits' ? 'active' : '' }}"
                                href="#">Whislits</a>
                        </li>

                    </ul>
                </div>
                <div class="card-body">
                    <form action="profile/{{ $users->id }}" method="POST">
                        @csrf
                        {{-- @method('post') --}}
                        <div class="form-group mb-2">
                            <label for="fullname">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter your full name" value="{{ $users->name }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                value="{{ $users->username }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter email" value="{{ $users->email }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number"
                                placeholder="Enter phone number" value="{{ $users->phone_number }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" id="password" name="password"
                                placeholder="Enter password" required>
                        </div>
                        <input type="hidden" name="address" value="{{ $users->address }}">
                        <input type="hidden" name="id" value="{{ $users->id }}">
                        <input type="hidden" name="city" value="{{ $users->city }}">
                        <input type="hidden" name="province" value="{{ $users->province }}">
                        <input type="hidden" name="zip_code" value="{{ $users->zip_code }}">
                        <button type="submit" class="btn btn-primary mt-3">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
