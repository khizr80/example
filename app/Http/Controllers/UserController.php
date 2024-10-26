<?php
namespace App\Http\Controllers;
use Yajra\DataTables\DataTables;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        return view('addUser'); // Make sure you have this view in resources/views
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select(['id', 'username', 'name', 'password', 'role']);
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $actions = '';

                    if (session('role') == "admin") {
                        $actions = '
                                            <a href="' . route('editUser', $row->id) . '" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">Edit</a>
                           <a href="javascript:void(0)" data-id="' . $row->id . '" class="delete-user bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</a>
                        ';
                    }

                    return $actions;
                })
                ->rawColumns(['action'])
                ->make(true);
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

