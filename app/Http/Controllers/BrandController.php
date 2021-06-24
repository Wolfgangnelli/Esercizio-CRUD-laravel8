<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->paginate(env('BRAND_FOR_PAGE'));

        return view('admin.brand.index', compact('brands'));
    }

    public function store(Request $request)
    {
        # code...
    }
}
