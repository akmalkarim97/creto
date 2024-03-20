<?php

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//Second Navbar
function menu1(){
	
	
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
			  <a href='index.php' class='logo'><img src='assets/img/weststar-logo-inline.png' width='200' alt='logo'></a>
				<nav class='nav-menu'>
					<ul class='nav-list'>
						<li class='dropdown'>
							<a href='index.php'>Home<i class='fa fa-angle-down' aria-hidden='true'></i></a>
							<ul style='background-color: #ffc600;'>
								<li><a href='index.php' style='color: #000000; opacity: 2.5;'>Home 1</a></li>
								<li><a href='index1.php' style='color: #000000; opacity: 2.5;'>Home 2</a></li>
								<li><a href='index2.php' style='color: #000000; opacity: 2.5;'>Home 3 (Dark Mode)</a></li>
							</ul>
						</li>
						<li><a href='about.php'>About</a></li>
						<li class='dropdown'>
							<a href='models.php'>Model <i class='fa fa-angle-down' aria-hidden='true'></i></a>
							<ul style='background-color: #ffc600;'>
								<li><a href='g10.php' style='color: #000000; opacity: 2.5;'>G10</a></li>
								<li><a href='t60.php' style='color: #000000; opacity: 2.5;'>T60</a></li>
								<li><a href='v80_panel.php' style='color: #000000; opacity: 2.5;'>V80 Panel Van</a></li>
								<li><a href='v80_passenger.php' style='color: #000000; opacity: 2.5;'>V80 Passenger</a></li>
							</ul>
						</li>
						<li><a href='aftersales.php'>Aftersales</a></li>
						<li><a href='locations.php'>Locations</a></li>
						<li><a href='news.php'>News & Promotions</a></li>
						<li><a href='careers.php'>Careers</a></li>
						<li><a href='contacts.php'>Contacts</a></li>
					</ul>
				</nav>
				
				<div class='header-two-search'>
					<ul class='header-cont'>
							<li style='margin-right: 1px;'><a target='_blank' href='https://www.facebook.com/WeststarMaxus'><i class='fa fa-facebook' aria-hidden='true'></i></a></li>
							<li style='margin-right: 1px;'><a target='_blank' href='https://twitter.com/weststarmaxus'><i class='fa fa-youtube' aria-hidden='true'></i></a></li>
							<li style='margin-right: 1px;'><a target='_blank' href='https://www.instagram.com/weststarmaxusmy'><i class='fa fa-instagram' aria-hidden='true'></i></a></li>
					</ul>
				</div>
				
				<!--<div class='header-two-search'>
				    <a href='index.php' class='logo'><img src='assets/img/weststar-logo.png' width='200' alt='logo'></a>
				</div>-->
			</div>
		</div>

	";
	
}



//QRCODE Footer
function footer1(){
	
	echo "

	<!--==================== FOOTER ====================-->
	<footer style='background-color: #FFC600;'>
		<div class='container'>
			<div class='row footer-item-cover'>
				<div class='footer-subscribe col-md-7 col-lg-8'>
					<h6>subscribe</h6>
					<p style='color: #192330;'>Subscribe us and you won't miss the new arrivals, as well as discounts and sales.</p>
					<form class='subscribe-form' style='color: #192330;'>
						<i class='fa fa-at' aria-hidden='true'></i>
						<input class='inp-form' type='email' name='subscribe' placeholder='E-mail'>
						<button type='submit' class='btn btn-form'><span>send</span></button>
					</form>
				</div>
				<div class='footer-item col-md-5 col-lg-4'>
					<h6>stay in touch</h6>
					<ul class='footer-soc social-list'>
						<li><a target='_blank' href='https://www.facebook.com/WeststarMaxus'><i class='fa fa-facebook' aria-hidden='true'></i></a></li>
						<li><a target='_blank' href='https://www.youtube.com/channel/UC4pSHfWoun-o88tWf5KHlPw'><i class='fa fa-youtube' aria-hidden='true'></i></a></li>
						<li><a target='_blank' href='https://www.instagram.com/weststarmaxusmy'><i class='fa fa-instagram' aria-hidden='true'></i></a></li>
					</ul>
					<div class='footer-autor'>Questions? Please write us at: <a href='mailto:sales@weststarmaxus.com'>sales@weststarmaxus.com</a></div>
					<div class='footer-autor'>Call us: <a href='tel:+60321433331'>+60321433331</a></div>
					<div class='footer-autor'>Address: <a href='#'>366, Jalan Tun Razak, 50400, Kuala Lumpur</a></div>
				</div>
			</div>
			<div class='footer-bottom'>
				<div class='footer-copyright'><a target='_blank' href='https://weststarmaxus.com'>Weststar Maxus</a> © 2021. All Rights Reserved.</div>
				<ul class='footer-pay'>
					<li><a href='#'><img src='assets/img/weststar-badge.png' width='70' alt='img'></a></li>
				</ul>
			</div>
		</div>
	</footer>
	<!--================== FOOTER END ==================-->
	
	";
	
}




/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


?>