@extends('layouts.book_layout')
@section('title')
    All Books
@endsection
@section('content')
    <div class="row">
        @foreach ($books as $book)
            <div class="col-lg-3 m-3">
                <div>
                    <h2><a href="{{ url('/books', $book->id) }}">{{ $book->name }}</a></h2>
                    <p class="w-50">{{ substr($book->desc, 0, 20) }}</p>
                    <div>
                        <img style="height: 80px" class="img w-50 mb-2" src="{{ asset($book->image) }}">
                    </div>
                    <div class="mb-1">
                        @foreach ($book->categories as $category)
                            <span class="btn btn-primary">{{ $category->name }}</span>
                        @endforeach
                    </div>
                    @if (\Illuminate\Support\Facades\Auth::user()->is_admin == 1)
                        <button class="btn btn-success"><a href="{{ route('books.edit', $book) }}"
                                style="text-decoration: none; color: white;">Edit</a></button>
                        {{-- <button class="btn btn-success"><a href="{{url('/books/edit/'.$book->id)}}" style="text-decoration: none; color: white;">Edit</a></button> --}}
                        <button class="btn btn-danger"><a href="{{ url('/books/delete/' . $book->id) }}"
                                style="text-decoration: none; color: white;">Delete</a></button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection
