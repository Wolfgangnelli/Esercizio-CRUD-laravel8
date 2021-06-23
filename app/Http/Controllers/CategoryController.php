<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function allCategory()
    {
        return view('admin.category.index');
    }

    public function store(StoreCategoryRequest $request)
    {
        /* $category = new Category();
        $category->category_name = $request->input('category_name');
        $category->save();

         */
    }
}
