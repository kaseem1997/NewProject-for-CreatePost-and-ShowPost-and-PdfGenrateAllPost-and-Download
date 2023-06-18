<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TechGropse Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <div class="d-flex justify-content-between" style="padding:30px 50px;">
        <form action="{{ route('posts.index') }}" method="GET">
            @csrf
            <div class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search posts" value="{{ $search }}">
                <button type="submit" class="btn btn-secondary">Search</button>
                <div class="ms-3">
                    <a href="{{ route('posts.create') }}" class="btn btn-success text-nowrap">Create Post</a>
                </div>
            </div>
           
        </form>
        <div>
            <a href="{{ route('pdf.download') }}" class="btn btn-danger me-3">PDF Download</a>
            <a href="{{ url('/logout') }}" class="btn btn-danger">Logout</a>
        </div>
    </div>
    <div style="padding:20px 50px;">
        <table class="table table-striped" style="width:100%;">
            <thead class="thead-light" style="background-color: #cbeaff;">
                <tr>
                    <th style="background-color:transparent;">S.NO</th>
                    <th style="background-color:transparent;">Title</th>
                    <th style="background-color:transparent;">Body</th>
                    <th style="background-color:transparent;">Author</th>
                    <th style="background-color:transparent;">Comments</th>
                    <th style="background-color:transparent;">Action</th>
                    <th style="background-color:transparent;">Like & Deslike</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->body }}</td>
                    <td>{{ $post->author->name }}</td>
                    <td>@foreach($post->comments as $key => $comment) @if($key>0) <br>{{$comment->body}} @else {{$comment->body}} @endif
                        @endforeach
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary comment-modal-btn pid" id="comment-modal-{{ $post->id }}" data-post-id="{{ $post->id }}" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add Comment</button></td>
            
                    <td>
                        <button class="like-button activity btn btn-primary" data-type="lk" data-post-id="{{ $post->id }}">Like <span>({{$post->like_count}})</span></button>
                        <button class="dislike-button activity btn btn-primary" data-type="dl" data-post-id="{{ $post->id }}">Dislike <span>({{$post->dislike_count}})</span></button>
                    </td>
                </tr>
                @endforeach
                <div class="modal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Comment</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="comment-modal">
                                <form id="comment-form" class="comment-form">
                                    @csrf
                                    <input type="hidden" class="form-control" name="post_id" id="post_id">
                                    <div>
                                        <textarea name="body" class="form-control" id="body" rows="4" required></textarea>
                                    </div>
                                    <div class="d-flex justify-content-end mt-3">
                                    <button type="submit" class="btn btn-primary">Add Comment</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- <div id="comment-modal" class="modal">
                    <div class="modal-content">
                        <form id="comment-form" class="comment-form">
                            @csrf
                            <input type="hidden" class="form-control" name="post_id" id="post_id">
                            <div>
                                <label for="body">Comment:</label>
                                <textarea name="body" class="form-control" id="body" rows="4" required></textarea>
                            </div>
                            <button type="submit">Add Comment</button>
                        </form>
                    </div>
                </div> -->
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <!-- Your HTML content here -->

    <!-- Add this before the closing </body> tag -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.like-button').click(function() {
                var postId = $(this).data('post-id');
                var urll = '{{url("/posts/likes")}}';
                $.ajax({
                    url: urll + '/' + postId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // $('#likes-count').text(response.likes);
                        // $('#dislikes-count').text(response.dislikes);
                        window.location.reload();
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            $('.dislike-button').click(function() {
                var postId = $(this).data('post-id');
                var url = '{{url("/posts/dislike")}}';
                $.ajax({
                    url: url + '/' + postId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // $('#likes-count').text(response.likes);
                        // $('#dislikes-count').text(response.dislikes);
                        window.location.reload();
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Listen to submit events on the comment form
            $('#comment-form').submit(function(event) {
                event.preventDefault();
                const postId = $('#post_id').val();
                const body = $('#body').val();
                const token = $('meta[name="csrf-token"]').attr('content');

                // Send an AJAX request to add the comment
                $.ajax({
                    url: '{{ route("comments.store") }}',
                    type: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    data: JSON.stringify({
                        post_id: postId,
                        body: body
                    }),
                    success: function(data) {
                        // Handle the response, e.g., display the comment or refresh the page
                        console.log(data);
                        $('#comment-form')[0].reset();
                        $('#comment-modal').modal('hide');
                        // You can update the UI to show the newly added comment without refreshing the page
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });
        });
        $(document).on('click', '.pid', function() {
            var postId = $(this).data('post-id');
            $('#post_id').val(postId);
            $('#comment-modal').modal('show');
        });
        $('.btn-close').on('click', function() {
            $('.modal-backdrop').removeClass('show');
            $('.modal-backdrop').hide();
        });
    </script>

</body>

</html>