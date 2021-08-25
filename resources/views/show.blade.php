@extends('layouts.book_layout')
@section('title')
{{$book->name}}
@endsection
@section('content')
<h2>{{$book->name}}</h2>
<p>{{$book->desc}}</p>
<div class="mb-1">
    @foreach($book->categories as $category)
        <span class="btn btn-primary">{{$category->name}}</span>
    @endforeach
</div>
<img class="img img-fluid" src="{{asset($book->image)}}">
<button class="btn btn-primary"><a href="{{url('/books')}}" style="text-decoration: none; color: white;">All Books</a></button>
@if(\Illuminate\Support\Facades\Auth::user()->is_admin)
<button class="btn btn-success"><a href="{{url('/books/edit/'.$book->id)}}" style="text-decoration: none; color: white;">Edit</a></button>
<button class="btn btn-danger"><a href="{{url('/books/delete/'.$book->id)}}" style="text-decoration: none; color: white;">Delete</a></button>
@endif
@endsection

