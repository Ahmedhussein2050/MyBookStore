<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function create(){
        $cats = Category::query()->get();
        return view('Category/create', [
            'categories' => $cats
        ]);
    }
    function store(Request $request){
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return redirect('category/create');
    }
}
