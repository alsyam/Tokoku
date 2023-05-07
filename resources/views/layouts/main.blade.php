<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{-- Checkout Form --}}
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/checkout/">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="/css/form-validation.css" rel="stylesheet">

    {{-- Bootstrap icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <title>Tokoku | {{ $title }}</title>

    {{-- my style --}}
    <link rel="stylesheet" href="/css/style.css">


</head>

<body>
    @include('partials.navbar')

    <div class="container mt-4">
        @yield('container')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    {{-- checkout form --}}
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/form-validation.js"></script>

</body>
<hr class="featurette-divider">
<!-- FOOTER -->
<footer class="container py-5">
    <div class="row">
        <div class="col-3 col-md">
            <h5>Features</h5>
            <ul class="list-unstyled text-small">
                <li><a class="link-secondary" href="#">Cool stuff</a></li>
                <li><a class="link-secondary" href="#">Random feature</a></li>
                <li><a class="link-secondary" href="#">Team feature</a></li>
            </ul>
        </div>
        <div class="col-3 col-md">
            <h5>About</h5>
            <ul class="list-unstyled text-small">
                <li><a class="link-secondary" href="#">Team</a></li>
                <li><a class="link-secondary" href="#">Locations</a></li>
            </ul>
        </div>
        <div class="col-3 col-md">
            <h5>Follow us</h5>
            <ul class="list-unstyled d-inline-flex">
                <li><a class="link-secondary p-3" href="https://www.instagram.com/alsyamah/"><i
                            class="bi bi-instagram"></i></a></li>
                <li><a class="link-secondary p-3" href="https://www.instagram.com/alsyamah/"><i
                            class="bi bi-whatsapp"></i></a></li>
                <li><a class="link-secondary p-3" href="https://www.instagram.com/alsyamah/"><i
                            class="bi bi-facebook"></i></a></li>
            </ul>
        </div>
        <div class="col-3 col-md">
            <p class="float-end"><a href="#" class="text-decoration-none text-dark">Back to
                    top <i class="bi bi-arrow-bar-up"></i></a></p>
        </div>
    </div>

    <small class="d-block mb-3 text-muted text-center">&copy; 2023, TOKOKU</small>
</footer>

</html>
