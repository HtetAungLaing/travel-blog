<?php

namespace App\Http\Controllers;

use App\Jobs\CreateFile;
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

    public function jobTest()
    {
        // dispatch(function () {
        //     logger('san tr');
        // })->delay(now()->addSecond(10));

        // dispatch(new CreateFile())->delay(now()->addSecond(10));
        CreateFile::dispatch()->delay(now()->addSecond(5));
    }
}
