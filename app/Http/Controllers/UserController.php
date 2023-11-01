<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Display the users.
     */
    public function index(Request $request): Response
    {
        return Inertia::render('User/Index', [
            'users' => User::all(),
        ]);
    }
}
