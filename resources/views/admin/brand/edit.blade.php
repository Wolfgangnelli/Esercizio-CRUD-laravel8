<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Brands
    </x-slot>

    <div class="py-12">
        <div class="container ">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    @if (session('message'))
                    <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between"
                        role="alert">
                        <strong>{{session('message')}}</strong>
                        <button class="btn-close" data-dismiss="alert" aria-label="Close" type="button"></button>
                    </div>
                    @endif
                    <div class="card">
                        <div class="card-header">Edit Brand</div>
                        <div class="card-body">
                            <form class="p-1" action="{{route('update.brand', $brand->id)}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="_method" value="PATCH">
                                <input type="hidden" name="old_image" value="{{$brand->brand_image}}">

                                <div class="mb-3">
                                    <label for="brand_name" class="form-label">Update Brand Name</label>
                                    <input type="text" class="form-control" id="brand_name" name="brand_name"
                                        value="{{$brand->brand_name}}">
                                    @error('brand_name')
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="brand_image" class="form-label">Update Brand Image</label>
                                    <input type="file" class="form-control" id="brand_image" name="brand_image"
                                        value="{{asset($brand->brand_image)}}">
                                    @error('brand_image')
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>
                                @if ($brand->brand_image)
                                <figure class="figure">
                                    <img src="{{asset('storage/'.$brand->brand_image)}}" alt="{{$brand->brand_name}}"
                                        class="figure-img img-fluid rounded" style="object-fit: cover;">
                                    <figcaption class="figure-caption text-xs-right">Fig. {{$brand->brand_name}}
                                    </figcaption>
                                </figure>
                                @endif
                                <button type="submit" class="btn btn-primary">Update Brand</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
</x-app-layout>
