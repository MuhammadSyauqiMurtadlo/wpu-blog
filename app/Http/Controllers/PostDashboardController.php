<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller; // tambahkan ini
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->where('author_id', Auth::user()->id);
        if (request('keyword')) {
            $posts->where('title', 'like', '%' . request('keyword') . '%');
        }
        return view('dashboard.index', ['posts'=> $posts->paginate(5)->withQueryString()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation
        // $request->validate([
        //     'title' => 'required|unique:posts|min:5|max:255',
        //     'category_id' => 'required',
        //     'body' => 'required',
        // ]);

        Validator::make($request->all(), [
            'title' => 'required|unique:posts|min:5|max:255',
            'category_id' => 'required',
            'body' => 'required',
        ], [
            'title.required' => 'Field :attribute harus diisi',
            'title.unique' => 'Title must be unique',
            'title.min' => 'Title must be at least 5 characters',
            'title.max' => 'Title must not exceed 255 characters',
            'category_id.required' => 'Pilih salah satu :attribute',
            'body.required' => ':attribute tidak boleh kosong',
        ], [
            'title' => 'Judul',
            'category_id' => 'Kategori',
            'body' => 'Post body',
        ]
        )->validate();

        Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'author_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'body' => $request->body,
            ]);

        return redirect()->route('dashboard')->with([
            'success' => 'Post created successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('dashboard.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('dashboard.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // validation
        Validator::make($request->all(), [
            'title' => 'required|min:5|max:255|unique:posts,title,' . $post->id,
            'category_id' => 'required',
            'body' => 'required',
        ]);

        $post->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'author_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'body' => $request->body,
        ]);

        return redirect()->route('dashboard')->with([
            'success' => 'Post updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('dashboard')->with([
            'success' => 'Post deleted successfully'
        ]);
    }
}
