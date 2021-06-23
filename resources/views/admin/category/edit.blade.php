<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Category
    </x-slot>

    <div class="py-12">
        <div class="container ">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-header">Edit Category</div>
                        <div class="card-body">
                            <form class="p-1" action="{{url('category/update/'.$category->id)}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="category_name" class="form-label">Update Category Name</label>
                                    <input type="text" class="form-control" id="category_name" name="category_name"
                                        value="{{$category->category_name}}">
                                    @error('category_name')
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Edit category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
</x-app-layout>
