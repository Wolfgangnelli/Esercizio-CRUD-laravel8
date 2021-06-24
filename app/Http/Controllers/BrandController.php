<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->paginate(env('BRAND_FOR_PAGE'));

        return view('admin.brand.index', compact('brands'));
    }

    public function store(StoreBrandRequest $request)
    {
        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $brand->brand_image = $request->brand_image;

        $this->processFile($request, $brand);
        $res = $brand->save();

        $message = $res ? $brand->brand_name . ' Image saved correctly' : ' Image not saved correctly';
        session()->flash('message', $message);

        return redirect()->back();
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);

        return view('admin.brand.edit', compact('brand'));
    }

    public function update($id, UpdateBrandRequest $request)
    {
        $brand = Brand::findOrFail($id);
        if ($request->brand_image) {
            $brand->brand_name = $request->brand_name;
            $brand->brand_image = $request->brand_image;
            $this->processFile($request, $brand);
            if ($request->old_image) {
                unlink(storage_path('app/public/' . $request->old_image));
            }
            $res = $brand->save();
        } else {
            $res =  $brand->update([
                'brand_name' => $request->brand_name
            ]);
        }

        $message = $res ? $brand->brand_name . ' brand correctly updated!' : $brand->brand_name . ' brand not correctly updated!';
        session()->flash('message', $message);

        return redirect()->back();
    }

    public function delete($id)
    {
        /*  $disk = config('filesystems.default'); */
        $brand = Brand::findOrFail($id);
        $old_img = $brand->brand_image;

        $res = $brand->delete();

        if ($res) {
            $res = Storage::disk('public')->delete($old_img);
        }
        $message = $res ? 'Brand deleted correctly!' : 'Brand not deleted correctly!';
        session()->flash('message', $message);

        return redirect()->back();
    }
    /**
     * Process image files. Verify is it file, generate unique random img name, extension and create a path
     * @param Brand $brand
     * @param Request $request
     * @return boolean
     */
    public function processFile($request = null, Brand $brand)
    {
        if (!$request) {
            $request = request();
        }
        if (!$request->hasFile('brand_image')) {
            return false;
        }

        $brand_image = $request->file('brand_image');

        if (!$brand_image->isValid()) {
            return false;
        }

        $name_generate = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_generate . '.' . $img_ext;
        /* $path = env('IMG_BRAND_DIR') . '/' . $img_name; */
        /*  $brand_image->move(env('IMG_BRAND_DIR'), $img_name); */
        $path = $brand_image->storeAs(env('IMG_BRAND_DIR'), $img_name, 'public');
        $brand->brand_image = $path;

        return true;
    }
}
