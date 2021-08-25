@extends('layouts.book_layout')
@section('title')
    Add Category
@endsection
@section('content')

    <form class="mb-5 w-50 m-auto" method="post" action="{{url('/category/create')}}">
        @csrf
        <div class="m-3">
            <label for="exampleInputEmail1" class="form-label"><h4>Category Name</h4></label>
            @error('email')
            <div class="m-2 w-75 alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Category">
        </div>
        <button type="submit" class="btn btn-primary m-3">Add Category</button>
    </form>
    @foreach($categories as $category)
        <div class="mb-1 w-25 btn btn-success">{{$category->name}}</div>
        <br>
        @foreach($category->books as $book)
            <span class="btn btn-info">{{$book->name}}</span>
        @endforeach
        <hr>
    @endforeach

@endsection
