<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function AllCat()
    {

        //!👇 Query builder join two table
        // $category = DB::table('categories')
        //     ->join('users', 'categories.user_id', 'users.id')
        //     ->select('categories.*', 'users.name')
        //     ->latest()->paginate(4);

        // $category = Category::all();
        // $category = DB::table('categories')->latest()->get(); //* get data using query builder
        $category = Category::latest()->paginate(4); //? it will return all latest data
        return view('admin/category/index', compact('category'));
        //! this is work like view('admin.category.index') <- we can also use this type
    }

    public function AddCategory(Request $request)
    {
        //TODO: validation  https://laravel.com/docs/8.x/validation#introduction

        $validated = $request->validate(
            [
                'user_category' => 'required|unique:categories|min:6|max:255',
                //! required = here we make user_category input field required
                //! unique = here we make categories DB table unique
                //! max = here we specify that user_category field contain max 255 char
            ],
            [
                //! custome error message
                'user_category.required' => 'Please input category name!',
                'user_category.unique' => 'Category name is already inserted. please add another name',
                'user_category.max' => 'Please input category name less than 255 words',
                'user_category.min' => 'Category name should be 6 to 255 char',
            ]
        );

        //! data save way - 1
        // Category::insert([
        //     'user_category' => $request->user_category,
        //     'user_id' => Auth::user()->id,
        //     'created_at' => Carbon::now()
        // ]);

        //! data save way - 2
        // $category = new Category;
        // $category->user_category = $request->user_category;
        // $category->user_id = Auth::user()->id;
        // $category->created_at = Carbon::now();
        // $category->save();

        //! data save way - 3
        // $data = $request->all(); //* get all input field name
        // $category = new Category;
        // $category->user_category = $data['user_category'];
        // $category->user_id = Auth::user()->id;
        // $category->created_at = Carbon::now();
        // $category->save();

        //! data save way - 4 [N.B: insert data with query builder]
        $data = array();
        $data['user_category'] = $request->user_category;
        $data['user_id'] = Auth::user()->id;
        $data['created_at'] = Carbon::now();
        DB::table('categories')->insert($data);

        return Redirect()->back()->with('success', 'Category Inserted Successfully!');
    }
}
