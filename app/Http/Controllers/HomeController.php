<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::all();
        $posts = Post::all();
        $comment = Comment::find(17);
        $developer = Role::where('slug', 'web-developer')->first();

        return view('home', compact('user', 'posts', 'comment', 'developer'));
    }
}
