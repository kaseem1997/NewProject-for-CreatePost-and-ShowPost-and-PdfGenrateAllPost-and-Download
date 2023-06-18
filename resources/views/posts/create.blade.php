<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TechGropse Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<div class="w-50 mx-auto py-5">
    <h1 class="mb-4">Create Posts</h1>
<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <input type="hidden" class="form-control" name="user_id" id="user_id" value="{{Auth::user()->id}}" required>
    <div class="mb-3">
        <label for="title d-block">Title:</label>
        <input type="text" class="form-control mt-2" name="title" id="title" required>
    </div>
    <div class="mb-3">
        <label for="body d-block">Body:</label>
        <textarea name="body" class="form-control mt-2" id="body" required style="resize:none;height:150px;"></textarea>
    </div>
    <div class="d-flex justify-content-between">
    <a href="{{ route('profile') }}" class="btn btn-danger text-nowrap">Back</a>
        <button type="submit" class="btn btn-primary">Create Post</button>
    </div>
</form>
</div>

