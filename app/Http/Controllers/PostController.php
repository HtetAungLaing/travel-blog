<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Jobs\CreateFile;
use App\Mail\PostMail;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'verified']);
    // }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {

        $request->validate([
            "title" => "required|min:5|unique:posts,title",
            "description" => "required|min:10",
            "cover" => "required|mimes:png,jpg"
        ]);

        $file = $request->file('cover');
        $coverName = "cover-" . uniqid() . "." . $file->extension();
        $file->storeAs('public/cover', $coverName);

        CreateFile::dispatch($coverName);

        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description, 50);
        $post->user_id = Auth::id();
        $post->cover = $coverName;
        $post->save();
        // $postMail = new PostMail(); for single send
        $toSendAddress = ["myueway98@gmail.com", Auth::user()->email];
        foreach ($toSendAddress as $address) {
            Mail::to($address)->later(now()->addSecond(10), new PostMail($post));
            //multiple so send(new Postmail) loc yay; not to write $ which intitate class
        }
        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // $post = Post::where('slug',)
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        Gate::authorize('update', $post);
        return view('post.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->title = $request->title;
        $post->description = $request->description;
        if ($request->hasFile('cover')) {
            Storage::delete('public/cover/' . $post->cover);
            $fileName = "cover-" . uniqid() . "." . $request->file('cover')->extension();
            $request->file('cover')->storeAs('public/cover/', $fileName);
            $post->cover = $fileName;
        }
        $post->update();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);
        Storage::delete('public/cover/' . $post->cover);
        foreach ($post->galleries as $gallery) {
            Storage::delete('public/gallery/' . $gallery->photo);
        }
        $post->delete();
        return redirect()->route('index');
    }
}
