<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\MultiImage;
use Image;

class MultiImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function MultiImage()
    {
        $images = MultiImage::all();
        return view('admin/multi_image/index', compact('images'));
    }

    public function UploadImages(Request $request)
    {
        //!TODO: 📙 http://image.intervention.io/getting_started/installation
        $images = $request->file('image');

        foreach ($images as $multi_image) {
            //!👇 second way with image intervention package
            $img_name = hexdec(uniqid()) . '.' . $multi_image->getClientOriginalExtension();
            Image::make($multi_image)->resize(300, 200)->save('images/multiImages/' . $img_name);
            $final_image = 'images/multiImages/' . $img_name;
            //!-------------------------👆 now we resize our image by 300h/200w --------------------------//

            MultiImage::insert([
                'image' => $final_image,
                'created_at' => Carbon::now(),
            ]);
        }

        return Redirect()->back()->with('success', 'Multiple Images Uploaded Successfully!');
    }
}
