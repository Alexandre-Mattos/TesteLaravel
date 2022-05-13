<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('login');

    }

    public function store( Request $request ) {
        $dados = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        User::where('email', $dados['email'])
            ->where('password', $dados['password'])
            ->first();
        return view('welcome');
    }
}
