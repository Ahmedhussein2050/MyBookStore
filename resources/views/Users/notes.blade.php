@extends('layouts.book_layout')
@section('title')
    Notes
@endsection
@section('content')

    <form class="mb-5 w-50 m-auto" method="post" action="{{url('/users/notes')}}">
        @csrf
        <div class="m-3">
            <label for="exampleInputEmail1" class="form-label">Note</label>
            @error('email')
            <div class="m-2 w-75 alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="text" name="note" class="form-control" id="exampleInputEmail1" placeholder="Write Your Note!">
        </div>
        <button type="submit" class="btn btn-primary m-3">Add Note</button>
    </form>

    @foreach(\Illuminate\Support\Facades\Auth::user()->comments as $comment)

        <div class="alert alert-success">
            {{$comment->content}}
            <h3>user_id: {{$comment->user_id}}</h3>
        </div>


    @endforeach

@endsection
