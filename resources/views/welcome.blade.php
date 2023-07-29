@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div class="antialiased grid md:grid-cols-2 justify-center items-center
    min-h-screen py-16 px-4 md:px-16 gap-4 md:gap-12"
>
    <img src="{{ url('images/undraw_educator_re_ju47.svg') }}" alt=""
        class="row-start-2 md:row-start-1"
    />

    <form method="POST" action="{{ route('login') }}"
        class="flex align-middle justify-center flex-col gap-4 max-w-sm shadow-gray-300
               shadow-2xl mx-auto rounded-lg p-8"
    >
        @csrf

        <h1 class="text-2xl text-gray-900 text-center">
            Login
        </h1>

        <div class="form-group mb-3">
            <input type="text" placeholder="Email" id="email"
                class="simple-input"
                name="email" required autofocus>
            @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <div class="form-group mb-3">
            <input type="password" placeholder="Password" id="password"
                class="simple-input"
                name="password" required>
            @if ($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <div class="form-group mb-3">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> Remember Me
                </label>
            </div>
        </div>

        <div class="d-grid mx-auto">
            <button type="submit" class="std-btn"
            >
                Signin
            </button>
        </div>
    </form>
</div>

@endsection
