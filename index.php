<?php include 'includes/head.php' ?>

<!DOCTYPE html>

<html lang="en">

<head>

	<!-- Basic Page Needs
================================================== -->
	<meta charset="utf-8">
	<title>BDC Apps | Bible de Compétences</title>

	<!-- Mobile Specific Metas
================================================== -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Bootstrap App Landing Template">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
	<meta name="author" content="Themefisher">
	<meta name="generator" content="Themefisher Small Apps Template v1.0">

	<!-- theme meta -->
	<meta name="theme-name" content="small-apps" />

	<!-- PLUGINS CSS STYLE -->
	<link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="plugins/themify-icons/themify-icons.css">
	<link rel="stylesheet" href="plugins/slick/slick.css">
	<link rel="stylesheet" href="plugins/slick/slick-theme.css">
	<link rel="stylesheet" href="plugins/fancybox/jquery.fancybox.min.css">
	<link rel="stylesheet" href="plugins/aos/aos.css">

	<!-- CUSTOM CSS -->
	<link href="css/style.css" rel="stylesheet">

</head>

<body class="body-wrapper" data-spy="scroll" data-target=".privacy-nav">

	<!--====================================
=            Hero Section            =
=====================================-->
	<section class="section gradient-banner">
		<div class="shapes-container">
			<!-- forme arriere plan -->
			<div class="shape" data-aos="fade-down-left" data-aos-duration="1500" data-aos-delay="100"></div>
			<div class="shape" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="100"></div>
			<div class="shape" data-aos="fade-up-right" data-aos-duration="1000" data-aos-delay="200"></div>
			<div class="shape" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200"></div>
			<div class="shape" data-aos="fade-down-left" data-aos-duration="1000" data-aos-delay="100"></div>
			<div class="shape" data-aos="fade-down-left" data-aos-duration="1000" data-aos-delay="100"></div>
			<div class="shape" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="300"></div>
			<div class="shape" data-aos="fade-down-right" data-aos-duration="500" data-aos-delay="200"></div>
			<div class="shape" data-aos="fade-down-right" data-aos-duration="500" data-aos-delay="100"></div>
			<div class="shape" data-aos="zoom-out" data-aos-duration="2000" data-aos-delay="500"></div>
			<div class="shape" data-aos="fade-up-right" data-aos-duration="500" data-aos-delay="200"></div>
			<div class="shape" data-aos="fade-down-left" data-aos-duration="500" data-aos-delay="100"></div>
			<div class="shape" data-aos="fade-up" data-aos-duration="500" data-aos-delay="0"></div>
			<div class="shape" data-aos="fade-down" data-aos-duration="500" data-aos-delay="0"></div>
			<div class="shape" data-aos="fade-up-right" data-aos-duration="500" data-aos-delay="100"></div>
			<div class="shape" data-aos="fade-down-left" data-aos-duration="500" data-aos-delay="0"></div>
		</div>
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 order-2 order-md-1 text-center text-md-left">
					<h1 class="text-white font-weight-bold mb-4">Bible de Compétence</h1>
					<p class="text-white mb-5">Ayez votre propre <i>bible</i> ! <br> Ecrivez et archivez vos compétences avec BDC Apps.</p>
					<center>
						<a href="<?php if (isset($_SESSION['id'])) : echo "views/accueil.php";
									else : echo "views/inscription.php";
									endif ?>" class="btn btn-outline-info">Commencer >>></a>
					</center>
				</div>
				<div class="col-md-6 text-center order-1 order-md-2">
					<img class="img-fluid" src="images/logo/pc.png" alt="screenshot">
				</div>
			</div>
		</div>
	</section>
	<!--====  End of Hero Section  ====-->

	<section class="section pt-0 position-relative pull-top">
		<div class="container">
			<div class="rounded shadow p-5 bg-white">
				<div class="row">
					<div class="col-lg-4 col-md-6 mt-5 mt-md-0 text-center">
						<i class="ti-paint-bucket text-primary h1"></i>
						<h3 class="mt-4 text-capitalize h5 ">Archive des compétences</h3>
						<p class="regular">Encrez vos compétences ou "soft skills" facilement avec l'application web <br> BDC Apps.</p>
					</div>
					<div class="col-lg-4 col-md-6 mt-5 mt-md-0 text-center">
						<i class="ti-shine text-primary h1"></i>
						<h3 class="mt-4 text-capitalize h5 ">Accueil des compétences</h3>
						<p class="regular">Prenez facilement et rapidement les compétences mémorisées avec quelques petits clics.</p>
					</div>
					<div class="col-lg-4 col-md-12 mt-5 mt-lg-0 text-center">
						<i class="ti-thought text-primary h1"></i>
						<h3 class="mt-4 text-capitalize h5 ">Les mettre où ?</h3>
						<p class="regulard">Mettez-les dans votre Curriculum Vitae ou dans votre Lettre de Motivation avec quelques clicks magiques.</p>
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!--==================================
=            Feature Grid            =
===================================-->
	<section class="feature section pt-0" style="background-color: rgba(14,05,22,1) ;">
		<div class="container">
			<div class="row blabla">
				<div class="col-lg-6 ml-auto justify-content-center">
					<!-- Feature Mockup -->
					<div class="image-content" data-aos="fade-right">
						<img class="img-fluid" src="images/logo/art.png" alt="iphone">
					</div>
				</div>
				<div class="col-lg-6 mr-auto align-self-center">
					<div class="feature-content">
						<!-- Feature Title -->
						<h2>Work Smarter with <small> B~D~C Apps </small></h2>
						<!-- Feature Description -->
						<p class="desc">Travaillez intelligemment! Plus besoin de faire <code>copier-coller</code> sur internet
							pour remplir votre CV ou votre LM. Soyez vous même!</p>
					</div>
					<!-- Testimonial Quote -->
					<div class="testimonial">
						<p>"Work smarter not harder !"</p> <br>
						<ul class="list-inline meta">
							<li class="list-inline-item">
								<img src="images/logo/sarobidi.jpg" alt="">
							</li>
							<li class="list-inline-item">Tsizehena Sarobidi</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!--====  End of Feature Grid  ====-->

	<!--=================================
=            Video Promo            =
==================================-->
	<section class="video-promo section bg-1">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="content-block">
						<!-- Heading -->
						<h2>C'est quoi Bible de Compétence ?</h2>
						<!-- Promotional Speech -->
						<p>Ce vidéo vous expliquer ce que c'est "Bible de Compétence"</p>
						<!-- Popup Video -->
						<a data-fancybox href="https://www.youtube.com/watch?v=RrJPHxAKoI0">
							<i class="ti-control-play video"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--====  End of Video Promo  ====-->


	<!--============================
=            Footer            =
=============================-->
	<?php include 'includes/foot.php' ?>

	<!-- To Top -->
	<div class="scroll-top-to">
		<i class="ti-angle-up"></i>
	</div>

	<!-- JAVASCRIPTS -->
	<script src="plugins/jquery/jquery.min.js"></script>
	<script src="plugins/bootstrap/bootstrap.min.js"></script>
	<script src="plugins/slick/slick.min.js"></script>
	<script src="plugins/fancybox/jquery.fancybox.min.js"></script>
	<script src="plugins/syotimer/jquery.syotimer.min.js"></script>
	<script src="plugins/aos/aos.js"></script>
	<!-- google map -->
	<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgeuuDfRlweIs7D6uo4wdIHVvJ0LonQ6g"></script> -->
	<!-- <script src="plugins/google-map/gmap.js"></script> -->

	<script src="js/script.js"></script>
</body>

</html>