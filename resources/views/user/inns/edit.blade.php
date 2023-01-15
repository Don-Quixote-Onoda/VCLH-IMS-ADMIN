@extends('layout.app')
@section('content')
    <div class="contrainer">
        <div class="row mx-auto d-flex justify-content-center my-5">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-secondary rounded h-100 p-4">
                    <form action="/user/inns-manager/{{ $inn->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <input type="text" name="inn_name" value="{{ $inn->inn_name }}" class="form-control"
                                id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Number of Rooms</label>
                            <input type="number" name="number_of_rooms" value="{{ $inn->number_of_rooms }}"
                                class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <input type="hidden" name="long" id="long" value="{{ $inn->long }}">
                        <input type="hidden" name="lat" id="lat" value="{{ $inn->lat }}">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Choose Location</label>
                            <div id="map" style="height:200px; width: 100%;" class="my-3"></div>
                        </div>

                        <script>
                            // Note: This example requires that you consent to location sharing when
                            // prompted by your browser. If you see the error "The Geolocation service
                            // failed.", it means you probably did not give permission for the browser to
                            // locate you.
                            let map, infoWindow;

                            function initMap() {
                                const recentPos = {
                                    lat: {{ $inn->lat }},
                                    lng: {{ $inn->long }}
                                };
                                map = new google.maps.Map(document.getElementById("map"), {
                                    center: recentPos,
                                    zoom: 15,
                                });
                                infoWindow = new google.maps.InfoWindow();

                                const marker = new google.maps.Marker({
                                    position: recentPos,
                                    map: map,
                                });

                                infoWindow.setPosition(recentPos);
                                infoWindow.setContent("{{ $inn->inn_name }}");
                                infoWindow.open(map, marker);
                                map.setCenter(recentPos);
                                map.setZoom(15);

                                const locationButton = document.createElement("button");

                                locationButton.textContent = "Proceed to Current Location";
                                locationButton.classList.add("custom-map-control-button");
                                locationButton.setAttribute('type', 'button');
                                map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
                                locationButton.addEventListener("click", () => {
                                    // Try HTML5 geolocation.
                                    if (navigator.geolocation) {
                                        navigator.geolocation.getCurrentPosition(
                                            (position) => {
                                                const pos = {
                                                    lat: position.coords.latitude,
                                                    lng: position.coords.longitude,
                                                };

                                                document.getElementById('long').value = pos['lng'];
                                                document.getElementById('lat').value = pos['lat'];

                                                const marker = new google.maps.Marker({
                                                    position: pos,
                                                    map: map,
                                                });

                                                infoWindow.setPosition(pos);
                                                infoWindow.setContent("{{ $inn->inn_name }}");
                                                infoWindow.open(map, marker);
                                                map.setCenter(pos);
                                                map.setZoom(15);
                                            },
                                            () => {
                                                handleLocationError(true, infoWindow, map.getCenter());
                                            }
                                        );
                                    } else {
                                        // Browser doesn't support Geolocation
                                        handleLocationError(false, infoWindow, map.getCenter());
                                    }
                                });
                            }

                            function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                                infoWindow.setPosition(pos);
                                infoWindow.setContent(
                                    browserHasGeolocation ?
                                    "Error: The Geolocation service failed." :
                                    "Error: Your browser doesn't support geolocation."
                                );
                                infoWindow.open(map);
                            }

                            window.initMap = initMap;
                        </script>

                        <script async defer
                            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBAI7Grnpn1EBZ9cyeeKhjcQcYe0LwGuZk&callback=initMap"></script>


                        <div class="mb-3">
                            <select class="form-control tags-select w-75 d-inline" name="freebies[]" multiple="multiple">
                                @if (count($freebies) > 0)
                                    @foreach ($freebies as $freebie)
                                        @if (count($inn_freebies) > 0)
                                            @foreach ($inn_freebies as $inn_freebie)
                                                @if ($inn_freebie == $freebie->name)
                                                    <option value="{{ $freebie->name }}" selected>{{ $freebie->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                            <option value="{{ $freebie->name }}">{{ $freebie->name }}
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                            <button type="button" class="btn btn-primary fw-bold float-end" data-bs-toggle="modal"
                                data-bs-target="#addFreebies">
                                +
                            </button>
                        </div>


                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Image</label>
                            <input type="file" name="inn_image" value="{{ $inn->inn_image }}" class="form-control"
                                id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="/admin/inns-admin" class="btn btn-outline-primary">Back</a>
                    </form>
                </div>
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
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1"
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
