<?php

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//Second Navbar
function menu(){
	
	
	global $con;
    $timestamp = time();
    $php_timestamp_date = date('y,m,d', $timestamp);
	$myt = date('H:i');
	$utc = gmdate('H:i'); 




	
	echo " 
			<a href='#' class='nav-btn'>
			<span></span>
			<span></span>
			<span></span>
		</a>
		
		<div class='header-menu'>
			<div class='container'>
			  <a href='index.php' class='logo'><img src='assets/img/weststar-logo-inline.png' width='' height='15' alt='logo'></a>
				<nav class='nav-menu'>
					<ul class='nav-list'>
					    <li><a href='index.php'>Home</a></li>
						<li class='dropdown'>
							<a href='#'>About<i class='fa fa-angle-down' aria-hidden='true'></i></a>
							<ul style='background-color: #ffc600;'>
								<li><a href='about.php' style='color: #000000; opacity: 2.5;'>About Us</a></li>
								<li><a href='news.php' style='color: #000000; opacity: 2.5;'>Newsroom</a></li>
								<li><a href='promotions.php' style='color: #000000; opacity: 2.5;'>Promotions</a></li>
						        <li><a href='careers.php' style='color: #000000; opacity: 2.5;'>Careers</a></li>
						        <li><a href='contacts.php' style='color: #000000; opacity: 2.5;'>Contacts</a></li>
							</ul>
						</li>
						<li class='dropdown'>
							<a href='models.php'>Model <i class='fa fa-angle-down' aria-hidden='true'></i></a>
							<ul style='background-color: #ffc600;'>		
								<li><a href='g10.php' style='color: #000000; opacity: 2.5;'>G10</a></li>
								<li><a href='t60.php' style='color: #000000; opacity: 2.5;'>T60</a></li>
								<li><a href='v80_passenger.php' style='color: #000000; opacity: 2.5;'>V80 Window Van</a>
								<span style='color: #fff;
											background-color: #dc3545;
											display: inline-block;
											padding: .25em .4em;
											font-size: 75%;
											font-weight: 700;
											line-height: 1;
											text-align: center;
											border-radius: .25rem;'>New</span></li>
								<li><a href='v80_panel.php' style='color: #000000; opacity: 2.5;'>V80 Panel Van</a></li>
								<li><a href='v80spv.php' style='color: #000000; opacity: 2.5;'>Special Purpose Vehicle&nbsp<i class='fa fa-angle-down' style='color: #000000;' aria-hidden='true'></i></a></li>
							</ul>
						</li>
						<!--<li><a href='aftersales.php'>Aftersales</a></li>-->
						<li class='dropdown'>
							<a href='#'>Aftersales<i class='fa fa-angle-down' aria-hidden='true'></i></a>
							<ul style='background-color: #ffc600;'>
								<li><a href='service&maintenance.php' style='color: #000000; opacity: 2.5;'>Service & Maintenance</a></li>
								<li><a href='24hrsBreakdownService.php' style='color: #000000; opacity: 2.5;'>24Hrs Breakdown Service</a></li>
								<li><a href='genuine-parts.php' style='color: #000000; opacity: 2.5;'>Genuine Parts</a></li>
								<li><a href='warranty.php' style='color: #000000; opacity: 2.5;'>Warranty</a></li>
							</ul>
						</li>
						<!--<li><a href='locations.php'>Locations</a></li>-->
						<li class='dropdown'>
							<a href='#'>Locations<i class='fa fa-angle-down' aria-hidden='true'></i></a>
							<ul style='background-color: #ffc600;'>
								<li><a href='locations.php' style='color: #000000; opacity: 2.5;'>Showrooms</a></li>
								<li><a href='service-branches2.php' style='color: #000000; opacity: 2.5;'>Service Centres</a></li>
							</ul>
						</li>
					</ul>
				</nav>
				
				<div class='header-two-search'>
					<ul class='header-cont'>
							<!--<li style='margin-right: 1px;'><a target='_blank' href='https://www.facebook.com/weststarmaxusmy'><i class='fa fa-facebook' aria-hidden='true' style='color:white;'></i></a></li>
							<li style='margin-right: 1px;'><a target='_blank' href='https://www.instagram.com/weststarmaxusmy'><i class='fa fa-instagram' aria-hidden='true' style='color:white;'></i></a></li>
							<li style='margin-right: 1px;'><a target='_blank' href='https://www.youtube.com/channel/UC4pSHfWoun-o88tWf5KHlPw'><i class='fa fa-youtube-play' aria-hidden='true' style='color:white;'></i></a></li>-->
					
					<div class='header-two-search'>
				    <a href='index.php' class='logo'><img src='assets/img/weststar-logo3.jpg' width='' height='31' alt='logo'></a>
				    </div>
					</ul>
				</div>
				
				
			</div>
		</div>

	";
	
}



