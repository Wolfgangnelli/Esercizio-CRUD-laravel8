<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function allCategory()
    {
        //Query builder
        /* $categories = DB::table('categories')
        ->join('users', 'categories.user_id', 'users.id')
        ->select('categories.*', 'users.name')
        ->latest()->paginate(env('CATEGORY_FOR_PAGE')); */
        $categories = Category::with('user')->latest()->paginate(env('CATEGORY_FOR_PAGE'));
        return view('admin.category.index', compact('categories'));
    }

    public function store(StoreCategoryRequest $request)
    {
        /*   Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => now(),
        ]); */
        $category = new Category;
        $category->category_name = $request->input('category_name');
        $category->user_id = Auth::user()->id;
        $category->save();

        return redirect()->back()->with('success', 'Category inserted successfully!');
    }
}
