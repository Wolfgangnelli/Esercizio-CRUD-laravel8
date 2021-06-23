<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Category
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between"
                        role="alert">
                        <strong>{{session('success')}}</strong>
                        <button class="btn-close" data-dismiss="alert" aria-label="Close" type="button"></button>
                    </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            All Category
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">category Name</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($categories)
                                @php($i = 1)
                                @foreach ($categories as $category)
                                <tr>
                                    <th scope="row">{{$categories->firstItem()+$loop->index}}</th>
                                    <td>{{$category->category_name}}</td>
                                    <td>{{$category->user->name}}</td>
                                    @if ($category->created_at == NULL)
                                    <span class="text-danger">No Date set</span>
                                    @else
                                    <td>{{$category->created_at->diffForHumans()}}</td>
                                    @endif
                                    <td>
                                        <div class="d-flex flex-md-row flex-column align-items-center">
                                            <a href="{{ url('category/edit/'.$category->id) }}"
                                                class="btn btn-info m-1">Edit</a>
                                            <a href="{{ url('category/softdelete/'.$category->id) }}"
                                                class="btn btn-danger m-1">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="p-2">
                            {{$categories->links()}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Add Category</div>
                        <div class="card-body">
                            <form class="p-1" action="{{route('store.category')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="category_name" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" id="category_name" name="category_name">
                                    @error('category_name')
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Add category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Table trashed category -->

        <div class="container mt-6">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    @if (session('success1'))
                    <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between"
                        role="alert">
                        <strong>{{session('success1')}}</strong>
                        <button class="btn-close" data-dismiss="alert" aria-label="Close" type="button"></button>
                    </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            Trash List
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">category Name</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Deleted At</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($trashCat)
                                @php($i = 1)
                                @foreach ($trashCat as $category)
                                <tr>
                                    <th scope="row">{{$categories->firstItem()+$loop->index}}</th>
                                    <td>{{$category->category_name}}</td>
                                    <td>{{$category->user->name}}</td>
                                    @if ($category->deleted_at == NULL)
                                    <span class="text-danger">No Date set</span>
                                    @else
                                    <td>{{$category->deleted_at->diffForHumans()}}</td>
                                    @endif
                                    <td>
                                        <div class="d-flex flex-md-row flex-column align-items-center">
                                            <a href="{{ url('category/restore/'.$category->id) }}"
                                                class="btn btn-info m-1">Restore</a>
                                            <a href="{{ url('category/forcedelete/'.$category->id) }}"
                                                class="btn btn-danger m-1">Delete!</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="p-2">
                            {{$trashCat->links()}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">

                </div>
            </div>
        </div>


    </div>
    </div>
</x-app-layout>
