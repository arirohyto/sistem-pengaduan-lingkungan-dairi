<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Filter role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search name / email
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->orderBy('name')->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'nullable|string|max:30',
            'password' => 'required|min:6|confirmed',
            'role'     => 'required|in:admin,masyarakat',
            'status'   => 'required|in:active,inactive',
        ]);

        User::create([
            'name'   => $validated['name'],
            'email'  => $validated['email'],
            'phone'  => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'role'   => $validated['role'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User baru berhasil dibuat.');
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,masyarakat',
        ]);

        // (Opsional) cegah admin mengubah role dirinya sendiri
        if ((int) $user->id === (int) Auth::id()) {
            return back()->with('error', 'Tidak dapat mengubah role akun sendiri.');
        }

        $user->update(['role' => $request->role]);

        return back()->with('success', 'Role user berhasil diperbarui.');
    }

    public function updateStatus(Request $request, User $user)
    {
        $request->validate([
            'status' => 'required|in:active,inactive',
        ]);

        // (Opsional) cegah nonaktifkan akun admin sendiri
        if ((int) $user->id === (int) Auth::id()) {
            return back()->with('error', 'Tidak dapat mengubah status akun sendiri.');
        }

        $user->update(['status' => $request->status]);

        return back()->with('success', 'Status user berhasil diperbarui.');
    }
    
    public function destroy(User $user)
    {
        // Cegah hapus akun sendiri
        if ((int) $user->id === (int) Auth::id()) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        // (Opsional) cegah menghapus admin terakhir
        if ($user->isAdmin() && User::where('role', 'admin')->count() <= 1) {
            return back()->with('error', 'Tidak dapat menghapus admin terakhir.');
        }

        $user->delete();

        return back()->with('success', 'User berhasil dihapus.');
    }
}