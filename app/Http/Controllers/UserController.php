<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{

//---------------------------------------------------------------
// Register
    function registerForm(){
        return view('Users/register');
    }
    function handleRegister(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users|max:100|min:3',
            'password' => 'required|max:100|min:3',
        ]);
        if ($validator->fails()){
            return redirect('users/register')
                ->withErrors($validator)
                ->withInput();
        }
        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('users/login');
    }

//--------------------------------------------------------------------
    //Log In
    function loginForm(){
        return view('Users/login');
    }
    function handleLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:100|min:3',
            'password' => 'required|max:100|min:3',
        ]);
        if ($validator->fails()){
            return redirect('users/login')
                ->withErrors($validator)
                ->withInput();
        }
        $cred = array(
            'email' => $request->email,
            'password' => $request->password
        );
        if (Auth::attempt($cred)){
            return redirect('/books');
        }else{
            return redirect('users/login');
        }
    }

    //-------------------------------------------------
        //log out
    function logout(){
        Auth::logout();
        return redirect('users/login');
    }

    //--------------------------------------------------
        //notes
    function notes(){
        return view('Users/notes');
    }
    function handleNotes(Request $request){

        $comment = new Comment();
        $comment->content = $request->note;
        $comment->user_id = Auth::user()->id;
        $comment->save();
        return redirect('users/notes');
    }








}
















