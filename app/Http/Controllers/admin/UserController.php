<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'You cannot delete your own account!');
        }

        if ($user->isAdmin()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Cannot delete admin users');
        }

        $user->delete();
        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully');
    }
}
