@extends('dashboard.layouts.main')


@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add New Product</h1>
    </div>
    <div class="col-lg-8">
        <form action="/dashboard/home" method="POST" class="mb-5" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="banner" class="form-label">Banner 1</label>
                <img class="img-preview img-fluid mb-3 col-sm-5">
                <input class="form-control @error('banner') is-invalid @enderror" type="file" id="banner"
                    name="banner" onchange="previewBanner()">
            </div>
            @error('banner')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror


            <div class="mb-3">
                <label for="banner2" class="form-label">Product banner 2</label>
                <img class="img-preview-two img-fluid mb-3 col-sm-5">
                <input class="form-control @error('banner2') is-invalid @enderror" type="file" id="bannertwo"
                    name="banner2" onchange="previewBannerTwo()">
            </div>
            @error('banner2')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror


            <div class="mb-3">
                <label for="banner3" class="form-label">Product banner 3</label>
                <img class="img-preview-three img-fluid mb-3 col-sm-5">
                <input class="form-control @error('banner3') is-invalid @enderror" type="file" id="bannerthree"
                    name="banner3" onchange="previewBannerThree()">
            </div>
            @error('banner3')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            <button type="submit" class="btn btn-primary">Add New Banner</button>
        </form>
    </div>



    <script>
        // for image preview
        function previewBanner() {
            const banner = document.querySelector('#banner');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(banner.files[0]);


            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function previewBannerTwo() {
            const banner = document.querySelector('#bannertwo');
            const imgPreview = document.querySelector('.img-preview-two');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(banner.files[0]);


            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function previewBannerThree() {
            const banner = document.querySelector('#bannerthree');
            const imgPreview = document.querySelector('.img-preview-three');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(banner.files[0]);


            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
        z
    </script>
@endsection
