<!DOCTYPE html>
<html>

<head>
    <title>My Profile</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TechGropse Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>My Profile</h1>
        <p>Welcome to your profile page!</p>
    </div>
    <br>
    <div style="max-width: 400px;margin: 0 auto;">
        <div style="display: flex; justify-content: space-between;">
        <a href="{{ url('/logout') }}" style="text-decoration: none; padding: 10px; background-color: #f44336; color: #fff; border-radius: 5px;">Logout</a>
        <div class="ms-3">
            <a href="{{ route('posts.create') }}" class="btn btn-success text-nowrap">Create Post</a>
        </div>
        <a href="{{ url('/posts') }}" class="btn btn-success text-nowrap">View All Posts</a>
        </div>
    </div>
</body>

</html>
