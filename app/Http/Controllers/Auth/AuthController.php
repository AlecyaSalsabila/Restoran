<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|ends_with:@gmail.com,@admin.com',
            'password' => 'required|min:8', 
        ], [
            'email.required' => 'Email wajib   diisi',
            'email.ends_with' => 'Email harus diakhiri dengan @gmail.com,@admin.com', 
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password harus terdiri dari minimal 8 karakter.',
        ]);
    
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
    
            if (Str::endsWith($user->email, '@admin.com')) {
                return redirect()->route('menus.index'); 
            }
            
            return redirect()->route('menus.index');
        }
    
        return back()->withErrors([
            'email' => 'Email yang Anda masukkan salah.', 
            'password' => 'Password yang Anda masukkan salah.',
        ])->withInput(['email' => $request->email]);
    }
    
    
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();  
        $user = $this->create($request->all());  
        Auth::login($user);  
        return redirect()->route('login'); 
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'ends_with:@gmail.com', 'not_regex:/@admin\.com$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.ends_with' => 'Email harus diakhiri dengan @gmail.com',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter.',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }
}
