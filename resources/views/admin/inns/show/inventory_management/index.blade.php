@extends('layout.inn-layout')
@section('content')
    <a href="/admin/inns-admin" class="btn btn-primary my-5 ms-5">Back</a>

    {{-- Inventory Management --}}
    <div class="row d-flex mb-4 justify-content-center">
        <div class="col-11 ">
            <div class="bg-secondary rounded h-100 p-4">
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#addNewReservation">Add New Inventory</button>
                <div class="row mt-3">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Inventory Table</h6>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Image</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col" colspan="3">actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($inventories) > 0)
                                            @foreach ($inventories as $inventory)
                                                <tr>
                                                    <td>{{ $inventory->image }}</td>
                                                    <td>{{ $inventory->name }}</td>
                                                    <td>{{ $inventory->quantity }}</td>
                                                    {{-- <td>
                                                        <a href="/admin/inn/inventory_managements/edit/{{$id}}{{$inventory->id}}"
                                                            class="btn btn-success">Edit</a>

                                                    </td> --}}
                                                    <td>
                                                        <form action="/admin/inn/inventory_managements/destroy/{{$id}}{{ $inventory->id }}"
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
                                <h5 class="modal-title" id="staticBackdropLabel">Add New Inventory</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-sm-12 col-xl-12">
                                    <div class="bg-secondary rounded h-100 p-4">
                                        <form action="{{ route('store_inventory_managements') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <div>
                                                <div class="mb-3">
                                                    <select name="product_id" class="form-select mb-3"
                                                        aria-label="Default select example" required>
                                                        <option value="">Select Product</option>
                                                        @if (!is_null($products))
                                                            @foreach ($products as $product)
                                                                <option value="{{ $product->id }}">{{ $product->name }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Image:</label>
                                                    <input type="file" name="image" class="form-control" id="exampleInputEmail1" 
                                                        aria-describedby="emailHelp">
                                                </div>
                                                
                                                <input type="hidden" name="inn_id" value="{{ $id }}">
                                                <div class="mb-3">
                                                    <label for="" class="mb-2">Quantity: </label>
                                                    <input type="number" required name="quantity"
                                                        class="form-control mb-3" />
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
