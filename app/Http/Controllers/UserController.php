<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    // for log in 
    public function login(Request $request) {
        $input_field = $request->validate([
            'your_name' => 'required',
            'your_pass' => 'required|min:5'
        ]);

        if (auth()->attempt(['name' => $input_field['your_name'], 'password' => $input_field['your_pass']])) {
            $request->session()->regenerate();
            return redirect('/');
        }
        else {
            return back()->withErrors([
                $message = ['The provided password does not match our records.']
            ]);
            // return redirect('/sign-in');
        }

        // $credentials = [
        //     'your_name' => $request->name,
        //     'your_pass' => $request->password
        // ];

        // if (Auth::attempt($credentials)) {
        //     return redirect('/')->with('success');
        // }
        // return back()->with('error', 'Incorrect Name or Password');
        
    }

    // for log out 
    public function logout() {
        auth()->logout();
        return redirect('/');
    }

    // for register 
    public function register(Request $request) {
        $input = $request->validate([
            'name' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|min:5|max:200|alpha_dash'
        ]);

        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        auth()->login($user);

        return redirect('/');
    }
}
