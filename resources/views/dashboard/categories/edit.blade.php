@extends('dashboard.layouts.main')


@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Category</h1>
    </div>
    <div class="col-lg-8">
        <form action="/dashboard/categories/{{ $categories->slug }}" method="POST" class="mb-5"
            enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name Category</label>
                <input type="text"
                    class="form-control @error('name')
                    is-invalid
                @enderror"
                    id="name" name="name" required autofocus value="{{ old('name', $categories->name) }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control  @error('slug')
                is-invalid
            @enderror"
                    id="slug" name="slug" required value="{{ old('slug', $categories->slug) }}">
                @error('slug')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="background" class="form-label">Product Image 3</label>
                <input type="hidden" name="oldBackground" value="{{ $categories->background }}">
                @if ($categories->background)
                    <img src="{{ asset('storage/' . $categories->background) }}"
                        class="previewBg img-fluid mb-3 col-sm-5 d-block">
                @else
                    <img class="previewBg img-fluid mb-3 col-sm-5">
                @endif
                <input class="form-control @error('background') is-invalid @enderror" type="file" id="background"
                    name="background" onchange="previewBackground() ">
                @error('background')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update category</button>
        </form>
    </div>



    <script>
        const product = document.querySelector('#product');
        const slug = document.querySelector('#slug');

        product.addEventListener('change', function() {
            fetch('/dashboard/clothes/checkSlug?product=' + product.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });


        // for  preview
        function previewBackground() {
            const background = document.querySelector('#background');
            const previewBg = document.querySelector('.previewBg');

            previewBg.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(background.files[0]);


            oFReader.onload = function(oFREvent) {
                previewBg.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
