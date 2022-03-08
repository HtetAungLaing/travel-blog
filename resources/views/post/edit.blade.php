@extends('layouts.master')
@section('content')
    <section class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <div>
                    <h3 class="my-3 text-black-50">
                        Edit Here
                    </h3>
                    <form action="{{ route('post.update', $post->id) }}" id="post-update" method="post"
                        enctype='multipart/form-data'>
                        @csrf
                        @method('put')
                        <div class="form-floating mb-3">
                            <input required type="text" class="form-control @error('title') is-invalid @enderror"
                                id="floatingInput" placeholder="Post's Title" name="title"
                                value="{{ old('title', $post->title) }}">
                            <label for="floatingInput">Post Title</label>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <input type="file" name="cover" id="cover-input" accept="image/png,image/jpeg"
                            class="d-none">
                        <div class="mb-3">
                            <img src="{{ asset('storage/cover/' . $post->cover) }}" id="cover-img"
                                class="w-100 cover-upload rounded" alt="">
                            @error('cover')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-floating mb-3">
                            <textarea required style="height: 10rem" type="text"
                                class="form-control @error('description') is-invalid @enderror" id="floatingInput"
                                placeholder="Post's Description"
                                name="description">{{ old('description', $post->description) }}</textarea>
                            <label for="floatingInput">Description</label>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                    </form>
                    <div>
                        <h5 class="text-black-50" id="gallery">Gallery</h5>

                        <div class="d-flex align-items-center w-100 p-3 overflow-scroll">

                            <button class="btn btn-outline-primary" form="gallery-store" id="gallery-store" type="button">
                                <i class="fas fa-plus"></i></button>
                            <div class="d-flex align-items-end">
                                @foreach ($post->galleries as $gallery)
                                    <img src="{{ asset('storage/gallery/' . $gallery->photo) }}" class="ms-2 rounded-1"
                                        height="100" alt="">
                                    <form action="{{ route('gallery.destroy', $gallery->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-danger" style="margin-left: -50px;margin-bottom: 10px"
                                            type="submit"><i class="fas fa-trash"></i></button>
                                    </form>
                                @endforeach
                            </div>

                        </div>
                    </div>
                    @error('photos')
                        <p class="my-3 text-danger small"> {{ $message }}</p>
                    @enderror
                    @error('photos.*')
                        <p class="my-3 text-danger small"> {{ $message }}</p>
                    @enderror

                    <div class="mb-3">

                        <div>
                            <form action=" {{ route('gallery.store') }}" method="POST" class="gallery-form"
                                enctype="multipart/form-data" id="gallery-store">
                                @csrf
                                <input type="file" class="d-none gallery-input" multiple name="photos[]">
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                            </form>
                        </div>
                    </div>
                    <div>
                        <button type="submit" form="post-update" class="btn btn-primary w-100">
                            <i class="fas fa-pen-fancy fw me-1"></i> Edit
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </section>
    @push('script')
        <script>
            let coverImg = document.getElementById('cover-img');
            let coverInput = document.getElementById('cover-input');
            let img = document.getElementById('cover-img');
            coverImg.addEventListener('click', () => {
                coverInput.click();
            })

            coverInput.addEventListener('change', () => {
                let file = coverInput.files[0];
                let reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                }
                reader.readAsDataURL(file);
            })


            let galleryForm = document.querySelector('.gallery-form');
            let galleryInput = document.querySelector('.gallery-input');
            document.querySelector('#gallery-store').addEventListener('click', _ => {
                document.querySelector('.gallery-input').click()
            });
            galleryInput.addEventListener('change', _ => {
                galleryForm.submit();
            })
        </script>
    @endpush
@endsection
