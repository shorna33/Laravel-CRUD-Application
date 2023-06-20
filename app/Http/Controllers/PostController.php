<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function deletePost (Post $post) {
        if (auth()->user()->id === $post['user_id']) {
            $post->delete();
        }
        return redirect('/');
    }

    public function updatedPost (Post $post, Request $request) {
        // authenticated user sara edit post dekhte parbena. nijer ta nije dekhte parbe shudhu
        if (auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }

        $input = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $input['title'] = strip_tags($input['title']);
        $input['body'] = strip_tags($input['body']);

        $post->update($input);
        return redirect('/');
    }

    public function showEditScreen(Post $post) {

        if (auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }

        return view('edit-post', ['post' => $post]);
    }

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
