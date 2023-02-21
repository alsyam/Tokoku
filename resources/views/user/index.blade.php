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
                            <a class="nav-link text-decoration-none <?php echo $activeNavItem === 'Personal Info' ? 'active' : ''; ?>" href="#">Personal Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-decoration-none <?php echo $activeNavItem === 'Purchase History' ? 'active' : ''; ?> " href="#">Purchase
                                History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-decoration-none <?php echo $activeNavItem === 'Address Book' ? 'active' : ''; ?>" href="#">Address Book</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-decoration-none <?php echo $activeNavItem === 'Access Data' ? 'active' : ''; ?>" href="#">Access Data</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-decoration-none <?php echo $activeNavItem === 'Whislits' ? 'active' : ''; ?>" href="#">Whislits</a>
                        </li>

                    </ul>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="fullname">Full Name</label>
                            <input type="text" class="form-control" id="fullname" placeholder="Enter your full name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" id="phone" placeholder="Enter phone number">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
