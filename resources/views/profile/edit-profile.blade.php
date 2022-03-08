@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="p-3 shadow rounded">
                    <h3 class="fw-bolder text-center text-black-50">My Profile</h3>
                    <div class="text-center my-3">
                        <div class="position-relative profile-photo-upload-icon" style="width: fit-content;margin: 0 auto;">
                            <img src="{{ asset('storage/misc/' . auth()->user()->profile_photo) }}" height="100px"
                                class="rounded-circle profile-photo shadow" alt="">
                            <i class="fas fa-pen fa-fw position-absolute bottom-0" style="right: 0;"></i>
                        </div>

                    </div>
                    <div class="">
                        <form action="{{ route('update-profile') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="photo" id="photo-upload-form" class="d-none profile-photo-upload-form">
                            <div class="form-floating mb-3">
                                <input type="text" name="name" class="form-control" id="floatingPassword"
                                    placeholder="name" value="{{ auth()->user()->name }}">
                                <label for="floatingPassword">Name</label>
                                @error('name')
                                    <small class="small fw-bold text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-floating mb-3 text-muted">
                                <input type="text" disabled class="form-control text-muted" id="floatingPassword"
                                    placeholder="Password" value="{{ auth()->user()->email }}">
                                <label for="floatingPassword">Email Address</label>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" required type="checkbox" id="flexSwitchCheckChecked">
                                <label class="form-check-label" for="flexSwitchCheckChecked">Sure to update profile</label>
                            </div>
                            <button type="submit" class="btn btn-primary d-block w-25 my-0 ms-auto">Update Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            let icon = document.querySelector('.profile-photo-upload-icon');
            let input = document.querySelector('.profile-photo-upload-form');
            let img = document.querySelector('.profile-photo');
            icon.addEventListener('click', _ => input.click());
            input.addEventListener('change', _ => {
                let file = input.files[0];
                let reader = new FileReader();
                reader.onload = function() {
                    img.src = reader.result;
                }
                reader.readAsDataURL(file);
            });
        </script>
    @endpush
@endsection
