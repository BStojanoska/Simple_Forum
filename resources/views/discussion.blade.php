@extends('layouts.app')

@section('content')
    <h1 class="text-center pb-5">Welcome to the Forum</h1>

    @if (session()->has('success'))
        <div class="alert alert-success col-10 mx-auto">
            {{session()->get('success')}}
        </div>
    @endif

    <div class="row">
        @foreach ($discussion as $item)
            <div class="col-8 mx-auto card my-1 py-3">
                <div class="card-body d-flex align-items-center row">
                    <p class="text-muted col-12 text-right"> {{$item->category->category}} | {{$item->user->username}}</p>
                    <img class="col-8 mx-auto" src=" {{asset('storage/' . $item->photo)}} " width="500px" height="500px" >
                    <div class="col-8 mx-auto mt-5">
                        <h4 class="card-title"> {{$item->title}} </h4>
                        <p class="card-subtitle text-muted"> {{$item->description}} </p>
                    </div>
                </div>
            </div>

            <h2 class="col-8 mx-auto my-3">Comments:</h2>

            <div class="col-8 offset-2 py-3">
                <a href="{{URL('comment/' . $item->id)}}" class="btn btn-secondary">Add comment</a>
            </div>

            @foreach ($item->comments as $comment)
                <div class="card col-8 mx-auto my-1">
                    <div class="card-body">
                        <div class="d-flex justify-space-between row">
                            <span class="col h6">{{$comment->user->username}} says:</span>
                            <span class="col text-right text-muted">{{$comment->created_at}}</span>
                        </div>
                        {{$comment->comment}}
                        @if (Auth::user())
                            @if(Auth::user()->hasRole('admin') || $comment->user->id == Auth::user()->id)
                                <span class="col mr-auto">
                                    <a href="{{URL('/comment/edit/' . $comment->id)}}" ><i class="fas fa-edit"></i> </a>
                                    <a href="{{URL('/comment/delete/' . $comment->id)}}" ><i class="fas fa-trash-alt"></i> </a>
                                </span>
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
@endsection