<?php

namespace Forum\Http\Controllers;

use Forum\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Forum\Http\Requests\CommentValidation;

class CommentController extends Controller
{
    public function newComment($id) {
        
        return view('commentForm', compact('id'));
    }

    public function createComment(CommentValidation $request) {
        $comment = new Comment();

        $comment->comment = $request->comment;
        $comment->user_id = Auth::user()->id;
        $comment->discussion_id = $request->id;

        $comment->save();

        return redirect()->route('discussion', [$request->id]);
    }

    public function updateCommentForm($id) {
        $comment = Comment::find($id);

        return view('updateCommentForm', compact('comment'));
    }

    public function updateComment(CommentValidation $request) {
        $comment = Comment::find($request->id);

        $comment->comment = $request->comment;

        $comment->save();

        return redirect()->route('discussion', [$comment->discussion_id])->with('success', 'Comment successfully updated!');
    }

    public function deleteComment($id) {
        $comment = Comment::find($id);
        
        $discussion_id = $comment->discussion_id;
        $comment->delete();
        
        return redirect()->route('discussion', [$discussion_id])->with('success', 'Comment successfully deleted!');
    }
}
