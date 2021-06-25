<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Multiple Picture
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    @if (session('message'))
                    <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between"
                        role="alert">
                        <strong>{{session('message')}}</strong>
                        <button class="btn-close" data-dismiss="alert" aria-label="Close" type="button"></button>
                    </div>
                    @endif
                    <div class="card-group">
                        @foreach ($images as $image)
                        <div class="col-md-4 p-1">
                            <div class="card">
                                <img src="{{asset('storage/'.$image->image)}}" alt="{{$image->id}}"
                                    style="object-fit:cover;" class="rounded">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-4 mt-3 mt-md-0">
                    <div class="card">
                        <div class="card-header">Multi image</div>
                        <div class="card-body">
                            <form class="p-1" action="{{route('store.image')}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="image" class="form-label">Multi Image</label>
                                    <input type="file" class="form-control" id="image" name="image[]" multiple>
                                    <span><small>(For multi img selection, hold down <code>ctrl</code> an click on
                                            imgs)</small></span>
                                    @error('image')
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Add Image</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>
    </div>
</x-app-layout>
