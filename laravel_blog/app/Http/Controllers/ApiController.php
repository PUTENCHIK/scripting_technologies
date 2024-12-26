<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;

use App\Http\Resources\CommentResource;

class ApiController extends Controller
{
    public function posts()
    {
        // $posts = Post::all([
        //     'id',
        //     'text',
        //     'path',
        //     'created_at'
        // ]);
        $posts = Post::with('comments')->get();
        // $posts->load([
        //     'comments' => fn ($query) => $query->where([['status', '<>', (string)(Comment::$statuses['canceled']['value'])]])
        // ]);
        // $posts->load('comments');

        // CommentResource::collection();

        // dd($posts->toArray());

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
