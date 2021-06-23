<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function allCategory()
    {
        return view('admin.category.index');
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = new Category;
        $category->category_name = $request->input('category_name');
        $category->user_id = Auth::user()->id;
        $category->save();
        /*   Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => now(),
        ]); */

        return redirect()->back()->with('success', 'Category inserted successfully!');
    }
}
