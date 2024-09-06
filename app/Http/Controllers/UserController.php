<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        return view('addUser'); // Make sure you have this view in resources/views
    }

    public function getAllUsers()
    {
        $users = User::all(); // Retrieve all users from the database
        return view('users', ['users' => $users]); // Pass users to the view
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users')->with('success', 'User deleted successfully.');
    }
    public function edit(User $user)
    {
        return view('editUser', ['user' => $user]);
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

}

