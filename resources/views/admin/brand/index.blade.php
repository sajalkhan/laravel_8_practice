<script>
    setTimeout(()=> {
        var x = document.getElementById("alert");

        if(x?.style) {
           x.style.display = 'none';
        }
    },[3000]);
</script>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Brand
        </h2>
    </x-slot>

    <div class="py-12">
        <div class='container'>
            <div class='row'>

                @if (session('success'))
                <div id='alert' class="alert alert-success alert-dismissible fade show col-md-8" role="alert">
                    <strong>{{session('success')}}</strong>
                </div>
                @endif

                <div class='col-md-8'>
                    <div class='card'>
                        <div class='card-header'>All Brands</div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Sl No.</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Brand Image</th>
                                    <th scope="col">Created At</th>
                                    <th scope='col'>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                {{-- @php ($i = 1) --}}
                                @foreach ($brand as $brnd)
                                <tr>
                                    <td>{{$brand->firstItem()+$loop->index}}</td>
                                    <td>{{$brnd->brand_name}}</td>
                                    <td><img src="{{asset($brnd->brand_image)}}" alt="image"
                                            style="height:50px; width:50px" />
                                    </td>

                                    <td>
                                        @if ($brnd->created_at == null)
                                        <span class='text-danger'>No Date set</span>
                                        @else
                                        {{-- 👇 --it's not work with query builder --}}
                                        {{$brnd->created_at->diffForHumans()}}
                                        {{-- 👇 this is usefule when we read data from query builder
                                            <td>{{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td>--}}
                                    @endif
                                    </td>
                                    <td>
                                        <a href="{{url('brand/edit/'.$brnd->id)}}" class='btn btn-info'>Edit</a>
                                        <a href="{{url('brand/delete/'.$brnd->id)}}" class='btn btn-danger'>Delete</a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{$brand->links()}}
                    </div>

                </div>

                <div class="col-md-4">
                    <div class='card'>
                        <div class='card-header'>
                            Add Brand
                        </div>
                        <form class='p-10' action='{{route('store.brand')}}' method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            {{--👆 without this @csrf we can't post any data --}}
                            <div class="mb-3">
                                <label for="categoryid" class="form-label">Brand Name</label>
                                <input type="text" name='brand_name' class="form-control">
                                {{-- //here name field should be match with database column field --}}

                                @error('brand_name')
                                <span class='text-danger'>{{$message}}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="categoryid" class="form-label">Brand Image</label>
                                <input type="file" name='brand_image' class="form-control">
                                {{-- //here name field should be match with database column field --}}

                                @error('brand_image')
                                <span class='text-danger'>{{$message}}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-secondary">Add brand</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
