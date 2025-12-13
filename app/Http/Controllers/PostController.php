<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(5);
        return view('dashboard', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Logic simpan gambar simple
        $image = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());

        Post::create([
            'title'   => $request->title,
            'content' => $request->content,
            'image'   => $image->hashName(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Post created successfully.');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title'   => 'required|string|max:255',
            'content' => 'required|string'
        ]);


        $dataToUpdate = [
            'title'   => $request->title,
            'content' => $request->content
        ];


        if ($request->hasFile('image')) {


            if ($post->image) {
                Storage::delete('public/posts/' . $post->image);
            }


            $image = $request->file('image');
            $image->storeAs('public/posts', $image->hashName());


            $dataToUpdate['image'] = $image->hashName();

        }

        elseif ($request->has('delete_image') && $request->delete_image == '1') {

            if ($post->image) {
                Storage::delete('public/posts/' . $post->image);
            }

            $dataToUpdate['image'] = null;
        }

        $post->update($dataToUpdate);

        return redirect()->route('dashboard')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::delete('public/posts/' . $post->image);
        }

        $post->delete();

        return redirect()->route('dashboard')->with('success', 'Post deleted successfully.');
    }
}
