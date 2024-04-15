<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;



class BlogController extends Controller
{
    /**
     * Display a listing of the blogs.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve published blogs with their associated users, ordered by creation date
        $blogs = Blog::with('user')->where('published', true)->orderByDesc('created_at')->get();
        // Pass the blogs to the view
        return Inertia::render('PublishedBlogs', ['blogs' => $blogs]);

    }
    public function authored()
    {
        $blogs = Blog::where('user_id', Auth::id())->get();
        return Inertia::render('MyBlogs', ['blogs' => $blogs]);
    }

    /**
     * Show the form for creating a new blog.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('BlogCreate');
    }

    /**
     * Store a newly created blog in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published' => 'boolean',
        ]);
        $blog = new Blog;
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->published = $request->has('published') ? true : false;
        $blog->user_id = Auth::id();

        $blog->save();
    }

    public function destroy($id)
    {
        $blog = Blog::where('user_id', Auth::id())->findOrFail($id);

        $blog->delete();
    }

    /**
     * Update the specified blog post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $blog = Blog::findOrFail($id);

        $blog->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);
    }
}
