<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Http\Requests\PostRequest;
use \App\Models\Post;

class PostController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function store(PostRequest $request)
    {
        $post = Post::create($request->only('text', 'path'));

        return ['post' => $post];
    }

    public function delete(Request $request, string $id)
    {
        Post::findOrFail($id)->delete();

        return ['id' => $id];
    }
}