<?php

namespace Forum\Http\Controllers;

use Forum\Category;
use Forum\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouteController extends Controller
{
    public function index() {
        $discussions = Discussion::where('is_approved', 1)->with('category', 'user')->orderBy('created_at', 'desc')->paginate(5);

        return view('welcome', compact('discussions'));
    }

    public function admin() {
        $discussions = Discussion::where('is_approved', 0)->with('category', 'user')->orderBy('created_at', 'desc')->paginate(5);
        
        return view('welcome', compact('discussions'));
    }

    public function approve($id) {
        $discussion = Discussion::find($id);

        $discussion->is_approved = 1;
        $discussion->save();

        return redirect()->route('admin')->with('success', 'Discussion has been approved!');
    }
}
