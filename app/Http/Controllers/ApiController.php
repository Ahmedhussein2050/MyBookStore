<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    function showBooks(): JsonResponse
    {
        $books = Book::query()->with('categories')->select('id', 'name', 'desc', 'image')->get();
        return response()->json($books);
    }
    function showBook($id): JsonResponse
    {
        $book = Book::query()->with('categories')->select('id', 'name', 'desc', 'image')->findOrFail($id);
        return response()->json($book);
    }
    function storeBook(Request $request): JsonResponse
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:books|max:100|min:3',
            'desc' => 'required|max:100|min:3',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:9048'
        ]);
        if ($validator->fails()){
            return response()->json([
                'message' => 'book not created',
                'error' => $validator->errors()
            ]);
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
        return response()->json([
            'message' => 'Book created',
            'book' => $book
        ]);
    }
    function showUsers(): JsonResponse
    {
        $users = User::query()->with('comments')->select('id', 'email', 'password', 'is_admin')->get();
        return response()->json($users);
    }
}