//QRCODE Footer
function footer(){
	
	echo "

	<!--==================== FOOTER ====================-->
	<footer style='background-color: #FFC600;'>
		<div class='container'>
			<div class='row footer-item-cover'>
				<!--<div class='footer-subscribe col-md-7 col-lg-8'>
					<h6>subscribe</h6>
					<p style='color: #192330;'>Subscribe us and you won't miss the new arrivals, as well as discounts and sales.</p>
					<form class='subscribe-form'>
						<i class='fa fa-at' aria-hidden='true'></i>
						<input class='inp-form' type='email' name='subscribe' placeholder='E-mail'>
						<button type='submit' class='btn btn-form'><span>send</span></button>
					</form>
				</div>-->
				<div class='footer-touch col-md-4 col-lg-4'>
					<h6>stay in touch</h6>
					<ul class='footer-soc social-list'>
						<li><a target='_blank' href='https://www.facebook.com/weststarmaxusmy'><i class='fa fa-facebook' aria-hidden='true' style='color: #192330;'></i></a></li>
						<li><a target='_blank' href='https://www.instagram.com/weststarmaxusmy'><i class='fa fa-instagram' aria-hidden='true' style='color: #192330;'></i></a></li>
						<li><a target='_blank' href='https://www.youtube.com/channel/UC4pSHfWoun-o88tWf5KHlPw'><i class='fa fa-youtube-play' aria-hidden='true' style='color: #192330;'></i></a></li>
					</ul>
					<!--<div class='footer-autor'>Questions? Please write us at:</div>-->
					<!--<div class='footer-autor'>Email: <a href='mailto:sales@weststarmaxus.com'>sales@weststarmaxus.com</a></div>-->
					<div class='footer-autor'>Call: <a href='tel:+60321433331'>+60321433331</a></div>
					<div class='footer-autor'>Address: <a href='#'>366, Jalan Tun Razak, 50400, Kuala Lumpur</a></div>
				</div>
				<div class='footer-item col-md-4 col-lg-4'>
					<h6>Quick Links</h6>
					<ul class='footer-list'>
						<li><a href='index.php'>Home</a></li>
						<li><a href='about.php'>About</a></li>
						<li><a href='models.php'>Model</a></li>
						<li><a href='aftersales.php'>Aftersales</a></li>
						<li><a href='news.php'>Newsroom</a></li>
						<li><a href='careers.php'>Career</a></li>
					</ul>
				</div>
				<div class='footer-item col-md-4 col-lg-4'>
					<h6>Contact Us</h6>
					<ul class='footer-list'>
						<li><a href='testdrive.php'>Book a Test Drive</a></li>
						<li><a href='bookservice.php'>Book a Service</a></li>
						<li><a href='contacts.php'>Ask a Question</a></li>
					</ul>
				</div>
			</div>
			<!--<div class='row footer-item-cover'>
				<div class='footer-touch col-md-7 col-lg-8'>
					<h6>stay in touch</h6>
					<ul class='footer-soc social-list'>
						<li><a target='_blank' href='https://www.facebook.com/WeststarMaxus'><i class='fa fa-facebook' aria-hidden='true' style='color: #192330;'></i></a></li>
						<li><a target='_blank' href='https://www.instagram.com/weststarmaxusmy'><i class='fa fa-instagram' aria-hidden='true' style='color: #192330;'></i></a></li>
						<li><a target='_blank' href='https://www.youtube.com/channel/UC4pSHfWoun-o88tWf5KHlPw'><i class='fa fa-youtube-play' aria-hidden='true' style='color: #192330;'></i></a></li>
					</ul>
					<div class='footer-autor'>Questions? Please write us at:</div>
					<div class='footer-autor'>Email: <a href='mailto:sales@weststarmaxus.com'>sales@weststarmaxus.com</a></div>
					<div class='footer-autor'>Call: <a href='tel:+60321433331'>+60321433331</a></div>
					<div class='footer-autor'>Address: <a href='#'>366, Jalan Tun Razak, 50400, Kuala Lumpur</a></div>
				</div>
				<div class='footer-item col-md-5 col-lg-4'>
					<h6>Contact Us</h6>
					<ul class='footer-list'>
						<li><a href='testdrive.php'>Book a Test Drive</a></li>
						<li><a href='bookservice.php'>Book a Service</a></li>
						<li><a href='contacts.php'>Ask a Question</a></li>
					</ul>
				</div>
			</div>-->
			<div class='footer-bottom' >
				<div class='footer-copyright' style='color: #192330;'><a target='_blank' href='https://weststarmaxus.com'>Weststar Maxus</a> © 2021. All Rights Reserved.</div>
				<ul class='footer-pay'>
					<li><a href='#'><img src='assets/img/weststar-logo-black.png' height='17' alt='img'></a></li>&nbsp;&nbsp;
					<li><a href='#'><img src='assets/img/weststar-logo.png' height='30' alt='img'></a></li>
				</ul>
			</div>
		</div>
	</footer>
	<!--================== FOOTER END ==================-->
	
	";
	
}


//Loader
function loader(){
	
	echo "

	<!--================ PRELOADER ================-->
	<div class='preloader-cover'>
	<img src='assets/img/logomaxus.gif' height='200px'
	style='position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);'/>
	</div>
	<!--============== PRELOADER END ==============-->
	";
	
}

//Button Float Book Now RM300
function button(){
	
	echo "

	<!--================ BUTTON ================-->
	<a class='Layout_buttonFloat__3HtFy' href='booknow300.php'>
	<img src='assets/img/button1.png' alt='Test Drive' height='50px' width='50px' z-index='1050'>
	<span>BOOK NOW AT RM300</span></a>
	<!--============== BUTTON ==============-->
	";
	
}


//Button Float Book A Test Drive
function button1(){
	
	echo "

	<!--================ BUTTON ================-->
	<a class='Layout_buttonFloat__3HtFy' href='testdrive.php'>
	<img src='https://www.in.gov/bmv/images/driving-skills-exam-icon.png' alt='Test Drive' height='50px' width='50px' z-index='1050'>
	<span>Book A Test Drive</span></a>
	<!--============== BUTTON ==============-->
	";
	
}

//Button Float Book Now
function button2(){
	
	echo "

	<!--================ BUTTON ================-->
	<a class='Layout_buttonFloat__3HtFy' href='testdrive.php'>
	<img src='assets/img/button1.png' alt='Test Drive' height='50px' width='50px' z-index='1050'>
	<span>BOOK NOW</span></a>
	<!--============== BUTTON ==============-->
	";
	
}



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


?>