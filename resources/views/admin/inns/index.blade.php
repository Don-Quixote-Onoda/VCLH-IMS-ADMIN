@extends('layout.app')
@section('content')

    <div class="container-fluid mt-3">
        {{-- <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addNewInn">Add New Inn</button> --}}
        <a href="/admin/inns-admin/create" class="btn btn-outline-primary">Add New Inn</a>
        <div class="row mt-3">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Inns Table</h6>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Number of Rooms</th>
                                    <th scope="col">Freebie</th>
                                    <th scope="col" colspan="3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($inns) > 0)
                                    @foreach ($inns as $inn)
                                        <tr>
                                            <td>{{ $inn->inn_name }}</td>
                                            <td>{{ $inn->number_of_rooms }}</td>
                                            <td>{{ $inn->freebies }}</td>
                                            <td>
                                                <a href="/admin/inns-admin/{{ $inn->id }}"
                                                    class="btn btn-success">Show</a>

                                            </td>
                                            <td>
                                                <a href="/admin/inns-admin/{{ $inn->id }}/edit"
                                                    class="btn btn-success">Edit</a>

                                            </td>
                                            <td>
                                                <form action="/admin/inns-admin/{{ $inn->id }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger d-inline">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addNewInn" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-secondary">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add New Inn</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <form action="{{ route('inns-admin.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Name</label>
                                    <input type="text" name="inn_name" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Number of Rooms</label>
                                    <input type="number" name="number_of_rooms" class="form-control"
                                        id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Choose Location</label>
                                    <div id="map" style="height:200px; width: 100%;" class="my-3"></div>
                                </div>
                                {{-- <script>
                    let map;
                    function initMap() {
                        map = new google.maps.Map(document.getElementById("map"), {
                            center: { lat: 7.905180, lng: 125.090919 },
                            zoom: 8,
                            scrollwheel: true,
                        });
                        
                        const uluru = { lat: -34.397, lng: 150.644 };
                        let marker = new google.maps.Marker({
                            position: uluru,
                            map: map,
                            draggable: true
                        });
                        google.maps.event.addListener(marker,'position_changed',
                            function (){
                                let lat = marker.position.lat()
                                let lng = marker.position.lng()
                                $('#lat').val(lat)
                                $('#lng').val(lng)
                            })
                        google.maps.event.addListener(map,'click',
                        function (event){
                            pos = event.latLng
                            marker.setPosition(pos)
                        })
                    }
                </script>
                <script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap"
                        type="text/javascript"></script> --}}

                                <div class="mb-3">
                                    <select class="form-control tags-select" multiple="multiple">
                                        <option selected="selected">orange</option>
                                        <option>white</option>
                                        <option selected="selected">purple</option>
                                    </select>
                                    <button type="button" class="btn btn-primary fw-bold float-end" data-bs-toggle="modal"
                                        data-bs-target="#addFreebies">
                                        +
                                    </button>
                                </div>


                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Image</label>
                                    <input type="file" name="inn_image" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
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
