<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            'username' => $request->input('username'), // Laravel uses 'email' by default
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $request->session()->put('user_name', $user->name);
            $request->session()->put('id', $user->id);
            $request->session()->put('role', $user->role);
            Session::put('username', $user->username);
            Session::put('name', $user->name);
            Session::put('role', $user->role);
            return redirect()->route('home');
        } else {
            return redirect()->route('login')->with('status', 'fail')->with('message', 'Invalid credentials. Please try again.');
        }
    }

    public function signup(Request $request)
    {
        try {
            $request->validate([
                'name' => 'string|max:255',
                'username' => 'unique:webuser,username', // assuming 'users' is your table name
                'password' => 'string',
                'role' => 'required|in:user,admin', // Ensure role is either user or admin
            ]);

            User::create([
                'name' => $request->input('name'),
                'username' => $request->input('username'), // Use username field
                'password' => Hash::make($request->input('password')),
                'role' => $request->input('role'), // Set the role
            ]);
            return redirect()->route('login')->with(['status' => 'success', 'message' => 'Registered successfully!']);

        } catch (\Exception $e) {
            return redirect()->route('login')->with(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect()->route('login')->with('status', 'success')->with('message', 'You have been logged out!');
    }

}
