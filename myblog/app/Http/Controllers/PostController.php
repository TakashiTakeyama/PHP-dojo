<?php

namespace App\Http\Controllers;

use App\Post;

class PostsController extends Controller
{
    public function index()
    {
        // $posts = \App\Post::All();
        // $posts = Post::all();
        // $posts = Post::order_by('createde_at', 'desc')->get();
        $posts = Post::latest()->get();
        // $posts = [];
        // dd($posts->toArray());

        // return view('posts.index', ['posts' => $posts]);

        return view('posts.index')->with('posts', $posts);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.show')->with('post', $post);
    }
}
