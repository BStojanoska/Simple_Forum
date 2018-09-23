<?php

namespace Forum\Http\Controllers;

use Forum\Category;
use Forum\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Forum\Http\Requests\DiscussionValidation;

class DiscussionController extends Controller
{
    public function discussion($id) {
        $discussion = Discussion::where('id', $id)->with('category', 'user', 'comments')->get();

        return view('discussion', compact('discussion'));
    }

    public function newDiscussion() {
        $categories = Category::all();

        return view('newDiscussion', compact('categories'));
    }

    public function createDiscussion(DiscussionValidation $request) {
        $discussion = new Discussion();
        $photo = Storage::disk('public')->putFile('photos', $request->file('photo'));

        if ($request->category_id != 0) {
            $discussion->title = $request->title;
            $discussion->photo = $photo;
            $discussion->description = $request->description;
            $discussion->category_id = $request->category_id;
            $discussion->user_id = Auth::user()->id;

            $discussion->save();

            return redirect()->route('index')->with('success', 'Discussion successfully created! It needs to be approved before you dig into it though! :)');
        } else {
            return redirect()->route('newDiscussion')->with('message', 'Please choose valid category!');
        }
    }

    public function updateDiscussionForm($id) {
        $discussion = Discussion::find($id);
        $categories = Category::all();
        
        $categories = $categories->diff([$discussion->category]);

        return view('updateForm', compact('discussion', 'categories'));
    }

    public function updateDiscussion(DiscussionValidation $request) {
        $discussion = Discussion::find($request->id);

        $discussion->title = $request->title;
        $discussion->photo = $request->photo;
        $discussion->description = $request->description;
        $discussion->category_id = $request->category_id;

        $discussion->save();

        return redirect()->route('index')->with('success', 'Discussion successfully updated!');
    }

    public function deleteDiscussion($id) {
        $discussion = Discussion::find($id);
        $discussion->comments()->delete();
        $discussion->delete();
        
        return redirect()->route('index')->with('success', 'Discussion successfully deleted!');
    }
}
