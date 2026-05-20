<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        abort_if(
            auth()->user()->role->value !== 'admin',
            403
        );

        $users = User::withCount('tasks')
            ->latest()
            ->paginate(10);

        return view('users.index', compact('users'));
    }
}