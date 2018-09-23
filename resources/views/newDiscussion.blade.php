@extends('layouts.app')

@section('content')
    @if (session()->has('message'))
        <div class="alert alert-danger col-5 mx-auto">
            {{session()->get('message')}}
        </div>
    @endif

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
        <form method="POST" action="{{route('createDiscussion')}}" class="mx-auto col-5" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="form-group">
                <label for="photo">Photo</label>
                <input type="file" class="form-control-file" id="photo" name="photo">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea row=5 class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category_id">
                    <option value="0" class="form-control">Choose</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}" class="form-control"> {{$category->category}}</option>
                    @endforeach
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>

            @csrf
        </form>
    </div>
@endsection