<?php
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {return view('home');})->middleware('auth')->name('home');

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
    
    Route::get('/logout', [AuthController::class, 'logout'])->name('logoutController');

    Route::get('/users', [UserController::class, 'getAllUsers'])->name('users');
    Route::get('/users/delete/{id}', [UserController::class, 'destroy'])->name('deleteUser');
    Route::get('/users/create', [UserController::class, 'create'])->name('addUser');
    Route::get('/users/{user}', [UserController::class, 'edit'])->name('editUser');
    Route::post('/users/update', [UserController::class, 'update'])->name('updateUser');


    Route::get('/profile', function(){ return view('profile'); })->name('profile');



    Route::get('/categories', [CategoryController::class, 'getAllCategories'])->name('categories');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('addCategory');
    Route::post('/categories/add', [CategoryController::class, 'add'])->name('addCategorybutton');
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('editCategory');
    Route::post('/categories/{category}', [CategoryController::class, 'update'])->name('updateCategory');
    Route::get('/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('deleteCategory');



    Route::get('/subcategories', [SubcategoryController::class, 'getAllSubcategories'])->name('subcategories');
    Route::get('/subcategories/create', [SubcategoryController::class, 'create'])->name('addSubcategory');
    Route::get('/subcategories/delete/{subcategory}', [SubcategoryController::class, 'destroy'])->name('deleteSubcategory');
    Route::post('/subcategories/add', [SubcategoryController::class, 'add'])->name('addSubcategoryButton');
    Route::get('/subcategories/edit/{subcategory}', [SubcategoryController::class, 'edit'])->name('editSubcategory');
    Route::post('/subcategories/{subcategory}', [SubcategoryController::class, 'update'])->name('updateSubcategory');


    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs'); // List all blogs
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('addBlog'); // Show the form to create a new blog
    Route::post('/blogs/add', [BlogController::class, 'store'])->name('addBlogButton'); // Handle form submission to add a blog
    Route::get('/blogs/edit/{blog}', [BlogController::class, 'edit'])->name('editBlog'); // Show the form to edit an existing blog
    Route::post('/blogs/{blog}', [BlogController::class, 'update'])->name('updateBlog'); // Handle form submission to update a blog
    Route::get('/blogs/delete/{blog}', [BlogController::class, 'destroy'])->name('deleteBlog'); // Handle deleting a blog
    
});


Route::get('/userSide/home', [BlogController::class, 'showBlogs'])->name('userSideHome');
Route::get('/userSide/blog/{blog}', [BlogController::class, 'showBlog'])->name('userSideBlog');


Route::get('/userSide/contactUs', function () {
    return view('userSide.contactUs');
})->name('userSideContactUs'); // Handle deleting a blog

Route::get('/userSide/aboutUs', function () {
    return view('userSide.aboutUs');
})->name('userSideAboutUs'); // Handle deleting a blog


