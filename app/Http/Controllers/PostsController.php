<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Pdf;

use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $search =  $request->search; //Request::get('search');
        $posts = Post::with('author', 'comments')
            ->where(function ($query) use ($search) {
                $query->where('title', 'like', "%$search%")
                    ->orWhereHas('author', function ($query) use ($search) {
                        $query->where('name', 'like', "%$search%");
                    })
                    ->orWhereHas('comments', function ($query) use ($search) {
                        $query->where('body', 'like', "%$search%");
                    });
            })
            ->get();
        //dd( $posts[0]->comments);
        return view('posts.index', compact('posts', 'search'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required'
        ]);
        // Create a new post with the validated data
        $post = Post::create($request->all());
        $post->user_id = Auth::id();
        $post->save();

        return redirect()->route('posts.index');
    }
    public function likes(Request $request)
    {
        $data = Post::find($request->pid);
        $data->like_count = $data->like_count+1;
        $data->save();
        $likesCount = $data->like_count;
        $dislikesCount = $data->dislike_count;

        return response()->json(['like_count' => $likesCount, 'dislike_count' => $dislikesCount]);
    }
    public function dislike(Request $request)
    {
        $data = Post::find($request->pid);
        $data->dislike_count = $data->dislike_count+1;
        $data->save();
        $likesCount = $data->like_count;
        $dislikesCount = $data->dislike_count;

        return response()->json(['like_count' => $likesCount, 'dislike_count' => $dislikesCount]);
    }
    public function pdfDownload(Request $request){
        //return "Success";
        $posts = Post::with('author')->withCount('comments')->get();
        //dd($posts[0]->author);

        $pdf =PDF::loadView('pdf.posts', compact('posts'));
        return $pdf->download('posts.pdf');
    }
}
