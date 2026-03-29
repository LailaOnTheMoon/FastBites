<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'FastBites') }} — Fast Food, Faster Delivery</title>

    <!-- Modern font -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css'])
</head>
    <body>
        <h1>This is {{ $full_name }}</h1>
        <p>Email: {{ $email }}</p>
        <p>Welcome to the test page. This is where you can test new features or designs before they go live.</p>
                <div>
            <p>Here are some test buttons:</p>
            <a class="btn btn-primary mt-4" href="{{ route('updateUserTest') }}">Update User</a>
            <a class="btn btn-primary mt-4" href="{{ route('createUserTest') }}">Create User</a>
        </div>
    </body>
</html>