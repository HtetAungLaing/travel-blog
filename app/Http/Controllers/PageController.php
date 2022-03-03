<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function detail($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('post.show', ['post' => $post]);
    }
}
