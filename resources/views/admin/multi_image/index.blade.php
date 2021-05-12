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
            Multiple Images
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
                    <div class="card-group" style="overflow-y: scroll; height:350px; width: auto;">
                        @foreach ($images as $multi)
                        <div class="col-md-4 mt-5">
                            <div class="card ml-5">
                                <img src="{{asset($multi->image)}}" alt="image" />
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-4">
                    <div class='card'>
                        <div class='card-header'>
                            Upload Multiple Image
                        </div>
                        <form class='p-10' action="{{route('store.image')}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            {{--👆 without this @csrf we can't post any data --}}

                            <div class="mb-3">
                                <label class="form-label">Images</label>
                                <input type="file" name='image[]' class="form-control" multiple="true">
                                {{-- //here name field should be match with database column field --}}

                                @error('image')
                                <span class='text-danger'>{{$message}}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-secondary">Upload Images</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
