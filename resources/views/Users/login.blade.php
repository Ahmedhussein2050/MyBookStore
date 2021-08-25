@extends('layouts.book_layout')
@section('title')
    login
@endsection
@section('content')

    <form class="mb-5 w-50 m-auto" method="post" action="{{url('/users/login')}}">
        @csrf
        <div class="m-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            @error('email')
            <div class="m-2 w-75 alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="email" value="{{old('email')}}" name="email" class="form-control" id="exampleInputEmail1">
        </div>
        <div class="m-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            @error('password')
            <div class="m-2 w-75 alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="password" class="form-control" name="password" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary m-3">Log In</button>
    </form>

@endsection
