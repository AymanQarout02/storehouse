<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{

    public function index()
    {
        Cache::forget('total_users');

        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function update(User $user)
    {
        Cache::forget('total_users');

        $data = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string'],
            'role' => ['required', 'string', 'in:user,manager'],
        ]);


        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        Cache::forget('total_users');

        if($user->products()->count() > 0) {
            return redirect()->route('users.index')->with('error', 'User cannot be deleted because they have products associated with them.');
        }else {
            $user->delete();
            return redirect()->route('users.index')->with('success', 'User deleted successfully.');
        }
    }

}
