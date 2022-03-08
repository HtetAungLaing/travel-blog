@extends('layouts.master')
@section('content')
    <section class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <div>
                    <h3 class="my-3 text-black-50">
                        Create Posts Here
                    </h3>
                    <form action="{{ route('post.store') }}" method="post" enctype='multipart/form-data'>
                        @csrf
                        <div class="form-floating mb-3">
                            <input required type="text" class="form-control @error('title') is-invalid @enderror"
                                id="floatingInput" placeholder="Post's Title" name="title" value="{{ old('title') }}">
                            <label for="floatingInput">Post Title</label>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-none">
                            <input type="file" name="cover" id="cover-input" accept="image/png,image/jpeg">
                        </div>
                        <div class="mb-3">
                            <img src="{{ asset('storage/misc/image-default.png') }}" id="cover-img"
                                class="w-100 cover-upload rounded @error('cover') border border-danger border-1 is-invalid @enderror"
                                alt="">
                            @error('cover')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-floating mb-3">
                            <textarea required style="height: 10rem" type="text"
                                class="form-control @error('description') is-invalid @enderror" id="floatingInput"
                                placeholder="Post's Description" name="description">{{ old('description') }}</textarea>
                            <label for="floatingInput">Description</label>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div>
                            <button type=" submit" class="btn btn-primary w-100">
                                <i class="fas fa-message fw me-1"></i> Create
                            </button>
                        </div>
                    </form>
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
        </script>
    @endpush
@endsection
