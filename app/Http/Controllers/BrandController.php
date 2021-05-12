<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Brand;
use Image;

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

        //!TODO: 📙 http://image.intervention.io/getting_started/installation
        $brand_image = $request->file('brand_image');

        //! 👇 first way without any external library
        // $name_gen = hexdec(uniqid()); //!create unique id
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $img_name = $name_gen . '.' . $img_ext;
        // $upload_location = 'images/brand/';
        // $final_image = $upload_location . $img_name;
        // $brand_image->move($upload_location, $img_name);

        //!👇 second way with image intervention package
        $name_gen = hexdec(uniqid()); //!create unique id
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen . '.' . $img_ext;
        $upload_location = 'images/brand/';
        $final_image = $upload_location . $img_name;
        Image::make($brand_image)->resize(300, 200)->save($final_image);
        //!-------------------------👆 now we resize our image by 300h/200w --------------------------//

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $final_image,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('success', 'Brand Info Inserted Successfully!');
    }

    public function EditBrand($id)
    {
        // $category = DB::table('brands')->where('id', $id)->first();  //! 👈 with required query
        $brand = Brand::find($id); //! 👈 with Eloquent ORM
        return view('admin/brand/EditBrand', compact('brand'));
    }

    public function UpdateBrand(Request $request, $id)
    {
        $request->validate(
            [
                'brand_name' => 'required|unique:brands|min:4',
            ]
        );

        //TODO: 📙 https://scotch.io/tutorials/understanding-and-working-with-files-in-laravel
        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image');

        //! 👇 first way without any external library
        // $name_gen = hexdec(uniqid()); //!create unique id
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $img_name = $name_gen . '.' . $img_ext;
        // $upload_location = 'images/brand/';
        // $final_image = $upload_location . $img_name;
        // $brand_image->move($upload_location, $img_name);

        //!👇 second way with image intervention package
        $name_gen = hexdec(uniqid()); //!create unique id
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen . '.' . $img_ext;
        $upload_location = 'images/brand/';
        $final_image = $upload_location . $img_name;
        Image::make($brand_image)->resize(300, 200)->save($final_image);

        unlink($old_image);
        //! 👆 by using unlink we can remove that image from a particular location

        //! 👇 update with Eloquent ORM (Object Relational Model)
        Brand::find($id)->update([
            'brand_name' => $request->brand_name,
            'brand_image' => $final_image,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('all.brand')->with('success', 'Brand Updated Successfully!');
    }

    public function DeleteBrand($id)
    {
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);
        //!👆 remove image form public local folder

        Brand::find($id)->delete();
        return Redirect()->back()->with('success', 'Brand deleted Successfully!');
    }
}
