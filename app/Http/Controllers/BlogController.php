<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{
    public function __construct()
    {
        // Apply 'role' middleware to protect methods
        $this->middleware('auth')->only(['create','store','edit','update','destroy']);
    }
    public function index()
    {
        $blogs = Blog::with('subcategory', 'user')->get();
        return view('blogs', compact('blogs'));
    }
    public function showBlogs()
    {
        $blogs = Blog::all(); // Fetch blogs from the database
        return view('userSide.home', compact('blogs'));
    }
    public function showBlog(Blog $blog)
    {
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

        return redirect()->route('blogss')->with('status', 'success')->with('message', 'Blog created successfully!');
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

        return redirect()->route('blogss')->with('status', 'success')->with('message', 'Blog edited successfully!');
    }

    
    public function ajaxLoadBlogs(Request $request)
    {
        $page = $request->get('page', 1); // Get the current page from the request
        $blogs = Blog::with('subcategory') // Eager load the subcategory relationship
                    ->paginate(6, ['*'], 'page', $page); // Paginate blog posts, 6 per page
    
        // Render the partial view for blog posts
        $view = view('partials.blogs', compact('blogs'))->render();
    
        // Return the rendered HTML content as a JSON response
        return response()->json(['html' => $view]);
    }
    
    public function indexx()
{
    // Render the blog page. Blog posts will be loaded via AJAX, so no need to pass them here.
    return view('blogs.index');
}
public function destroy($id)
{
    $blog = Blog::findOrFail($id);
    if ($blog->delete()) {
        return response()->json(['status' => 'success', 'message' => 'Blog deleted successfully.']);
    } else {
        return response()->json(['status' => 'error', 'message' => 'Failed to delete the blog.'], 500);
    }
}
public function getBlogsData()
{
    $blogs = Blog::with('subcategory')->get(); // Make sure to eager load relationships

    return DataTables::of($blogs)
        ->addColumn('category', function($blog) {
            return $blog->getCategoryTitle(); // Assuming you have this method in your Blog model
        })
        ->addColumn('image', function($blog) {
            if ($blog->image) {
                return '<img src="'.asset($blog->image).'" alt="'.$blog->title.'" class="w-24 h-24 object-cover">';
            }
            return '';
        })
        ->addColumn('actions', function($blog) {
            $buttons = '';
            if (session('role') == "admin" || session('id') == $blog->UserId) {
                $buttons .= '<a href="'.route('editBlog', $blog).'" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">Edit</a>';
                $buttons .= '<a href="javascript:void(0)"  data-id="' . $blog->id . '" class=" delete-blog   bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</a>';
            
            }
            return $buttons;
        })
        ->rawColumns(['image', 'actions'])
        ->make(true);
}


}


