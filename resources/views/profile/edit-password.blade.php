@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="p-3 shadow rounded">
                    <p class="fw-bolder text-black-50">Change Password</p>
                    <div class="text-center">
                        <img src="{{ asset('storage/misc/' . auth()->user()->profile_photo) }}" height="100px"
                            class="rounded-circle" alt="">
                        <p class="fw-bold text-black-50">{{ auth()->user()->name }}</p>
                    </div>
                    <div class="">
                        <form action="{{ route('update-password') }}" method="post">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="password" name="current_password" class="form-control" id="floatingPassword"
                                    placeholder="Password">
                                <label for="floatingPassword">Current Password</label>
                                @error('current_password')
                                    <small class="small fw-bold text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="new_password" class="form-control" id="floatingPassword"
                                    placeholder="Password">
                                <label for="floatingPassword">New Password</label>
                                @error('new_password')
                                    <small class="small fw-bold text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="confirm_new_password" class="form-control"
                                    id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Confirm New Password</label>
                                @error('confirm_new_password')
                                    <small class="small fw-bold text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" required type="checkbox" id="flexSwitchCheckChecked">
                                <label class="form-check-label" for="flexSwitchCheckChecked">Sure to update password</label>
                            </div>
                            <button type="submit" class="btn btn-primary d-block w-25 my-0 ms-auto">Change Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
