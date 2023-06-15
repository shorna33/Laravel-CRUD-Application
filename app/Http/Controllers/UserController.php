<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    // for log in 
    public function login(Request $request) {
        $input_field = $request->validate([
            'your_name' => 'required',
            'your_pass' => 'required'
        ]);

        if (auth()->attempt(['name' => $input_field['your_name'], 'password' => $input_field['your_pass']])) {
            $request->session()->regenerate();
        }
        
        return redirect('/');
    }

    // for log out 
    public function logout() {
        auth()->logout();
        return redirect('/');
    }

    // for register 
    public function register(Request $request) {
        $input = $request->validate([
            'name' => ['required', Rule::unique('users', 'name')],
            'email' => ['required', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:200']
        ]);

        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        auth()->login($user);

        return redirect('/');
    }
}
