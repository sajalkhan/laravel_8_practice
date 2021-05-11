<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Brand;

class BrandController extends Controller
{
    public function AllBrand()
    {
        $brand = Brand::latest()->paginate(4); //? it will return all latest data
        return View('admin/brand/index', compact('brand'));
    }

    public function AddBrand(Request $request)
    {
        $validated = $request->validate(
            [
                'brand_name' => 'required|unique:brands|min:4',
                'brand_image' => 'required|mimes:jpg,jpeg,png,gif',
            ]
        );

        $brand_image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()); //!create unique id

        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen . '.' . $img_ext;
        $upload_location = 'images/brand/';
        $final_image = $upload_location . $img_name;
        $brand_image->move($upload_location, $img_name);

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $final_image,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('success', 'Brand Info Inserted Successfully!');
    }
}
