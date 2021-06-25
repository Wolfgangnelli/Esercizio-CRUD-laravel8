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

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function allCategory()
    {
        //Query builder
        /* $categories = DB::table('categories')
        ->join('users', 'categories.user_id', 'users.id')
        ->select('categories.*', 'users.name')
        ->latest()->paginate(env('CATEGORY_FOR_PAGE')); */

        $categories = Category::with('user')->latest()->paginate(env('CATEGORY_FOR_PAGE'));
        $trashCat = Category::onlyTrashed()->latest()->paginate(3);
        return view('admin.category.index', compact('categories', 'trashCat'));
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

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.category.edit', compact('category'));
    }

    public function update(StoreCategoryRequest $request, $id)
    {
        Category::findOrFail($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('all.category')->with('success', 'Category updated correctly!');
    }

    public function softDelete($id)
    {
        Category::destroy($id);

        return redirect()->back()->with('success', 'Category soft deleted correctly!');
    }

    public function forceDelete($id)
    {
        Category::onlyTrashed()->find($id)->forceDelete();

        return redirect()->back()->with('success1', 'Category deleted permanently!');
    }

    public function restore($id)
    {
        Category::withTrashed()->find($id)->restore();

        return redirect()->back()->with('success1', 'Category restored correctly!');
    }
}
