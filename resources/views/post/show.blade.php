@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <h3 class="fw-bolder">{{ $post->title }}</h3>

                <div class="card my-3 shadow">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <img src="{{ asset('storage/misc/' . $post->user->profile_photo) }}"
                                class="nav-profile-photo rounded-circle" alt="">
                            <span class="fw-bold">{{ $post->user->name }}</span>
                            <p class="text-black-50 mb-0">
                                <i class="fas fa-calendar-alt fa-fw me-1"></i>
                                {{ $post->created_at->format('d-M-Y') }}
                            </p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="me-2 btn btn-sm btn-outline-danger" type="submit">
                                    <i class="fas fa-trash-alt fa-fw"></i>
                                </button>
                            </form>
                            <a href="{{ route('post.edit', $post->id) }}" class="me-2 btn btn-sm btn-warning">
                                <i class="fas fa-pen-alt fa-fw"></i>
                            </a>
                            <a href="{{ route('index') }}" class="me-2 btn btn-primary px-3">Read All</a>
                        </div>
                    </div>
                </div>
                <div>
                    <img src="{{ asset('storage/cover/' . $post->cover) }}" class="img-fluid rounded-3" alt="">
                </div>
                <p class="p-3">
                    {{ $post->description }}
                </p>
            </div>
        </div>
    </div>
@endsection
