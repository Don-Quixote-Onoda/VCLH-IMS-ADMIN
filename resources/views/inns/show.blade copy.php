<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <title>VCWAMS</title>

    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- ** Plugins Needed for the Project ** -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('welcome_assets/plugins/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('welcome_assets/plugins/themify/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('welcome_assets/plugins/counto/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('welcome_assets/plugins/aos/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('welcome_assets/plugins/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('welcome_assets/plugins/owl-carousel/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('welcome_assets/plugins/magnific-popup/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('welcome_assets/plugins/animated-text/animated-text.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <!-- Main Stylesheet -->
    <link href="{{ asset('welcome_assets/css/style.css') }}" rel="stylesheet">

</head>

<body>

    <!-- Navigation Start -->
    <!-- Header Start -->

    <nav class="navbar navbar-expand-lg  main-nav " id="navbar">
        <div class="container">
            <a class="navbar-brand" href="/">
            <img src="{{asset('welcome_assets/images/logo final.png')}}" alt="" class="img-fluid">
            </a>

            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="ti-align-justify"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample09">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header Close -->
    <section class="section service-home border-top" style="padding: 60px 0px">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mb-2 ">{{ $inn->inn_name }}</h2>
                    <!-- <p class="mb-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus, totam
                        ipsa quia hic odit a sit laboriosam voluptatem in, blanditiis.</p> -->
                </div>
                <div class="col-lg-6">
                    @if ($inn->inn_image == 'noimage.jpg')
                                        <img src="{{asset('/image/noimage.png')}}"
                                        alt="portfolio-image" class="img-fluid w-100 d-block">
                                        @else
                                        <img src="/storage/inns/inns_images/{{ $inn->inn_image }}"
                                        alt="portfolio-image" class="img-fluid w-100 d-block">
                                        @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Navigation ENd -->

    <!-- POrtfolio start -->

    <section class="portfolio">
    <div class="container">
        <div class="row shuffle-wrapper portfolio-gallery mt-2">

            @if (count($rooms) > 0)
                @foreach ($rooms as $room)
                    <div class="col-lg-4 col-6 mb-4 shuffle-item"
                        data-groups="[&quot;design&quot;,&quot;illustration&quot;]">
                        <div class="position-relative inner-box">
                            <div class="image position-relative inn-image">
                                <img src="{{ asset('welcome_assets/images/rooms.png') }}" alt="portfolio-image"
                                    class="img-fluid w-100 d-block">
                                <div class="overlay-box">
                                    <div class="overlay-inner">
                                        <div class="overlay-content">
                                            <h1 style="color: #b3b3b3;">Room. {{ $room->room_number }} </h1>
                                            <p>{{ $room->number_of_beds }}
                                                {{ $room->number_of_beds > 1 ? ' beds' : ' bed' }} • Freebie:
                                                @foreach (explode(',', $room->freebies) as $freebie)
                                                    {{ $freebie }}
                                                @endforeach
                                            </p>
                                            <p>
                                                @if (($room->room_rates))
                                                    @foreach ($room->room_rates as $room_rate)
                                                        <span style="display: block">{{ $room_rate->number_of_hours }}
                                                            hours • ₱ {{ $room_rate->rate }}</span>
                                                    @endforeach
                                                @endif
                                            </p>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="bg-white p-2 w-100 d-block border-0 make-reservation-btn"
                                                data-bs-toggle="modal" data-bs-target="#addNewReservation_{{ $room->id }}"
                                                data-room-id="{{ $room->id }}">Make Reservation</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="addNewReservation_{{ $room->id }}" tabindex="-1" aria-labelledby="staticBackdropLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content bg-secondary">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Add New Reservation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-sm-12 col-xl-12">
                                        <div class="bg-secondary rounded h-100 p-4">
                                            <form action="{{ route('reservations.store') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="inn_id" value="{{ $inn->id }}">
                                                <input type="hidden" name="room_id" id="room_id_{{ $room->id }}" value="{{ $room->id }}">
                                                <div>
                                                    <div class="mb-3">
                                                        <label for="" class="mb-2">Enter reservation date: </label>
                                                        <input type="date" name="reservationDate" class="form-control mb-3" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="" class="mb-2">Enter reservee name: </label>
                                                        <input type="text" name="name" class="form-control mb-3" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="" class="mb-2">Enter contact number: </label>
                                                        <input type="number" name="contactNumber" class="form-control mb-3" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="room_rate" class="form-label">Select Room Rate:</label>
                                                        <select class="form-select" name="room_rate_id"
                                                            id="room_rate_id_{{ $room->id }}">
                                                            @foreach ($room->room_rates as $roomRate)
                                                                <option value="{{ $roomRate->id }}">
                                                                    {{ $roomRate->number_of_hours }} hours • ₱ {{ $roomRate->rate }}
                                                                </option>
                                                            @endforeach
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
                @endforeach
            @else
                <h3>No rooms available.</h3>
            @endif

        </div>
    </div>
</section>


    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="mb-5 ">
                    <h3 for="exampleInputEmail1" class="form-h3">Location</h3>
                    <div id="map" style="height:500px; width: 100%;" class="my-3"></div>
                </div>
            </div>

        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            // Note: This example requires that you consent to location sharing when
            // prompted by your browser. If you see the error "The Geolocation service
            // failed.", it means you probably did not give permission for the browser to
            // locate you.
              

            let map, infoWindow;
            
                    $(document).ready(function () {
                $('.make-reservation-btn').on('click', function () {
                    var roomId = $(this).data('room-id');
                    $('#addNewReservation_' + roomId).modal('show');
                });
            });

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
    <!-- Portfolio End -->

    <!-- Service start -->
    {{-- <section class="section service-home border-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mb-2 ">Core Services.</h2>
                    <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus, totam
                        ipsa quia hic odit a sit laboriosam voluptatem in, blanditiis.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="service-item mb-5" data-aos="fade-left">
                        <i class="ti-layout"></i>
                        <h4 class="my-3">Web Development</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, earum.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="service-item mb-5" data-aos="fade-left" data-aos-delay="450">
                        <i class="ti-announcement"></i>
                        <h4 class="my-3">Digital Marketing</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, earum.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="service-item mb-5 mb-lg-0" data-aos="fade-left" data-aos-delay="750">
                        <i class="ti-layers"></i>
                        <h4 class="my-3">Graphics Design</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, earum.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="service-item" data-aos="fade-left" data-aos-delay="750">
                        <i class="ti-anchor"></i>
                        <h4 class="my-3">Branding Design</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, earum.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="service-item mb-5" data-aos="fade-left" data-aos-delay="950">
                        <i class="ti-video-camera"></i>
                        <h4 class="my-3">Video Marketing</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, earum.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="service-item mb-5 mb-lg-0" data-aos="fade-left" data-aos-delay="1050">
                        <i class="ti-android"></i>
                        <h4 class="my-3">App Design</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, earum.</p>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- service end -->

    <!-- Footer start -->
    <section class="footer">
        <div class="container">
            <div class="row ">
                <div class="col-lg-6">
                <p class="mb-0">Copyrights © 2023. Central Mindanao University <a href="/"
                            class="text-white">VCWAMS</a></p>
                </div>
                <div class="col-lg-6">
                    <div class="widget footer-widget text-lg-right mt-5 mt-lg-0">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item"><a href="https://www.facebook.com/themefisher"
                                    target="_blank"><i class="ti-facebook mr-3"></i></a>
                            </li>
                            <li class="list-inline-item"><a href="https://twitter.com/themefisher" target="_blank"><i
                                        class="ti-twitter mr-3"></i></a>
                            </li>
                            <li class="list-inline-item"><a href="https://github.com/themefisher/" target="_blank"><i
                                        class="ti-github mr-3"></i></a></li>
                            <li class="list-inline-item"><a href="https://www.pinterest.com/themefisher/"
                                    target="_blank"><i class="ti-pinterest mr-3"></i></a></li>
                            <li class="list-inline-item"><a href="https://dribbble.com/themefisher/"
                                    target="_blank"><i class="ti-dribbble mr-3"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer End -->

    <!-- jQuery -->
    <script src="{{ asset('welcome_assets/plugins/jQuery/jquery.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('welcome_assets/plugins/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('welcome_assets/plugins/aos/aos.js') }}"></script>
    <script src="{{ asset('welcome_assets/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('welcome_assets/plugins/shuffle/shuffle.min.js') }}"></script>
    <script src="{{ asset('welcome_assets/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('welcome_assets/plugins/animated-text/animated-text.js') }}"></script>
    <script src="{{ asset('welcome_assets/plugins/counto/apear.js') }}"></script>
    <script src="{{ asset('welcome_assets/plugins/counto/counTo.js') }}"></script>

    <!-- Google Map -->
    <script src="plugins/google-map/map.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkeLMlsiwzp6b3Gnaxd86lvakimwGA6UA&callback=initMap">
    </script>
    <!-- Main Script -->
    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</html>
