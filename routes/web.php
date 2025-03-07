<?php
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
Route::post('/convert-document', [DocumentController::class, 'convert'])->name('convert.document');
Route::get('/', function () {
    return view('home'); })->middleware('auth')->name('home');

Route::get('/login', function () {
    if (Auth::check()) {
        return redirect()->route('home');  // Redirect to home if user is logged in
    }
    return view('login');
})->name('login');

Route::get('/signup', function () {
    if (Auth::check()) {
        return redirect()->route('home');  // Redirect to home if user is logged in
    }
    return view('signup');
})->name('signup');

Route::post('/login', [AuthController::class, 'login'])->name('loginController');
Route::post('/signup', [AuthController::class, 'signup'])->name('signupController');


Route::middleware(['auth'])->group(function () {

    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('deleteUser');
    Route::post('/users/create', [UserController::class, 'create'])->name('addUser');
    Route::put('/users/{id}', [UserController::class, 'edit'])->name('users.edit');

    Route::post('/categories/create', [CategoryController::class, 'create'])->name('addCategory');
    Route::put('/categories/edit', [CategoryController::class, 'edit'])->name('editCategory');
    Route::delete('/categories/{id}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');

    Route::get('/convertblog', function () {
        return view('convertBlog');
    })->name('convertblog');
    Route::get('/subcategories/add', [SubcategoryController::class, 'getCat'])->name('get');
    Route::get('/getid', [SubcategoryController::class, 'getid'])->name('getid');
    
    Route::post('/subcategories/create', [SubcategoryController::class, 'create'])->name('addSubcategory');
    Route::delete('/subcategories/{id}', [SubcategoryController::class, 'delete'])->name('deleteSubcategory');
    Route::put('/subcategories/update', [SubcategoryController::class, 'update'])->name('updateSubcategory');

});
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logoutController');
    Route::get('/users', [UserController::class, 'getUsers'])->name('users');
    Route::post('/users/update', [UserController::class, 'update'])->name('updateUser');


    Route::get('/profile', function () {return view('profile'); })->name('profile');

    Route::get('/categories', [CategoryController::class, 'getCategories'])->name('categories');
    Route::get('/subcategories', [SubcategoryController::class, 'getSubcategories'])->name('subcategories');
    Route::get('/blogss', [BlogController::class, 'index'])->name('blogss'); // List all blogs

    Route::get('/blogs/data', [BlogController::class, 'getBlogsData'])->name('blogs-data'); // List all blogs
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('addBlog'); // Show the form to create a new blog
    Route::post('/blogs/add', [BlogController::class, 'store'])->name('addBlogButton'); // Handle form submission to add a blog
    Route::get('/blogs/edit/{blog}', [BlogController::class, 'edit'])->name('editBlog'); // Show the form to edit an existing blog
    Route::post('/blogs/{blog}', [BlogController::class, 'update'])->name('updateBlog'); // Handle form submission to update a blog
    Route::delete('/blogs/{id}', [BlogController::class, 'destroy'])->name('deleteBlog'); // Handle deleting a blog

});



Route::get('/userSide/home', [BlogController::class, 'showBlogs'])->name('userSideHome');
Route::get('/userSide/blog/{blog}', [BlogController::class, 'showBlog'])->name('userSideBlog');
Route::get('/userSide/contactUs', function () {
    return view('userSide.contactUs');
})->name('userSideContactUs'); // Handle deleting a blog

Route::get('/userSide/aboutUs', function () {
    return view('userSide.aboutUs');
})->name('userSideAboutUs'); // Handle deleting a blog
Route::get('/blogs/load', [BlogController::class, 'ajaxLoadBlogs'])->name('ajaxLoadBlogs');
Route::get('/blogs', [BlogController::class, 'indexx'])->name('blogs');

