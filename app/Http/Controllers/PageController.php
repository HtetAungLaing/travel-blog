<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function detail($slug)
    {
        $post = Post::where('slug', $slug)->with(["comments" => function ($q) {
            return  $q->orderBy('id', 'DESC');
        }, "user"])->first();
        // dd($post->comments->first());
        return view('post.show', ['post' => $post]);
    }
}
