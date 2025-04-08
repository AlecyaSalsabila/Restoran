@extends('layouts.app')

@section('title', 'Login')

@section('content') 
    <div class="flex items-center justify-center min-h-screen bg-gray-100"> 
        <div class="w-1/2 flex bg-white shadow-lg rounded-lg"> 
            <div class="w-1/2 flex items-center justify-center">
                <img src="{{ asset('img/login.png') }}" alt="Login Image" class="object-cover w-full h-full rounded-l-lg"> 
            </div>
            <div class="p-5 w-3/4">
                <h1 class="text-2xl font-semibold text-center mb-6">LOGIN</h1>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    @include('components.input', [
                        'id' => 'email',
                        'label' => 'Email',
                        'type' => 'email',
                        'name' => 'email',
                        'placeholder' => 'Masukkan email',
                    ])

                    @include('components.input', [
                        'id' => 'password',
                        'label' => 'Password',
                        'type' => 'password',
                        'name' => 'password',
                        'placeholder' => 'Masukkan password',
                    ])

                    <button type="submit" class="w-full bg-blue-600 text-white font-semibold rounded-md py-2 hover:bg-blue-700">Login</button>
                </form>

                <div class="mt-4 text-center">
                    <p>Don't have an account? <a href="{{ route('register.form') }}" class="text-blue-600 hover:underline">Register here</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
