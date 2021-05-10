<x-app-layout>

    <div class="col-md-12 d-flex justify-content-center">
        <div class='card col-md-4 m-20'>
            <div class='card-header'>
                Edit Category
            </div>
            <form class='p-10' action="{{url('category/update/'.$category->id)}}" method="POST">
                @csrf
                {{--👆 without this @csrf we can't post any data --}}
                <div class="mb-3">
                    <label class="form-label">Category Name</label>
                    <input type="text" name='user_category' value="{{$category->user_category}}" class="form-control">
                    {{-- ⚠️ here name field should be match with database column field --}}
                    @error('user_category')
                    <span class='text-danger'>{{$message}}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-secondary">Update Category</button>
            </form>
        </div>
    </div>
</x-app-layout>
