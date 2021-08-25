<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class BookController extends Controller
{
    public function index(){
        $books = Book::query()->get();

        return view('books', compact('books'));
    }
    public function show($id){
        $book = Book::query()->findOrFail($id);
        return view('show', [
            'book'=>$book
        ]);
    }
    public function create(){
        $categories = Category::query()->get();
        return view('create', [
            'categories' => $categories
        ]);
    }
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:books|max:100|min:3',
            'desc' => 'required|max:100|min:3',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:9048'
        ]);
        if ($validator->fails()){
            return redirect('books/create')
                ->withErrors($validator)
                ->withInput();
        }
        $imageName = '';

        if ($request->hasFile('image')){
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $imageName = 'images/'.$name;
        }

        $book = new Book();
        $book->name = $request->name;
        $book->desc = $request->desc;
        $book->image = $imageName;
        $book->save();
        $categories = Category::query()->findOrFail($request->category);
        $book->categories()->attach($categories);
        return redirect('/books/'.$book->id);

    }
    public function edit($id){
        $book = Book::query()->findOrFail($id);
        return view('edit', [
            'book'=>$book
        ]);
    }
    public function update($id, Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100|min:3',
            'desc' => 'required|max:100|min:3',
//            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);
        if ($validator->fails()){
            return redirect('books/update/'.$id)
                ->withErrors($validator)
                ->withInput();
        }
        $book = Book::query()->findOrFail($id);
        $book->name = $request->name;
        $book->desc = $request->desc;
        $book->save();
        return redirect('/books/'.$book->id);
    }
    public function delete($id){
        $book = Book::query()->findOrFail($id);
        $book->delete();
        return redirect('books');
    }




























}
