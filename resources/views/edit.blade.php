@extends('layouts.book_layout')
@section('title')
    Edit book
@endsection
@section('content')

    <form class="mb-5 w-50 m-auto" method="post" action="{{url('/books/update', $book->id)}}">
        @csrf
        <div class="m-3">
            <label for="exampleInputEmail1" class="form-label">Book Name</label>
            @error('name')
            <div class="m-2 w-75 alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="text" value="{{$book->name}}" name="name" class="form-control" id="exampleInputEmail1">
        </div>
        <div class="m-3">
            <label for="exampleInputPassword1" class="form-label">Book description</label>
            @error('desc')
            <div class="m-2 w-75 alert alert-danger">{{ $message }}</div>
            @enderror
            <input class="form-control" value="{{$book->desc}}" name="desc" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary m-3">Edit Book</button>
    </form>

@endsection
