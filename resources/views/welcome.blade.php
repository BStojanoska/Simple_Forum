@extends('layouts.app')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success col-10 mx-auto">
            {{session()->get('success')}}
        </div>
    @endif

    @if (session()->has('message'))
        <div class="alert alert-danger col-10 mx-auto">
            {{session()->get('message')}}
        </div>
    @endif

    <h1 class="text-center pb-5">Welcome to the Forum</h1>
    <div class="col-8 mx-auto">
        <a href="{{route('newDiscussion')}}" class="btn btn-secondary">Add new discussion</a>
    </div>
    <div class="col-8 mx-auto my-2">
        @if (Auth::user())
            @if (Auth::user()->hasRole('admin'))
                <a href=" {{route('admin')}} " class="btn btn-info">Approve disscussions</a>
            @endif
        @endif
    </div>

    @if (!$discussions->isEmpty())
        <div class="row mx-0">
            @foreach ($discussions as $discussion)    
                <div class="col-8 mx-auto card my-1 py-3">
                    <span class="card-body d-flex align-items-center">
                        <img class="col-auto" src=" {{asset('storage/' . $discussion->photo)}} " width="50px" height="50px" />
                        <div class="col-8 ">
                            <h4 class="card-title"> <a href="{{URL('discussion/' . $discussion->id)}}"> {{ $discussion->title}} </a></h4>
                            <p class="card-subtitle text-muted text-truncate"> {{$discussion->description}} </p>
                        </div>
                        
                        @if (Auth::user())
                            @if(Auth::user()->hasRole('admin') || $discussion->user->id == Auth::user()->id)
                                <span class="col text-right">
                                    @if ($discussion->is_approved == 0)
                                    <a href="{{URL('/approve/' . $discussion->id)}}" ><i class="fas fa-check"></i> </a>
                                    @endif
                                    <a href="{{URL('/discussion/edit/' . $discussion->id)}}" ><i class="fas fa-edit"></i> </a>
                                    <a href="{{URL('/discussion/delete/' . $discussion->id)}}" ><i class="fas fa-trash-alt"></i> </a>
                                </span>
                            @endif
                        @endif
                        <p class="text-muted ml-auto"> {{$discussion->category->category}} | {{$discussion->user->username}}</p>
                    </span>
                </div>
            @endforeach
        </div>
        <div class="row mx-0"> 
            <div class="mx-auto mt-3">
                {{$discussions->links()}} 
            </div>
        </div>
        @else
            <h4 class="text-muted text-center pt-5">Nothing here yet! Start a topic!</h4>
        @endif
@endsection