<?php
session_start();
require ("functions/functions.php");
require ("functions/menu.php");
require ("functions/slider.php");
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
	<meta charset="UTF-8">
	<title>Weststar Maxus Official Website | Homepage</title>
	<!-- =================== META =================== -->
	<meta name="keywords" content="Weststar Maxus, Maxus, Maxus G10, Maxus T60, Maxus V80, G10, T60, V80, Maxus models, Panel Van, Passenger Van, Maxus SUV, Maxus MPV, Maxus Van">
	<meta name="description" content="Welcome to Weststar Maxus Official Website. Browse the latest Maxus Models, Promotion, Book a Test Drives & More. Visit us now!">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="assets/img/favicon.ico">
	<!-- =================== STYLE =================== -->
	<link rel="stylesheet" href="assets/css/style_revamp.css">
	<link rel="stylesheet" href="assets/css/slick.min.css">
	<link rel="stylesheet" href="assets/css/bootstrap-grid.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/nice-select.css">
	<link rel="stylesheet" href="assets/css/animate.css">
	<link rel="stylesheet" href="assets/css/jquery.fancybox.css">
	<link rel="stylesheet" href="assets/css/style.css">
  
</head>

<body id="home" class="inner-scroll">
	<!--================ PRELOADER ================-->
	<?php loader(); ?>
	<!--============== PRELOADER END ==============-->
	
	<!-- ================= HEADER ================= -->
	<?php menu2(); ?>
	<!-- =============== HEADER END =============== -->
	
	
	<!-- #region Jssor Slider Begin -->
	<?php slider(); ?>
    <!-- #endregion Jssor Slider End -->
	
	
	<!-- =============== main-slider =============== -->
	<section class="s-main-slider">
		<div class="main-slide-navigation"></div>
		<div class="main-slider">
			<div class="main-slide">
				<div class="main-slide-bg" style="background-image: url(<!--assets/img/bg-slider-3.svg-->);"></div>
				<div class="container">
					<div class="main-slide-info">
						<h2 class="title">Maxus G10 Supreme</h2>
						<p style="max-width: 600px;">The Maxus G10 gives a commanding performance. Its elegant design draws you in with a sense of familiarity, promising the best safety in class for you and your family.</p>
						<a href="g10.php" class="btn"><span>read more</span></a>
					</div>
					<div class="slide-img-cover">
						<a href="g10.php" class="lable-bike">
							<div class="lable-bike-img"><img src="assets/img/G10.jpg" alt="img"></div>
							<div class="lable-bike-item">
								<div class="model">Maxus G10 SUPREME</div>
								<div class="price">RM 175,888*</div>
							</div>
						</a>
						<img src="assets/img/g10supreme/G10 GOLD PNG.png" alt="img" class="slide-img">
					</div>
				</div>
			</div>
			<div class="main-slide">
				<div class="main-slide-bg" style="background-image: url(<!--assets/img/bg-slider-2.svg-->);"></div>
				<div class="container">
					<div class="main-slide-info">
						<h2 class="title">Maxus T60</h2>
						<p style="max-width: 700px;">The all new T60. The ultimate pickup that is serious about your work and play when needs to. The aggressive exterior and intuitive interior provide the best driving experience and a sporty presence.</p>
						<a href="t60.php" class="btn"><span>read more</span></a>
					</div>
					<div class="slide-img-cover">
						<a href="t60.php" class="lable-bike">
							<div class="lable-bike-img"><img src="assets/img/246312_VPZRezZDBkcEgLdiTRbXpd.jpg" alt="img"></div>
							<div class="lable-bike-item">
								<div class="model">Maxus T60</div>
								<div class="price">RM 115,888*</div>
								<!--<div class="price">RM 105,888*</div>-->
							</div>
						</a>
						<img src="assets/img/Red T60 New PNG.png" alt="img" class="slide-img">
					</div>
				</div>
			</div>
			<div class="main-slide">
				<div class="main-slide-bg" style="background-image: url(<!--assets/img/bg-slider.svg-->);"></div>
				<div class="container">
					<div class="main-slide-info">
						<h2 class="title">Maxus V80 Window Van</h2>
						<p style="max-width: 900px;">The Maxus V80 has a large customizable interior to cater for passengers and commercial use. Packed with advanced safety and security technology on a strong energy absorbing body frame that gives you a peace of mind while on the road.</p>
						<a href="v80_passenger.php" class="btn"><span>read more</span></a>
					</div>
					<div class="slide-img-cover">
						<a href="v80_passenger.php" class="lable-bike">
							<div class="lable-bike-img"><img src="assets/img/models/v80passenger/headlights.jpg" alt="img"></div>
							<div class="lable-bike-item">
								<div class="model">Maxus V80 Window Van</div>
								<div class="price">RM 149,888*</div>
							</div>
						</a>
						<img src="assets/img/NEW V80 Window Van PNG-min.png" alt="img" class="slide-img">
					</div>
				</div>
			</div>
			<div class="main-slide">
				<div class="main-slide-bg" style="background-image: url(<!--assets/img/bg-slider.svg-->);"></div>
				<div class="container">
					<div class="main-slide-info">
						<h2 class="title">Maxus V80 Panel Van</h2>
						<p style="max-width: 700px;">The Maxus V80 is the best vehicle in the industry for its spacious interior. It has a wide space for heavy lifting and storing all specifications of loads that we can carry.</p>
						<a href="v80_panel.php" class="btn"><span>read more</span></a>
					</div>
					<div class="slide-img-cover">
						<a href="v80_panel.php" class="lable-bike">
							<div class="lable-bike-img"><img src="assets/img/models/v80panel/package.jpg" alt="img"></div>
							<div class="lable-bike-item">
								<div class="model">Maxus V80 Panel</div>
								<div class="price">RM 134,888*</div>
							</div>
						</a>
						<img src="assets/img/NEW V80 Panel Van PNG-min.png" alt="img" class="slide-img">
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- ============= main-slider end ============= -->
	

	<!--============== S-CATEGORY-BICYCLE ==============-->
	<section class="s-category-bicycle" style="padding: 100px 0">
		<div class="container">
		<!--<h2 class="title">Aftersales</h2>-->
			<div class="slider-categ-bicycle">
				<div class="slide-categ-bicycle">
					<div class="categ-bicycle-item">
						<img src="assets/img/aaa1.png" alt="category">
						<div class="categ-bicycle-info">
							<h4 class="title">Service &<br>Maintenance</h4>
							<a href="service&maintenance.php" class="btn"><span>view more</span></a>
						</div>
					</div>
				</div>
				<div class="slide-categ-bicycle">
					<div class="categ-bicycle-item">
						<img src="assets/img/aaa2.png" alt="category">
						<div class="categ-bicycle-info">
							<h4 class="title">24 Hours <br>Breakdown Service</h4>
							<a href="24hrsBreakdownService.php" class="btn"><span>view more</span></a>
						</div>
					</div>
				</div>
				<div class="slide-categ-bicycle">
					<div class="categ-bicycle-item">
						<img src="assets/img/aaa3.png" alt="category">
						<div class="categ-bicycle-info">
							<h4 class="title">Genuine <br>Parts</h4>
							<a href="genuine-parts.php" class="btn"><span>view more</span></a>
						</div>
					</div>
				</div>
				<div class="slide-categ-bicycle">
					<div class="categ-bicycle-item">
						<img src="assets/img/aaa4.png" alt="category">
						<div class="categ-bicycle-info">
							<h4 class="title">Warranty</h4>
							<a href="warranty.php" class="btn"><span>view more</span></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--============ S-CATEGORY-BICYKLE END ============-->
	
	
	
	<!--=============== S-OUR-VIDEO ===============-->
	<center>
	<iframe width="90%" height="600" src="https://www.youtube.com/embed/OoRV4AODzpw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	</center>
	<!--============= S-OUR-VIDEO END =============-->
	
	
		<!--================== S-OUR-NEWS ==================-->
	<section class="s-our-news">
		<div class="container">
			<h2 class="title">Our News</h2>
			<div class="news-cover row">
				
				<div class="col-12 col-md-6 col-lg-4">
					<div class="news-item">
						<h6 class="title"><a href="single-news21.php">Maxus charges up the new T60 with more power...</a></h6>
						<div class="news-post-thumbnail">
							<a href="single-news21.php"><img class="lazy" src="assets/img/news21-3.png" data-src="assets/img/news21-3.png" alt="news"></a>
						</div>
						<div class="meta">
							<span class="date"><i class="fa fa-calendar" aria-hidden="true"></i>30 July 2022</span>
						</div>
						<div class="post-content">
							<p>Maxus has given its T60 pick-up truck a little refresh that will...</p>
						</div>
						<a href="single-news21.php" class="btn-news">read more</a>
					</div>
				</div>

				<div class="col-12 col-md-6 col-lg-4">
					<div class="news-item">
						<h6 class="title"><a href="single-news20.php">Honda Malaysia to launch mobile service programme...</a></h6>
						<div class="news-post-thumbnail">
							<a href="single-news20.php"><img class="lazy" src="assets/img/s-news20-1.jpg" data-src="assets/img/s-news20-1.jpg" alt="news"></a>
						</div>
						<div class="meta">
							<span class="date"><i class="fa fa-calendar" aria-hidden="true"></i>18 February 2022</span>
						</div>
						<div class="post-content">
							<p>Honda Malaysia (HMSB) has announced that it will be...</p>
						</div>
						<a href="single-news20.php" class="btn-news">read more</a>
					</div>
				</div>
                
				<div class="col-12 col-md-6 col-lg-4">
					<div class="news-item">
						<h6 class="title"><a href="single-news19.php">FGV Launches Mobile Kedai FGV for Plantation Workers...</a></h6>
						<div class="news-post-thumbnail">
							<a href="single-news19.php"><img class="lazy" src="assets/img/s-news19.jpg" data-src="assets/img/s-news19.jpg" alt="news"></a>
						</div>
						<div class="meta">
							<span class="date"><i class="fa fa-calendar" aria-hidden="true"></i>24 January 2022</span>
						</div>
						<div class="post-content">
							<p>FGV Holdings Berhad (FGV) launches its mobile Kedai FGV pilot project...</p>
						</div>
						<a href="single-news19.php" class="btn-news">read more</a>
					</div>
				</div>						
				
			</div>
			<div class="btn-cover"><a class="btn" href="news.php"><span>view more</span></a></div>
		</div>
	</section>
	<!--================ S-OUR-NEWS END ================-->
	
	<!--================== S-SUBSCRIBE ==================-->
	<section class="s-subscribe" style="background-image: url(assets/img/bg-subscribe1.jpg);">
		<span class="mask"></span>
		<span class="subscribe-effect wow fadeIn" data-wow-duration="1s" style="background-image: url(<!--assets/img/subscribe-effect.svg-->);"></span>
		<div class="container">
			<div class="subscribe-left">
				<h2 class="title"><span>Book a test drive</span></h2>
				<p>Now book a test drive online of all Maxus vehicles. Better experienced than explained!</p>
				<form class="subscribe-form">
					<a href="testdrive.php" class="btn btn-form btn-yellow"><span>BOOK NOW</span></a>
				</form>
			</div>
			<img class="wow fadeInRightBlur lazy" data-wow-duration=".8s" data-wow-delay=".3s" src="assets/img/placeholder-all.png" data-src="assets/img/g10sub.png" alt="img">
		</div>
	</section>
	<!--================ S-SUBSCRIBE END ================-->

	<!--================== S-INSTAGRAM ==================-->
	<section class="s-instagram">
		<div class="instagram-cover">
			<iframe width="560" height="315" src="https://www.youtube.com/embed/jo0VQ3CzhM0" title="YouTube video player"                            frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"               allowfullscreen></iframe>
			
			<iframe width="560" height="315" src="https://www.youtube.com/embed/4nwAFSUk9pc" title="YouTube video player"                          frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"                   allowfullscreen></iframe>
			
			<iframe width="560" height="315" src="https://www.youtube.com/embed/HxoRVFelvSY" title="YouTube video player"                           frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"                 allowfullscreen></iframe>
		</div>
	</section>
	<!--================ S-INSTAGRAM END ================-->

	<!--==================== FOOTER ====================-->
	<?php footer(); ?>
	<!--================== FOOTER END ==================-->
	
	<!--==================== BUTTON FLOAT ====================-->
	<?php button(); ?>
	<!--==================== BUTTON FLOAT END====================-->

	<!--===================== TO TOP =====================-->
	<a class="to-top" href="#home">
		<i class="fa fa-angle-double-up" aria-hidden="true"></i>
	</a>
	<!--=================== TO TOP END ===================-->
	<!--==================== SCRIPT	====================-->
	
	<script src="assets/js/jquery-2.2.4.min.js"></script>
	<script src="assets/js/slick.min.js"></script>
	<script src="assets/js/jquery.nice-select.js"></script>
	<script src="assets/js/wow.js"></script>
	<script src="assets/js/lazyload.min.js"></script>
	<script src="assets/js/isotope.pkgd.js"></script>
	<script src="assets/js/jquery.fancybox.js"></script>
	<script src="assets/js/scripts.js"></script>
	
	<script>
    function PopUp(hideOrshow) {
    if (hideOrshow == 'hide') document.getElementById('ac-wrapper').style.display = "none";
    else document.getElementById('ac-wrapper').removeAttribute('style');
    }
    window.onload = function () {
        setTimeout(function () {
            PopUp('show');
        }, 3000);
    }
    </script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-NETX232JRL"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'G-NETX232JRL');
	</script>
	
	<!-- JS -->
	<script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
<!--This website was created and completed by dedicated team from WESB: Mohamad Akmal Bin Abdul Karim, Muhammad AimanHafiz Bin Mohd Mudasir, Tinish A/L V.P Pushppadharan, Izzatul Adilah Binti Aziz, Amiera Farisha Binti Hasbullah @ 16 March 2021 -->
