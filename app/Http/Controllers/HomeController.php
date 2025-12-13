<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(6);
        $hasAdmin = User::where('role', 'admin')->exists();
        return view('welcome', compact('posts', 'hasAdmin'));
    }
}
