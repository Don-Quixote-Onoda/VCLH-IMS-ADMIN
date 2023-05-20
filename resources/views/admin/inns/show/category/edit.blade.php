@extends('layout.inn-layout')
@section('content')
    <a href="/admin/inns-admin" class="btn btn-primary my-5 ms-5">Back</a>


    {{-- Category --}}
    <div class="row d-flex mb-4 justify-content-center">
        <div class="col-11 ">
            <div class="bg-secondary rounded h-100 p-4">
                
                <!-- Modal -->
                <div class="modal-body">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <form action="{{ route('update_product_categories', ['id' => $id]) }}" method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" name="id" value="{{ $category->id }}">
                                <div>
                                    
                                    <div class="mb-3">
                                        <label for="" class="mb-2">Name: </label>
                                        <input type="text" value="{{$category->name}}" name="name" class="form-control mb-3" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="mb-2">Description: </label>
                                        <textarea class="form-control mb-3" name="description" id="" cols="30" rows="10">
                                            {{$category->description}}
                                        </textarea>
                                        
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
