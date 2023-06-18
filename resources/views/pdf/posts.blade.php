<!doctype html>
<html>
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        table th, table td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h1>All Posts</h1>

    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Body</th>
                <th>Author</th>
                <th>No of Comments</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>{{ $post->body }}</td>
                <td>{{ $post->author->name }}</td>
                <td>{{ $post->comments_count }}</td>
                <td>{{ $post->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
