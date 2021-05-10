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
            All Category
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
                        <div class='card-header'>All Cards</div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Sl No.</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">user</th>
                                    <th scope="col">Created At</th>
                                    <th scope='col'>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                {{-- @php ($i = 1) --}}
                                @foreach ($category as $cat)
                                <tr>
                                    <td>{{$category->firstItem()+$loop->index}}</td>
                                    <td>{{$cat->user_category}}</td>
                                    <td>{{$cat->getUser->name}}</td>
                                    {{-- 👆 show another table data with one to one relation for Eloquent ORM --}}
                                    {{-- <td>{{$cat->name}}</td> --}}
                                    {{-- 👆 for query builder ORM we have to follow this way to show db field from another table --}}
                                    <td>
                                        @if ($cat->created_at == null)
                                        <span class='text-danger'>No Date set</span>
                                        @else
                                        {{-- 👇 --it's not work with query builder --}}
                                        {{$cat->created_at->diffForHumans()}}
                                        {{-- 👇 this is usefule when we read data from query builder
                                            <td>{{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td>--}}
                                    @endif
                                    </td>
                                    <td>
                                        <a href="{{url('category/edit/'.$cat->id)}}" class='btn btn-info'>Edit</a>
                                        <a href="{{url('category/delete/'.$cat->id)}}" class='btn btn-danger'>Delete</a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{$category->links()}}
                    </div>

                    {{-- Trash List --}}
                    <div class='card mt-2'>
                        <div class='card-header'>Trash List</div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Sl No.</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">user</th>
                                    <th scope="col">Created At</th>
                                    <th scope='col'>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($trashCategory as $cat)
                                <tr>
                                    <td>{{$category->firstItem()+$loop->index}}</td>
                                    <td>{{$cat->user_category}}</td>
                                    <td>{{$cat->getUser->name}}</td>
                                    {{-- 👆 show another table data with one to one relation for Eloquent ORM --}}
                                    {{-- <td>{{$cat->name}}</td> --}}
                                    {{-- 👆 for query builder ORM we have to follow this way to show db field from another table --}}
                                    <td>
                                        @if ($cat->created_at == null)
                                        <span class='text-danger'>No Date set</span>
                                        @else
                                        {{-- 👇 --it's not work with query builder --}}
                                        {{$cat->created_at->diffForHumans()}}
                                        {{-- 👇 this is usefule when we read data from query builder
                                            <td>{{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}
                                    </td>--}}
                                    @endif
                                    </td>
                                    <td>
                                        <a href="{{url('category/restore/'.$cat->id)}}" class='btn btn-info'>Restore</a>
                                        <a href="{{url('category/pdelete/'.$cat->id)}}" class='btn btn-danger'>
                                            Delete Permanently
                                        </a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{$trashCategory->links()}}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class='card'>
                        <div class='card-header'>
                            Add Category
                        </div>
                        <form class='p-10' action='{{route('add.category')}}' method="POST">
                            @csrf
                            {{-- //!without this @csrf we can't post any data --}}
                            <div class="mb-3">
                                <label for="categoryid" class="form-label">Category Name</label>
                                <input type="text" name='user_category' class="form-control" id="categoryid">
                                {{-- //here name field should be match with database column field --}}
                                @error('user_category')
                                <span class='text-danger'>{{$message}}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-secondary">Add Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
