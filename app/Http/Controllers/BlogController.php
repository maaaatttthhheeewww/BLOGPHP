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
        // Fetch all published blogs
        $blogs = Blog::where('published', true)->orderBy('created_at', 'desc')->get();

        // Return the fetched blogs as JSON data
        return response()->json($blogs);
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
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published' => 'boolean',
        ]);

        // Create a new blog instance
        $blog = new Blog;
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->published = $request->has('published') ? true : false;
        $blog->user_id = Auth::id(); // Assign the currently logged-in user as the author

        // Save the blog to the database
        $blog->save();

        // Redirect back to the blog index page with a success message
        Log::debug('Reached the redirection'); // Log a debug message
    }

    // Other methods like show(), edit(), update(), delete() can be added here as needed
}
