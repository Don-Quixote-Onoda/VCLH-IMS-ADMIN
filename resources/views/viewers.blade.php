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
  <link rel="stylesheet" href="{{asset('welcome_assets/plugins/bootstrap/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('welcome_assets/plugins/themify/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('welcome_assets/plugins/counto/animate.css')}}">
  <link rel="stylesheet" href="{{asset('welcome_assets/plugins/aos/aos.css')}}">
  <link rel="stylesheet" href="{{asset('welcome_assets/plugins/owl-carousel/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{asset('welcome_assets/plugins/owl-carousel/owl.theme.default.min.css')}}">
  <link rel="stylesheet" href="{{asset('welcome_assets/plugins/magnific-popup/magnific-popup.css')}}">
  <link rel="stylesheet" href="{{asset('welcome_assets/plugins/animated-text/animated-text.css')}}">

  <!-- Main Stylesheet -->
  <link href="{{asset('welcome_assets/css/style.css')}}" rel="stylesheet">

</head>

<body>
  
<!-- Navigation Start -->
<!-- Header Start --> 

<nav class="navbar navbar-expand-lg  main-nav " id="navbar">
	<div class="container">
	  <a class="navbar-brand" href="/">
	  	<img src="{{asset('welcome_assets/images/logo final.png')}}" alt="" class="img-fluid">
		  
	  </a>
	  
	  <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
		<span class="ti-align-justify"></span>
	  </button>
  
		  <div class="collapse navbar-collapse" id="navbarsExample09">
			<ul class="navbar-nav ml-auto">
			   <li class="nav-item"><a class="nav-link" href="{{route('login')}}">Login</a></li>
			</ul>
		</div>
	</div>
</nav>

<!-- Header Close --> 


<!-- Navigation ENd -->

<!-- Banner Start -->
<section class="section banner">
	<div class="container">
		<div class="row">
			<div class="col-lg-10">
				 <h2 class="cd-headline clip is-full-width mb-4 ">
				 	We provide <br>
                    <span class="cd-words-wrapper text-color">
                        <b class="is-visible">Faster Transactions. </b>
                        <b>Convenience.</b>
                        <b>24/7 Update.</b>
                    </span>
                </h2>
                <p>Discover the Perfect Accomodation in Valencia City. <br>Book Your Dream Stay. Experience Unmatched Comfort and Luxury.</p>
                <a href="/inns" class="btn btn-secondary rounded">Start Now!</a>
			
            </div>
		</div>
	</div>
</section>

<!-- <section class="section banner">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				 <h2 class="cd-headline clip is-full-width mb-4 ">
				 	We provide <br>
                    <span class="cd-words-wrapper text-color">
                        <b class="is-visible">Faster Transactions. </b>
                        <b>Convenience.</b>
                        <b>24/7 Update.</b>
                    </span>
                </h2>
                <p>Discover the Perfect Lodge in Valencia City. <br>Book Your Dream Stay. Experience Unmatched Comfort and Luxury.</p>
                <a href="/inns" class="btn btn-secondary rounded">Start Now!</a>
			
            </div>
			<div class="col-lg-4">
				<h1>Kayat King</h1>
				<a class="navbar-brand" href="https://www.facebook.com/lazaro.camanero">
	  				<img src="{{asset('welcome_assets/images/doytik.png')}}" alt="" class="img-fluid">
		  			
	  			</a>
			</div>
		</div>
		
	</div>
</section> -->

<!-- Banner End -->


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
						<li class="list-inline-item"><a href="https://www.facebook.com/themefisher" target="_blank"><i class="ti-facebook mr-3"></i></a>
						</li>
						<li class="list-inline-item"><a href="https://twitter.com/themefisher" target="_blank"><i class="ti-twitter mr-3"></i></a>
						</li>
						<li class="list-inline-item"><a href="https://github.com/themefisher/" target="_blank"><i class="ti-github mr-3"></i></a></li>
						<li class="list-inline-item"><a href="https://www.pinterest.com/themefisher/" target="_blank"><i class="ti-pinterest mr-3"></i></a></li>
						<li class="list-inline-item"><a href="https://dribbble.com/themefisher/" target="_blank"><i class="ti-dribbble mr-3"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Footer End -->

<!-- jQuery -->
<script src="{{asset('welcome_assets/plugins/jQuery/jquery.min.js')}}"></script>
<!-- Bootstrap JS -->
<script src="{{asset('welcome_assets/plugins/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('welcome_assets/plugins/aos/aos.js')}}"></script>
<script src="{{asset('welcome_assets/plugins/owl-carousel/owl.carousel.min.js')}}"></script>
<script src="{{asset('welcome_assets/plugins/shuffle/shuffle.min.js')}}"></script>
<script src="{{asset('welcome_assets/plugins/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('welcome_assets/plugins/animated-text/animated-text.js')}}"></script>
<script src="{{asset('welcome_assets/plugins/counto/apear.js')}}"></script>
<script src="{{asset('welcome_assets/plugins/counto/counTo.js')}}"></script>

 <!-- Google Map -->
<script src="plugins/google-map/map.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkeLMlsiwzp6b3Gnaxd86lvakimwGA6UA&callback=initMap"></script> 
<!-- Main Script -->
<script src="js/script.js"></script>

</html>