@extends('dashboard.layouts.main')


@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Product</h1>
    </div>
    <div class="col-lg-8">
        <form action="/dashboard/clothes/{{ $clothes->slug }}" method="POST" class="mb-5" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="product" class="form-label">Name Product</label>
                <input type="text"
                    class="form-control @error('product')
                    is-invalid
                @enderror"
                    id="product" name="product" required autofocus value="{{ old('product', $clothes->product) }}">
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
                    id="slug" name="slug" required value="{{ old('slug', $clothes->slug) }}">
                @error('slug')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" name="category_id">
                    @foreach ($categories as $category)
                        @if (old('category_id', $clothes->category_id) == $category->id)
                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            {{-- size chart clothes --}}
            <label class="form-label">Size Chart</label>
            <div class="input-group mb-3 col-lg-2">
                <span class="input-group-text">S</span>
                <input type="number" min="0" max="1000" class="form-control  @error('s') is-invalid @enderror"
                    id="s" name="s" required value="{{ old('s', $clothes->s) }}">
                @error('s')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <span class="input-group-text">M</span>
                <input type="number" min="0" max="1000" class="form-control  @error('m') is-invalid @enderror"
                    id="m" name="m" required value="{{ old('m', $clothes->m) }}">
                @error('m')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <span class="input-group-text">L</span>
                <input type="number" min="0" max="1000" class="form-control  @error('l') is-invalid @enderror"
                    id="l" name="l" required value="{{ old('l', $clothes->l) }}">
                @error('l')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <span class="input-group-text">XL</span>
                <input type="number" min="0" max="1000" class="form-control  @error('xl') is-invalid @enderror"
                    id="xl" name="xl" required value="{{ old('xl', $clothes->xl) }}">
                @error('xl')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <span class="input-group-text">XXL</span>
                <input type="number" min="0" max="1000" class="form-control  @error('xxl') is-invalid @enderror"
                    id="xxl" name="xxl" required value="{{ old('xxl', $clothes->xxl) }}">
                @error('xxl')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                @error('description')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
                <input id="description" type="hidden" name="description"
                    value="{{ old('description', $clothes->description) }}">
                <trix-editor input="description"></trix-editor>
            </div>

            <div class="mb-3">
                <label for="weight" class="form-label">weight</label>
                <input type="number" min="100" max="99999999"
                    class="form-control  @error('weight') is-invalid @enderror" id="weight" name="weight" required
                    value="{{ old('weight', $clothes->weight) }}">
                @error('weight')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" min="0" max="99999999"
                    class="form-control  @error('price') is-invalid @enderror" id="price" name="price" required
                    value="{{ old('price', $clothes->price) }}">
                @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- image --}}
            <div class="mb-3">
                <label for="image" class="form-label">Product Image</label>
                <input type="hidden" name="oldImage" value="{{ $clothes->image }}">
                @if ($clothes->image)
                    <img src="{{ asset('storage/' . $clothes->image) }}"
                        class="img-preview img-fluid mb-3 col-sm-5 d-block">
                @else
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                @endif
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                    name="image" onchange="previewImage() ">
            </div>
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <div class="mb-3">
                <label for="image2" class="form-label">Product Image 2</label>
                <input type="hidden" name="oldImageTwo" value="{{ $clothes->image2 }}">
                @if ($clothes->image2)
                    <img src="{{ asset('storage/' . $clothes->image2) }}"
                        class="img-preview-two img-fluid mb-3 col-sm-5 d-block">
                @else
                    <img class="img-preview-two img-fluid mb-3 col-sm-5">
                @endif
                <input class="form-control @error('image2') is-invalid @enderror" type="file" id="imagetwo"
                    name="image2" onchange="previewImageTwo()">
            </div>
            @error('image2')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <div class="mb-3">
                <label for="image3" class="form-label">Product Image 3</label>
                <input type="hidden" name="oldImageThree" value="{{ $clothes->image3 }}">
                @if ($clothes->image3)
                    <img src="{{ asset('storage/' . $clothes->image3) }}"
                        class="img-preview-three img-fluid mb-3 col-sm-5 d-block">
                @else
                    <img class="img-preview-three img-fluid mb-3 col-sm-5">
                @endif
                <input class="form-control @error('image3') is-invalid @enderror" type="file" id="imagethree"
                    name="image3" onchange="previewImageThree() ">
            </div>
            @error('image3')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror


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


        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        });




        // for image preview
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);


            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function previewImageTwo() {
            const image = document.querySelector('#imagetwo');
            const imgPreview = document.querySelector('.img-preview-two');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);


            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function previewImageThree() {
            const image = document.querySelector('#imagethree');
            const imgPreview = document.querySelector('.img-preview-three');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);


            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
