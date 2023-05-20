@extends('layout.inn-layout')
@section('content')
    <a href="/admin/inns-admin" class="btn btn-primary my-5 ms-5">Back</a>
    <div class="row d-flex mb-4 justify-content-center">
        <div class="col-11 ">
            <div class="bg-secondary rounded h-100 p-4">
                <div class="row">
                    <div class="col-sm-3">
                        <img src="/storage/inns/inns_images/{{ $inn->inn_image }}" alt="" class="img-fluid">
                    </div>
                    <div class="col-sm-9">
                        <h1>{{ $inn->inn_name }}</h1>
                        <h2>Number of Rooms: {{ $inn->number_of_rooms }}</h2>
                        <div class="mb-3 ">
                            <label for="exampleInputEmail1" class="form-label">Inn Location</label>
                            <div id="map" style="height:200px; width: 100%;" class="my-3"></div>
                        </div>
                    </div>
                </div>
                <script>
                    // Note: This example requires that you consent to location sharing when
                    // prompted by your browser. If you see the error "The Geolocation service
                    // failed.", it means you probably did not give permission for the browser to
                    // locate you.
                    let map, infoWindow;

                    function initMap() {
                        pos = {
                            lat: {{ $inn->lat }},
                            lng: {{ $inn->long }}
                        }
                        map = new google.maps.Map(document.getElementById("map"), {
                            center: pos,
                            zoom: 8,
                        });
                        infoWindow = new google.maps.InfoWindow();

                        const locationButton = document.createElement("button");


                        const marker = new google.maps.Marker({
                            position: pos,
                            map: map,
                        });
                        infoWindow.setPosition({
                            lat: 7.903554,
                            lng: 125.092391
                        });
                        infoWindow.setContent("{{ $inn->inn_name }}");
                        infoWindow.open(map, marker);
                        map.setCenter(pos);
                        map.setZoom(15);

                        window.initMap = initMap;
                    }
                </script>

                <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBAI7Grnpn1EBZ9cyeeKhjcQcYe0LwGuZk&callback=initMap"></script>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addFreebies" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-secondary">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add New Freebie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <form action="{{ route('freebies-admin.store') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Name</label>
                                    <input type="text" name="freebie" class="form-control" id="exampleInputEmail1"
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
