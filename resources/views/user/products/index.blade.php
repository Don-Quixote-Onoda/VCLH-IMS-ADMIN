@extends('layout.app')
@section('content')
    <a href="/admin/inns-admin" class="btn btn-primary my-5 ms-5">Back</a>

    {{-- Products --}}

    <div class="row d-flex mb-4 justify-content-center">
        <div class="col-11 ">
            <div class="bg-secondary rounded h-100 p-4">
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#addNewReservation">Add New Products</button>
                    <p class="text-danger">{{$error}}</p>

                <div class="row mt-3 overflow-scroll ">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Products Table</h6>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Image</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Category</th>
                                            <th scope="col" colspan="3">actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($products) > 0)
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td><img src="/storage/inns/products/{{ $product->image }}" alt="" class="img-fluid"></td>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $product->quantity }}</td>
                                                    <td>₱{{ number_format($product->price, 2, '.', ',') }}</td>
                                                    <td>{{ $product->category_id }}</td>
                                                    <td>
                                                        <a href="/user/products/{{$product->id}}/edit"
                                                            class="btn btn-success">Edit</a>

                                                    </td>
                                                    <td>
                                                        <form action="/user/products/{{$product->id}}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit"
                                                                class="btn btn-danger d-inline">Delete</button>
                                                        </form>
                                                    </td>
                                                    <td>

                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="addNewReservation" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-secondary">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Add New Reservation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-sm-12 col-xl-12">
                                    <div class="bg-secondary rounded h-100 p-4">
                                        <form action="{{ route('products.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="inn_id" value="{{ $id }}">
                                            <div>
                                                <div class="mb-3">
                                                    <label for="" class="mb-2">Product Name: </label>
                                                    <input type="text" name="product_name" required
                                                        class="form-control mb-3" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Image:</label>
                                                    <input type="file" name="image" class="form-control" id="exampleInputEmail1" required
                                                        aria-describedby="emailHelp">
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="" class="mb-2">Description: </label>
                                                    <textarea class="form-control mb-3" name="description" required id="" cols="30" rows="10"></textarea>
                                                </div>
                                                <input type="hidden" name="inn_id" value="{{ $id }}">
                                                <div class="mb-3">
                                                    <label for="" class="mb-2">Quantity: </label>
                                                    <input type="number" required name="quantity"
                                                        class="form-control mb-3" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="mb-2">Price: </label>
                                                    <input type="number" required name="price"
                                                        class="form-control mb-3" />
                                                </div>
                                                <div class="mb-3">
                                                    <select name="category_id" class="form-select mb-3"
                                                        aria-label="Default select example" required>
                                                        <option value="">Select Category</option>
                                                        @if (!is_null($categories))
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}
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
            </div>
        </div>
    </div>
@endsection
