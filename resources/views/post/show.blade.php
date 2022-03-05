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
                        @auth
                            @can('update', $post)
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
                            @endcan
                        @endauth
                    </div>
                </div>
                <div>
                    <img src="{{ asset('storage/cover/' . $post->cover) }}" class="img-fluid rounded-3" alt="">
                </div>
                <p class="p-3 description-box my-3 shadow border border-1 rounded">
                    {{ $post->description }}
                </p>
                <div id="comments-section" class="my-3">
                    <h3 class="text-black-50 mb-0">Comments</h3>
                    <div class="@if ($post->comments->first()) comment-box p-3 pt-0 my-3 @endif">
                        @forelse ($post->comments as $comment)
                            <div class="comment-wrapper p-3 shadow rounded">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('storage/misc/' . $comment->user->profile_photo) }}"
                                        class="nav-profile-photo me-3" alt="">
                                    <div>
                                        <p class="mb-0">{{ $comment->user->name }}</p>
                                        <small class="mb-0 small"><i
                                                class="fa text-black-50 fa-clock-four fa-fw me-1"></i>{{ $comment->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
                                <div>
                                    <p class="mb-0">
                                        {{ $comment->message }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <p class="small my-3">No comments yet!</p>
                        @endforelse
                    </div>
                    @auth
                        <div class="">
                            <div class="d-flex justify-content-between align-items-start w-100">
                                <img src="{{ asset('storage/misc/' . auth()->user()->profile_photo) }}" alt=""
                                    class="nav-profile-photo mx-2">
                                <form action="{{ route('comment.store') }}"
                                    class="flex-grow-1 flex-column d-flex align-items-end" method="POST" id="comment-create">
                                    @csrf
                                    <div class="w-100">
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                        <textarea name="comment" required class="form-control" id="" cols="30" rows="2"
                                            placeholder="Wite a comment ...."></textarea>
                                    </div>
                                    <div>
                                        <button type='submit' class="btn btn-warning btn-sm my-3 ms-auto"><i
                                                class="fas fa-paper-plane fa-fw" form-id="comment-create"></i>
                                            Submit</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
