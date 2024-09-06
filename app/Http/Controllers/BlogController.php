<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    // Display all blogs
    public function index()
    {
        $blogs = Blog::with('subcategory', 'user')->get();
        return view('blogs', compact('blogs'));
    }
    public function showBlogs() {
        $blogs = Blog::all(); // Fetch blogs from the database
        return view('userSide.home', compact('blogs'));
    }
    public function showBlog(Blog $blog) {
        return view('userSide.blog', compact('blog'));
    }

    // Show the form for creating a new blog
    public function create()
    {
        $subcategories = Subcategory::all();
        return view('addblog', compact('subcategories'));
    }

    // Store a newly created blog
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slugs' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image',
            'SubCategoryId' => 'nullable|exists:subcategories,id',
            'UserId' => 'required|exists:webuser,id',
        ]);

        if ($request->hasFile('image')) {
            // Store the image in the 'public/images' directory and get the file path
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = null; // Handle case when no image is uploaded
        }

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->slugs = $request->slugs;
        $blog->content = $request->content;
        $blog->SubCategoryId = $request->SubCategoryId;
        $blog->UserId = $request->UserId;
        $blog->image = $imagePath; // Save the image path in the database
        $blog->save();

        return redirect()->route('blogs')->with('status', 'success')->with('message', 'Blog created successfully!');
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogs.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        $subcategories = Subcategory::all();
        return view('editBlog', compact('blog', 'subcategories'));
    }


public function update(Request $request, $id)
{
    // Validate request data
    $request->validate([
        'title' => 'required|string|max:255',
        'slugs' => 'required|string|max:255',
        'content' => 'required',
        'image' => 'nullable|image',
        'SubCategoryId' => 'nullable|exists:subcategories,id',
    ]);

    // Find the blog by ID
    $blog = Blog::findOrFail($id);

    // Handle image upload if a new image is provided
    if ($request->hasFile('image')) {
        // Delete old image file if it exists
        if ($blog->image && Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }

        // Store the new image and get the file path
        $imagePath = $request->file('image')->store('images', 'public');
        $blog->image = $imagePath; // Update the image path directly on the model
    }

    $blog->title = $request->input('title');
    $blog->slugs = $request->input('slugs');
    $blog->content = $request->input('content');
    $blog->SubCategoryId = $request->input('SubCategoryId');
    
    $blog->save();

    return redirect()->route('blogs')->with('status', 'success')->with('message', 'Blog edited successfully!');
}

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blogs')->with('status', 'success')->with('message', 'Blog deleted successfully!');
    }
}


