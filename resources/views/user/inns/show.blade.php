@extends('layout.app')
@section('content')
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-11 ">
            <div class="bg-secondary rounded h-100 p-4">
                <div class="row">
                    <div class="col-sm-3">
                        <img src="/storage/inns/inns_images/{{ $inn->inn_image }}" alt="" class="img-fluid">
                    </div>
                    <div class="col-sm-9">
                        <h1>{{ $inn->inn_name }}</h1>
                        <h2>Number of Rooms: {{ $inn->number_of_rooms }}</h2>
                        <a href="/user/inns-manager/{{ $inn->id }}/edit" class="btn btn-outline-primary">Edit</a>
                    </div>
                </div>
                <div class="mb-3 ">
                    <div id="map" style="height:400px; width: 100%;" class="my-3"></div>
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
@endsection
