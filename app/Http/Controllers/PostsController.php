<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    // authenticated so index page only shows posts from the authed user 
    public function __construct() {
      $this->middleware('auth');
    }
    
    public function index() {
      // get the user_id from users that the authenticated user is following
      $users = auth()->user()->following()->pluck('profiles.user_id');
      // get the posts of those users
      $posts = Post::whereIn('user_id', $users)->latest()->get();

      //dd($posts);
      return view('posts.index', compact('posts'));
    }

    public function create() {
      return view('posts.create');
    }

    public function store(Request $request) {
      //dd($request->caption);
      $data = $this->validate($request, [
        'caption' => 'required',
        'image' => 'required|mimes:png,jpg,jpeg'
      ]);

      // save image in storage/app/public/uploads
      $imagePath = $request->image->store('uploads', 'public');

      auth()->user()->posts()->create([
        'caption' => $data['caption'],
        'image' => $imagePath
      ]);

      return redirect('/profile/' . auth()->user()->id);
    }

    public function show(Post $post) {
      // figure how how to determine if the current user has liked the post
      // if the user is authed,
      $likes = auth()->user() ? 
        // get the authed user like that contains the $post passed in 
        auth()->user()->like->contains($post->id): false;

        //dd($likes);
      
      return view('posts.show', compact('post', 'likes'));
    }
}
