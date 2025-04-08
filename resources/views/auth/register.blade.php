@extends('layouts.app')

@section('title', 'Register') 

@section('content') 
<div class="flex items-center justify-center min-h-screen bg-gray-100"> 
    <div class="flex bg-white shadow-2xl rounded-lg w-3/4 h-auto overflow-hidden">
        <div class="w-1/2 flex items-center justify-center">
            <img src="{{ asset('img/register.png') }}" alt="Register Image" class="object-cover w-full h-full"> 
        </div>
        <div class="p-8 w-1/2"> 
            <h1 class="text-2xl font-semibold text-center mb-6">REGISTER</h1>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                @include('components.input', [
                    'id' => 'name',
                    'label' => 'Name',
                    'type' => 'text',
                    'name' => 'name',
                    'placeholder' => 'Masukkan nama',
                ])
                
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
                
                @include('components.input', [
                    'id' => 'password_confirmation',
                    'label' => 'Confirm Password',
                    'type' => 'password',
                    'name' => 'password_confirmation',
                    'placeholder' => 'Konfirmasi password',
                ])

                <button type="submit" class="w-full bg-blue-600 text-white font-semibold rounded-md py-2 hover:bg-blue-700 transition duration-200">Register</button>
            </form>

            <div class="mt-4 text-center">
                <p>Already have an account? <a href="{{ route('login.form') }}" class="text-blue-600 hover:underline">Login here</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
