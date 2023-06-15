<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost (Request $request) {
        $input = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        // jeno kono html tag na dite pare
        $input['title'] = strip_tags($input['title']);
        $input['body'] = strip_tags($input['body']);

        $input['user_id'] = auth()->id();      /// jei user post korse tar id nisse

        Post::create($input);    /// database a save korar jonno
        return redirect('/');
    }
}
