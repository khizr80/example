<?php
namespace App\Http\Controllers;

use Yajra\DataTables\DataTables;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct()
    {
        // Apply 'role' middleware to protect methods
        $this->middleware('role:admin')->only(['create','destroy']);
        $this->middleware('auth')->only([ 'getUsers']);
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
            'name' => 'string|max:255',
            'role' => 'required|in:user,admin',
        ]);

        $user = User::find($request->user_id);

        if (!$user) {
            return response()->json([
                'status' => 'fail',
                'message' => 'User not found!',
            ], 404); // HTTP status code 404 for not found
        }

        $user->name = $request->name ?? $user->name;
        $user->role = $request->role;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'User updated successfully!',
            'user' => $user // Return updated user data
        ], 200); // HTTP status code 200 for successful update
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'fail',
            'message' => $e->getMessage(),
        ], 500); // HTTP status code 500 for server error
    }
}


    public function update(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'new' => 'nullable|string',
                'role' => 'required|in:user,admin', // Ensure role is either user or admin
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->with(['status' => 'fail', 'message' => $e->getMessage()]);
        }

        $user = User::where('username', $request->input('username'))->first();
        $user->name = $request->input('name');
        if ($request->input('new')) {
            $user->password = Hash::make($request->input('new'));
        }
        $user->role = $request->input('role');
        $user->save();
        return redirect()->route('users')->with(['status' => 'success', 'message' => 'Profile updated successfully!']);
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

