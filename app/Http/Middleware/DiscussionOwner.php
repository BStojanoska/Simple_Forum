<?php

namespace Forum\Http\Middleware;

use Closure;
use Forum\Discussion;
use Illuminate\Support\Facades\Auth;

class DiscussionOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        $userId = Discussion::find($request->route()->id)->user->id;
        $owner = 0;
        
        if (Auth::user()->hasRole('admin')) {
            $owner = 1;
        } 
        if (Auth::user()->id == $userId) {
            $owner = 1;
        }

        if ($owner == 0) {
            session()->flash('message', 'You cannot do that! You are not the owner!');

            return redirect()->route('index');
        } else {   
            return $next($request);
        }
    }
}
