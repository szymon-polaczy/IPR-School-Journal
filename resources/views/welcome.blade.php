<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
</head>

<body class="antialiased">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group mb-3">
            <input type="text" placeholder="Email" id="email" 
                class="form-control" name="email" required autofocus>
            @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <div class="form-group mb-3">
            <input type="password" placeholder="Password" id="password" 
                class="form-control" name="password" required>
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
            <button type="submit" class="btn btn-dark btn-block">Signin</button>
        </div>
    </form>
</body>

</html>