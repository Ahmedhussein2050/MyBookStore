@extends('layouts.book_layout')
@section('title')
    create book
@endsection
@section('content')

{{--    @if($errors->any())--}}
{{--    @foreach($errors->all() as $error)--}}
{{--        <div class="m-2 w-50 m-auto"><p class="alert alert-danger">{{$error}}</p></div>--}}
{{--    @endforeach--}}
{{--    @endif--}}
    <form class="mb-5 w-50 m-auto" method="post" action="{{url('/books/store')}}" enctype="multipart/form-data">
        @csrf
        <div class="m-3">
            <label for="exampleInputEmail1" class="form-label">Book Name</label>
            @error('name')
            <div class="m-2 w-75 alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="text" value="{{old('name')}}" name="name" class="form-control" id="exampleInputEmail1">
        </div>
        <div class="m-3">
            <label for="exampleInputPassword1" class="form-label">Book description</label>
            @error('desc')
            <div class="m-2 w-75 alert alert-danger">{{ $message }}</div>
            @enderror
            <input class="form-control" value="{{old('desc')}}" name="desc" id="exampleInputPassword1">
        </div>
        <label class="px-3 form-label">Category/ies</label>
        <br>
    @foreach($categories as $category)
            <span class="p-3">
                <input type="checkbox" name="category[]" value="{{$category->id}}">
                {{$category->name}}
            </span>
        @endforeach
        <div class="m-3">
            <label for="exampleInputPassword1" class="form-label">Image</label>
            @error('desc')
            <div class="m-2 w-75 alert alert-danger">{{ $message }}</div>
            @enderror
            <input class="form-control" name="image" id="exampleInputPassword1" type="file" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary m-3">Add Book</button>
    </form>

@endsection
