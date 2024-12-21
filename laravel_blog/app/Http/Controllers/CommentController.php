<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        $fields = $request->only('post_id', 'user', 'text');
        if (empty($fields['user'])) {
            unset($fields['user']);
        }
        $comment = Comment::create($fields);

        return ['comment' => Comment::findOrFail($comment->id)];
    }

    public function update(Request $request, string $id)
    {
        $comment = Comment::findOrFail($id)->update($request->only('status'));

        return ['success' => $comment];
    }
}
