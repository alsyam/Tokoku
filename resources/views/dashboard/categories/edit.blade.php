@extends('dashboard.layouts.main')


@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Category</h1>
    </div>
    <div class="col-lg-8">
        <form action="/dashboard/categories/{{ $categories->slug }}" method="POST" class="mb-5">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="product" class="form-label">Name Product</label>
                <input type="text"
                    class="form-control @error('product')
                    is-invalid
                @enderror"
                    id="product" name="product" required autofocus value="{{ old('name', $categories->name) }}">
                @error('product')
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


            <button type="submit" class="btn btn-primary">Update Product</button>
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
    </script>
@endsection
