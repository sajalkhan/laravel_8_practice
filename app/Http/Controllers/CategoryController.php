<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //! __constructor is a special function it will call automatically when object is created
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        $trashCategory = Category::onlyTrashed()->latest()->paginate(3, ['*'], 'trashed'); //? show delete data from here
        //!👉 here this  (3, ['*'], 'trashed') help us to use multiple pagination in one page.
        //!   Other wise if one paginate changes another one is also effected

        return view('admin/category/index', compact('category', 'trashCategory'));
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

    public function EditCategory($id)
    {
        // $category = DB::table('categories')->where('id', $id)->first();  //! 👈 with required query
        $category = Category::find($id); //! 👈 with Eloquent ORM
        return view('admin/category/EditCategory', compact('category'));
    }

    public function UpdateCategory(Request $request, $id)
    {
        $request->validate(
            ['user_category' => 'required|unique:categories|min:6|max:255'],
        );

        //! 👇 update with Eloquent ORM (Object Relational Model)
        // $update = Category::find($id)->update([
        //     'user_category' => $request->user_category,
        //     'user_id' => Auth::user()->id,
        //     'created_at' => Carbon::now()
        // ]);

        //! 👇 update with Required query
        $data = array();
        $data['user_category'] = $request->user_category;
        $data['user_id'] = Auth::user()->id;
        $data['created_at'] = Carbon::now();
        DB::table('categories')->where('id', $id)->update($data);

        return Redirect()->route('all.category')->with('success', 'Category Updated Successfully!');
    }

    public function SoftdeleteCategory($id)
    {
        $delete = Category::find($id)->delete();  //!⚠️ this data will go to trash data
        return Redirect()->back()->with('success', 'Category Soft Deleted Successfully!');
    }

    public function RestoreCategory($id)
    {
        $restore = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success', 'Category Restore Successfully!');
    }

    public function DeleteCategory($id)
    {
        $pdelete = Category::withTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success', 'Category permanently deleted Successfully!');
    }
}
