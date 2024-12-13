<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    public function all()
    {
        $posts = Post::all([
            'id',
            'text',
            'path',
            'created_at'
        ]);

        return ['posts' => $posts];
    }
}
