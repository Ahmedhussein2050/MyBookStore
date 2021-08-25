<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index()
    {
        // if u will not write query why use query() ? just Book::all();
        $books = Book::query()->get();

        return view('books', compact('books'));
    }
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('show', [
            'book'=>$book
        ]);
    }
    public function create()
    {
        return view('create', [
            'categories' => Category::all()
        ]);
    }
    public function store(Request $request)
    {
        // search for form request validation to make it simple in controller
        // u can use here $this->validate and no need to return back if validation fails or not

        $data = $this->validate($request, [
            'name' => 'required|unique:books,name|max:100|min:3',
            'desc' => 'required|max:100|min:3',
            'categories' => 'required|array',
            'categories.*' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:9048'
        ]);

        // use laravel save file function and store in storage not in public https://laravel.com/docs/8.x/requests#storing-uploaded-files  search for save files in storage

        $imageName = '';

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $imageName = 'images/'.$name;
        }

        // if fillable is compeleted then u can call Book::create($date); but take care from image
        // search for model mutuators like setter in jave to set attribute value and handle image there then u can use Book::create($data);

        $book = new Book();
        $book->name = $request->name;
        $book->desc = $request->desc;
        $book->image = $imageName;
        $book->save();
        // no need to find categories just validate it in rules with exists:categories,id and attach them direcctly
        $categories = Category::findOrFail($request->category);
        $book->categories()->attach($categories);
        // u can use helper redirect(route('route_name')); or         return redirect('/books/'.$book->id);
    }
    public function edit(Book $book)
    {
        // search for route model binding
        // $book = Book::findOrFail($id);
        return view('edit', [
            'book'=>$book
        ]);
    }
    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100|min:3',
            'desc' => 'required|max:100|min:3',
//            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048' make it nullable at update u have it from store
        ]);
        if ($validator->fails()) {
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
    public function delete($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect('books');
    }
}
