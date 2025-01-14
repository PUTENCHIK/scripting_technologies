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
        $post->load('comments');

        return ['post' => $post];
    }

    public function update(PostRequest $request, string $id)
    {
        Post::findOrFail($id)->update($request->all());
        $post = Post::findOrFail($id);
        $post->load('comments');

        return ['post' => $post];
    }

    public function delete(Request $request, string $id)
    {
        Post::findOrFail($id)->delete();

        return ['id' => $id];
    }
}
