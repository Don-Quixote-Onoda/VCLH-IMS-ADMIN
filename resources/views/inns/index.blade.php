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

    <!-- Main Stylesheet -->
    <link href="{{ asset('welcome_assets/css/style.css') }}" rel="stylesheet">

    <!-- cdn for bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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


    <!-- Navigation ENd -->

    <!-- <h2 class="text-center mt-2">Accomodation Search</h2>
    <input type="text" class="form-control mt-3 mx-auto" id="myinput" placeholder="Input Search" style="width: 30%;"> -->

    <!-- POrtfolio start -->
    <section class="portfolio ">
        <div class="container">
            <div class="row shuffle-wrapper portfolio-gallery mt-5">

                @if (count($inns) > 0)
                    @foreach ($inns as $inn)
                        <div class="col-lg-4 col-6 mb-4 shuffle-item"
                            data-groups="[&quot;design&quot;,&quot;illustration&quot;]">
                            <a href="/inns/{{ $inn->id }}">
                                <div class="position-relative inner-box">
                                    <div class="image position-relative inn-image">
                                        @if ($inn->inn_image == 'noimage.jpg')
                                        <img src="{{asset('/image/noimage.png')}}"
                                        alt="portfolio-image" class="img-fluid w-100 d-block">
                                        @else
                                        <img src="/storage/inns/inns_images/{{ $inn->inn_image }}"
                                        alt="portfolio-image" class="img-fluid w-100 d-block">
                                        @endif
                                        
                                        <div class="overlay-box">
                                            <div class="overlay-inner">
                                                <div class="overlay-content">
                                                    <h5 class="mb-0">{{ $inn->inn_name }}</h5>
                                                    <p>
                                                        @if (count(App\Models\Room::where('inn_id', $inn->id)->get()) > 0)
                                                            {{count(App\Models\Room::where('inn_id', $inn->id)->get())}}  {{(count(App\Models\Room::where('inn_id', $inn->id)->get()) > 1) ? 'rooms' : 'room' }} available
                                                        @else
                                                            no rooms available
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </section>
    <!-- Portfolio End -->

    <!-- Service start -->
    <section class="section service-home border-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mb-2 ">Core Services.</h2>
                    <p class="mb-5 text-justify[">VALENCIA CITY WEB-BASED ACCOMMODATION MANAGEMENT SYSTEM simplifies the accomodation search and booking process by providing a centralized platform where users can compare prices and access comprehensive information about various hotels. VCWAMS aims to help travelers find the best accomodation deals that suit their needs and preferences.</p>
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
    </section>
    <!-- service end --> $cman = BarangayOfficial::where('position', 'Barangay Chairman')
        ->orWhere('position', 'Barangay Captain')
        ->first();

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

</html>
