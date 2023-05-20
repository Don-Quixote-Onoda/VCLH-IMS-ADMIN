@extends('layout.inn-layout')
@section('content')
    <a href="/admin/inns-admin" class="btn btn-primary my-5 ms-5">Back</a>


    {{-- Category --}}
    <div class="row d-flex mb-4 justify-content-center">
        <div class="col-11 ">
            <div class="bg-secondary rounded h-100 p-4">
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#addNewReservation">Add New Product Category</button>
                <div class="row mt-3">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Product Categories Table</h6>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Description</th>
                                            <th scope="col" colspan="3">actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($categories) > 0)
                                            @foreach ($categories as $category)
                                                <tr>
                                                    <td>{{ $category->name }}</td>
                                                    <td>{{ $category->description }}</td>
                                                    <td>
                                                        <a href="/admin/inn/product_categories/edit/{{$id}}{{ $category->id }}"
                                                            class="btn btn-success">Edit</a>

                                                    </td>
                                                    <td>
                                                        <form action="/admin/inn/product_categories/destroy/{{$id}}{{ $category->id }}"
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
                                <h5 class="modal-title" id="staticBackdropLabel">Add New Product Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-sm-12 col-xl-12">
                                    <div class="bg-secondary rounded h-100 p-4">
                                        <form action="{{ route('store_product_categories', ['id' => $id]) }}" method="post">
                                            @csrf
                                            <input type="hidden" name="inn_id" value="{{ $id }}">
                                            <div>
                                                
                                                <div class="mb-3">
                                                    <label for="" class="mb-2">Name: </label>
                                                    <input type="text" name="name" class="form-control mb-3" />
                                                </div>
                                                <input type="hidden" name="inn_id" value="{{ $id }}">
                                                <div class="mb-3">
                                                    <label for="" class="mb-2">Description: </label>
                                                    <textarea class="form-control mb-3" name="description" id="" cols="30" rows="10"></textarea>
                                                    
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
