<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;

class ApiController extends Controller
{
    public function posts()
    {
        $posts = Post::all([
            'id',
            'text',
            'path',
            'created_at'
        ]);

        $posts->load('comments');

        return ['posts' => $posts];
    }

    public function comments()
    {
        $comments = Comment::all([
            'id',
            'post_id',
            'user',
            'text',
            'status',
            'created_at'
        ]);

        return ['comments' => $comments];
    }

    public function statuses()
    {
        $statuses = Comment::$statuses;

        return ['statuses' => $statuses];
    }
}
