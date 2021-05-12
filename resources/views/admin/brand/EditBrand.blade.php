<x-app-layout>

    <div class="col-md-12 d-flex justify-content-center">
        <div class='card col-md-4 m-20'>
            <div class='card-header'>
                Edit Brand
            </div>
            <form class='p-10' action="{{url('brand/update/'.$brand->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                {{--👆 without this @csrf we can't post any data --}}

                <input type="hidden" name="old_image" value="{{$brand->brand_image}}" />

                <div class="mb-3">
                    <label class="form-label">Brand Name</label>
                    <input type="text" name='brand_name' value="{{$brand->brand_name}}" class="form-control">
                    {{-- ⚠️ here name field should be match with database column field --}}
                    @error('brand_name')
                    <span class='text-danger'>{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="categoryid" class="form-label">Brand Image</label>
                    <input type="file" name='brand_image' value="{{$brand->brand_image}}" class="form-control">
                    {{-- //here name field should be match with database column field --}}

                    @error('brand_image')
                    <span class='text-danger'>{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group mb-5">
                    <img src="{{asset($brand->brand_image)}}" alt="image" style="height:200px; width:400px" />
                </div>
                <button type="submit" class="btn btn-primary">Update Brand</button>
            </form>
        </div>
    </div>
</x-app-layout>
