<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Brand
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
                    <div class="card">
                        <div class="card-header">
                            All Brand
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Brand Image</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($brands)
                                @foreach ($brands as $brand)
                                <tr>
                                    <th scope="row">{{$brands->firstItem()+$loop->index}}</th>
                                    <td>{{$brand->brand_name}}</td>
                                    <td><img src="{{asset('storage/'.$brand->brand_image)}}"
                                            style="height:50px; width:50px; border-radius:50%; object-fit: cover;"
                                            alt="{{$brand->brand_name}}"></td>
                                    @if ($brand->created_at == NULL)
                                    <span class="text-danger">No Date set</span>
                                    @else
                                    <td>{{$brand->created_at->diffForHumans()}}</td>
                                    @endif
                                    <td>
                                        <div class="d-flex flex-md-row flex-column align-items-center">
                                            <a href="{{url('brand/edit/'.$brand->id)}}"
                                                class="btn btn-info m-1">Edit</a>
                                            <a href="{{url('brand/delete/'.$brand->id)}}" class="btn btn-danger m-1"
                                                onclick="return confirm('Are you sure to delete?')">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="p-2">
                            {{$brands->links()}}
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mt-3 mt-md-0">
                    <div class="card">
                        <div class="card-header">Add Brand</div>
                        <div class="card-body">
                            <form class="p-1" action="{{route('store.brand')}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="brand_name" class="form-label">Brand Name</label>
                                    <input type="text" class="form-control" id="brand_name" name="brand_name">
                                    @error('brand_name')
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="brand_image" class="form-label">Brand Image</label>
                                    <input type="file" class="form-control" id="brand_image" name="brand_image">
                                    @error('brand_image')
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Add Brand</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>
    </div>
</x-app-layout>
