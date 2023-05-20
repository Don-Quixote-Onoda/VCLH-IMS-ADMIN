@extends('layout.inn-layout')
@section('content')
    <a href="/admin/inns-admin" class="btn btn-primary my-5 ms-5">Back</a>

    {{-- Inventory Management --}}
    <div class="row d-flex mb-4 justify-content-center">
        <div class="col-11 ">
            <div class="bg-secondary rounded h-100 p-4">
                <div class="modal-body">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <form action="{{ route('update_inventory_managements', ['id'=> $id]) }}" method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" name="id" value="{{ $inventory->id }}">
                                <div>
                                    <div class="mb-3">
                                        <select name="product_id" class="form-select mb-3"
                                            aria-label="Default select example" required>
                                            <option value="">Select Product</option>
                                            @if (!is_null($products))
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}" {{$product->id == $inventory->id ? "selected" : ""}}>{{ $product->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Image:</label>
                                        <input type="file" name="image" value="{{$inventory->image}}" class="form-control" id="exampleInputEmail1" 
                                            aria-describedby="emailHelp">
                                    </div>
                                    
                                    <input type="hidden" name="inn_id" value="{{ $id }}">
                                    <div class="mb-3">
                                        <label for="" class="mb-2">Quantity: </label>
                                        <input type="number" value="{{$inventory->quantity}}" required name="quantity"
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

@endsection
