<?php
namespace App\Http\Controllers;

use Yajra\DataTables\DataTables;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie; // Import for cookie management

class UserController extends Controller
{
    public function __construct()
    {
        // Apply 'role' middleware to protect methods
        // $this->middleware('role:admin')->only(['create','destroy']);
        // $this->middleware('auth')->only([ 'getUsers']);
    }

    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select(['id', 'username', 'name', 'role']);
            return DataTables::of($data)->make(true);
        }

        return view('users');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();

            return response()->json([
                'message' => 'User deleted successfully.'
            ], 200);
        } else {
            return response()->json([
                'message' => 'User not found.'
            ], 404);
        }
    }

    public function edit(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'role' => 'required|in:user,admin',
                'user_id' => 'required|exists:webuser,id'
            ]);
    
            $user = User::find($request->user_id);
            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found'
                ], 404);
            }
    
            $user->name = $request->name;
            $user->role = $request->role;
            $user->save();
    
            return response()->json([
                'status' => 'success',
                'message' => 'User updated successfully',
                'user' => $user
            ]);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
public function update(Request $request)
{
    try {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'new' => 'nullable|string',
            'role' => 'required|in:user,admin', // Ensure role is either user or admin
        ]);

        // Retrieve the user by username
        $user = User::where('username', $request->input('username'))->first();
        if (!$user) {
            return redirect()->back()->with(['status' => 'fail', 'message' => 'User not found!']);
        }

        // Update the user's details
        $user->name = $request->input('name');
        if ($request->input('new')) {
            $user->password = Hash::make($request->input('new'));
        }
        $user->role = $request->input('role');
        $user->save();

        // Update session data
        $request->session()->put('user_name', $user->name);
        $request->session()->put('id', $user->id);
        $request->session()->put('role', $user->role);
        $request->session()->put('username', $user->username);

        // Update cookies if needed
        Cookie::queue('username', $user->username, 60 * 24 * 30); // 30 days
        Cookie::queue('name', $user->name, 60 * 24 * 30);         // 30 days
        Cookie::queue('role', $user->role, 60 * 24 * 30);         // 30 days

        // Redirect back with success message
        return redirect()->route('users')->with([
            'status' => 'success',
            'message' => 'Profile updated successfully!',
        ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Handle validation exception
        return redirect()->back()->with([
            'status' => 'fail',
            'message' => $e->getMessage(),
        ]);
    } catch (\Exception $e) {
        // Handle any other exceptions
        return redirect()->back()->with([
            'status' => 'fail',
            'message' => 'An unexpected error occurred: ' . $e->getMessage(),
        ]);
    }
}

    
    public function create(Request $request)
    {
        try {
            $request->validate([
                'name' => 'string|max:255',
                'username' => 'unique:webuser,username', // Assuming 'webuser' is your table name
                'password' => 'string',
                'role' => 'required|in:user,admin', // Ensure role is either 'user' or 'admin'
            ]);
            
            $user = User::create([
                'name' => $request->input('name'),
                'username' => $request->input('username'), // Use username field
                'password' => Hash::make($request->input('password')), // Hash the password
                'role' => $request->input('role'), // Set the role
            ]);
    
            return response()->json([
                'status' => 'success',
                'message' => 'User registered successfully!',
                'user' => $user // Optionally include the created user data
            ], 201); // HTTP status code 201 for successful creation
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage(),
            ], 500); 
        }
    }
    
}

