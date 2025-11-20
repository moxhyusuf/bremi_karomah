<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $title = 'User';
        return view('user.index', compact('users', 'title'));
    }

    public function store(Request $request)
    {
        $exists = User::where('email', $request->email)->exists();
        if ($exists) {
            return redirect()
                ->back()
                ->with('message', [
                    'type' => 'danger',
                    'text' => 'Email sudah digunakan. Silakan gunakan email lain.'
                ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        $user->markEmailAsVerified();

        return redirect()
            ->route('user.index')
            ->with('message', [
                'type' => 'success',
                'text' => 'Data User berhasil ditambahkan.'
            ]);
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $exists = User::where('email', $request->email)
            ->where('id', '!=', $user->id)
            ->exists();

        if ($exists) {
            return redirect()
                ->back()
                ->with('message', [
                    'type' => 'danger',
                    'text' => 'email sudah digunakan. Silakan gunakan email lain.'
                ]);
        }


        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'is_active' => $request->is_active,
        ];
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return redirect()
            ->route('user.index')
            ->with('message', [
                'type' => 'success',
                'text' => 'Data User berhasil diperbarui.'
            ]);
    }
}
