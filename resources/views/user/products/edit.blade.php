@extends('layout.inn-layout')
@section('content')
    <a href="/admin/inns-admin" class="btn btn-primary my-5 ms-5">Back</a>

    {{-- Products --}}
    <div class="row d-flex mb-4 justify-content-center">
        <div class="col-11 ">
            <div class="bg-secondary rounded h-100 p-4">
                <div class="modal-body">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <form action="{{ route('products.update', ['product' => $product->id]) }}" method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" name="inn_id" value="{{ $id }}">
                                <div>
                                    <div class="mb-3">
                                        <label for="" class="mb-2">Price: </label>
                                        <input type="text" value="{{$product->name}}" required name="name"
                                            class="form-control mb-3" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="mb-2">Description: </label>
                                        <textarea class="form-control mb-3" name="description" required id="" cols="30" rows="10">
                                            {{$product->description}}
                                        </textarea>
                                    </div>
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                   
                                    <div class="mb-3">
                                        <label for="" class="mb-2">Price: </label>
                                        <input type="number" value="{{$product->price}}" required name="price"
                                            class="form-control mb-3" />
                                    </div>
                                    <div class="mb-3">
                                        <select name="category_id" class="form-select mb-3"
                                            aria-label="Default select example" required>
                                            <option value="">Select Category</option>
                                            @if (!is_null($categories))
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{$product->category_id == $category->id ? "selected" : ""}}>{{ $category->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
