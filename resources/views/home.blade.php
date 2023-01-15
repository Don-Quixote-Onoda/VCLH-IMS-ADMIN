<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ Auth::user()->name }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('admin_assets/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('admin_assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}"
        rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('admin_assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('select2/css/select2.min.css') }}" rel="stylesheet" />


    <!-- Template Stylesheet -->
    <link href="{{ asset('admin_assets/css/style.css') }}" rel="stylesheet">
</head>

<body class="bg-dark">
    <div class="contrainer">
        <div class="row mx-auto d-flex justify-content-center my-5">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-secondary rounded h-100 p-4">
                    <form action="{{ route('inns-manager.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <input type="text" name="inn_name" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Number of Rooms</label>
                            <input type="number" name="number_of_rooms" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                        </div>
                        <input type="hidden" name="long" id="long">
                        <input type="hidden" name="lat" id="lat">
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
                                map = new google.maps.Map(document.getElementById("map"), {
                                    center: {
                                        lat: 7.903554,
                                        lng: 125.092391
                                    },
                                    zoom: 8,
                                });
                                infoWindow = new google.maps.InfoWindow();

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
                                                infoWindow.setContent("Location found.");
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
                            <select class="form-control tags-select w-75 d-inline" name="freebies[]"
                                multiple="multiple">
                                @if (count($freebies) > 0)
                                    @foreach ($freebies as $freebie)
                                        <option value="{{ $freebie->name }}">{{ $freebie->name }}</option>
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
                            <input type="file" name="inn_image" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
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
                                    <input type="text" name="name" class="form-control"
                                        id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('admin_assets/lib/chart/chart.min.js') }}"></script>
<script src="{{ asset('admin_assets/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('admin_assets/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('admin_assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('admin_assets/lib/tempusdominus/js/moment.min.js') }}"></script>
<script src="{{ asset('admin_assets/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
<script src="{{ asset('admin_assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<!-- Template Javascript -->
<script src="{{ asset('admin_assets/js/main.js') }}"></script>

<script src="{{ asset('select2/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $(".tags-select").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        })
    });
</script>

</html>
