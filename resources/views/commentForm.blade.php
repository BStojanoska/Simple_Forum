@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger col-5 mx-auto">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row m-0">
        <form method="POST" action="{{route('createComment')}}" class="mx-auto col-5">
            <input type="hidden" name="id" value="{{$id}}" >
        
            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea row=5 class="form-control" id="comment" name="comment"></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>

            @csrf
        </form>
    </div>
@endsection