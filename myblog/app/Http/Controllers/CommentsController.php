<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\comment;

class CommentsController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);
        $comment = new Comment(['body' => $request->body]);
        $post->comments()->save($comment);

        return redirect()->action('PostController@show', $post);
    }

    public function destroy(Post $post, Comment $comment)
    {
        $comment->dalete();

        return redirect()->back();
    }
}
