<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
  public function store(StoreCommentRequest $request, Post $post)
{
    $post->comments()->create(array_merge(
        $request->validated(), 
        ['user_id' => auth()->id()]
    ));
    return redirect()->route('posts.show', $post->id)->with('status', 'Comment posted.');
}
}
