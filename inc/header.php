<?php
ob_start();
$filepath = realpath(dirname(__FILE__));
include_once ($filepath . '/../lib/Database.php');
include_once ($filepath . '/../lib/Session.php');
include_once ($filepath . '/../helper/Format.php');
spl_autoload_register(function($class_name) {
	include_once "classes/" . $class_name . ".php";
});

$database = new Database();
$format = new Format();

$user = new User();
$service = new Service();
$contact = new Contact();

$page = $_SERVER['PHP_SELF'];
$page = explode('/', $page);
$page_path = end($page);


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['quick_query'])) {
  $query_result = $contact->insertQuickQuery($_POST);
}

?>
<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Ethically made handcrafted products</title>
		<meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="robots" content="INDEX,FOLLOW" />
        <meta name="google-site-verification" content="Ok6f4CDqgtJ6m5wPH-iSnjs8xRgAo5GbrmtYRyjAF4U" />
		<link rel="icon" type="img/icon" href="assets/img/favicon.png">
		<link rel="stylesheet" href="assets/css/bootstrap.css">
		<link rel="stylesheet" href="assets/css/owl-slider/owl.carousel.min.css">
		<link rel="stylesheet" href="assets/css/owl-slider/owl.theme.default.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/style.css">
	    <style>
		#progress-bar {background-color: #12CC1A;height:20px;color: #FFFFFF;width:0%;-webkit-transition: width .3s;-moz-transition: width .3s;transition: width .3s;}
		#progress-div {border:#0FA015 1px solid;padding:0px;margin:0px 0px;border-radius:4px;text-align:center; display:none;}

		</style>
	</head>
	<body class="d-flex flex-column min-vh-100">
		<!-- header part start -->
		<header class="d-none d-lg-block">
			<div class="py-1 header_top main_bg">
				<div class="container">
					<div class="row">
						<div class="col-6 d-flex align-items-center">
							<div class="small text-white">
								<i class="fa fa-envelope"></i>
								<span>MAIL: <a href="mailto:sample@gmail.com" class="text-decoration-none text-white">sample@gmail.com</a></span>
							</div>
						</div>
						<div class="col-6">
							<div class="float-right social_icon">
								<a class="d-inline-block px-1 text-white" href="https://www.facebook.com/Wardrobedacca" title="Wardrobedacca | Facebook" target="_blank">
									<i class="fa fa-facebook-f"></i>
								</a>
								<a class="d-inline-block px-1 text-white" href="" title="Wardrobebd | Twitter" target="_blank">
									<i class="fa fa-twitter"></i>
								</a>
								<a class="d-inline-block px-1 text-white" href="" title="Wardrobebd | Pinterest" target="_blank">
									<i class="fa fa-pinterest-p"></i>
								</a>
								<a class="d-inline-block px-1 text-white" href="" title="Wardrobebd | Linkedin" target="_blank">
									<i class="fa fa-linkedin"></i>
								</a>
								<a class="d-inline-block px-1 text-white" href="" title="Wardrobebd | Whatsapp" target="_blank">
									<i class="fa fa-whatsapp"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="header_middle py-1 border-bottom">
				<div class="container">
					<div class="row">
						<div class="col-md-4">
							<a href="index.php" title="Wardrobebd">
								<img class="py-1 w-100" src="assets/img/logo.png" alt="Wardrobebd | Logo" width="245" height="66">
							</a>
						</div>
						<div class="col-md-8 d-flex align-items-center justify-content-end">
							<div class="user_cart">
								<div class="menu d-flex align-items-center">
									<ul class="d-inline-block">
										<li>
											<a href="index.php">Home</a>
										</li>
										<li>
											<a href="image-editing-company-in-bangladesh.php">About Us</a>
										</li>
										<li class="position-relative services">
											<a href="photoshop-image-editing-service.php">Services</a>
											<div class="services_menu">
												<a href="image-background-removal-services.php">Image Background Removal Services</a>
												<a href="image-masking-service.php">Photoshop Image Masking Service</a>
												<a href="photoshop-image-retouching-service.php">Photoshop Image Retouching Service</a>
												<a href="ghost-mannequin-effect-photoshop.php">Ghost Mannequin Removal Services</a>
												<a href="multi-color-clipping-path-service.php">Multi clipping path Services</a>
												<a href="photo-shadow-effect.php">Shadow Creation</a>
											</div>
										</li>
										<li>
											<a href="contact-us.php">Contact</a>
										</li>
										<li class="position-relative resources">
											<a href="javascript:void(0)">Resources</a>
											<div class="resources_menu">
												<a href="free-quote.php">Get a Free Quote</a>
												<a href="image-manupulation-service-faq.php">FAQ</a>
												<a href="ftp-request.php">Request for FTP</a>
												<a href="sitemap.php">Site Map</a>
												<a href="privacy-policy.php">Privacy Policy</a>
											</div>
										</li>
										<li>
											<a href="https://www.clippingpathretouching.com/blog/" target="_blank">Blog</a>
										</li>
										<li>
											<a href="free-trial.php">Free Trial</a>
										</li>
										<li>
											<a href="authentication.php" style="padding: 8px 15px;">
												<i class="fa fa-user" style="font-size: 25px;"></i>
											</a>
										</li>
									</ul>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- sticky header start -->
			<div class="sticky" id="navbar">
				<div class="container">
					<div class="row">
						<div class="col-md-4">
							<a href="index.php" title="Wardrobebd">
								<img class="py-1 w-100" src="assets/img/logo.png" alt="Wardrobebd | Logo" width="245" height="66">
							</a>
						</div>
						<div class="col-md-8 d-flex align-items-center justify-content-end">
							<div class="user_cart">
								<div class="menu d-flex align-items-center">
									<ul class="d-inline-block">
										<li>
											<a href="index.php">Home</a>
										</li>
										<li>
											<a href="image-editing-company-in-bangladesh.php">About Us</a>
										</li>
										<li class="position-relative services">
											<a href="photoshop-image-editing-service.php">Services</a>
											<div class="services_menu">
												<a href="image-background-removal-services.php">Image Background Removal Services</a>
												<a href="image-masking-service.php">Photoshop Image Masking Service</a>
												<a href="photoshop-image-retouching-service.php">Photoshop Image Retouching Service</a>
												<a href="ghost-mannequin-effect-photoshop.php">Ghost Mannequin Removal Services</a>
												<a href="multi-color-clipping-path-service.php">Multi clipping path Services</a>
												<a href="photo-shadow-effect.php">Shadow Creation</a>
											</div>
										</li>
										<li>
											<a href="contact-us.php">Contact</a>
										</li>

										<li class="position-relative resources">
											<a href="javascript:void(0)">Resources</a>
											<div class="resources_menu">
												<a href="free-quote.php">Get a Free Quote</a>
												<a href="image-manupulation-service-faq.php">FAQ</a>
												<a href="ftp-request.php">Request for FTP</a>
												<a href="sitemap.php">Site Map</a>
												<a href="privacy-policy.php">Privacy Policy</a>
											</div>
										</li>
										<li>
											<a href="https://www.clippingpathretouching.com/blog/" target="_blank">Blog</a>
										</li>
										<li>
											<a href="free-trial.php">Free Trial</a>
										</li>
										<li>
											<a href="authentication.php" style="padding: 8px 15px;">
												<i class="fa fa-user" style="font-size: 25px;"></i>
											</a>
										</li>
									</ul>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- sticky header end -->
		</header>
		<!-- mobile device start -->
		<div class="mobile_device d-lg-none">
			<div class="container-fluid">
				<div class="row">
					<div class="col-3">
						<a href="javascript:void(0)" onclick="openNav()" class="d-flex align-items-center text-muted text-decoration-none" style="height: 60px;">
							<i class="fa fa-bars mr-2"></i>
							<span class="text-uppercase dn_320">Menu</span>
						</a>
					</div>
					<div class="col-6 d-flex justify-content-center">
						<a href="index.php">
							<img class="py-1" src="assets/img/logo.png" alt="Logo" width="145" height="60">
						</a>
					</div>
					<div class="col-3">
						<a href="authentication.php" class="d-flex align-items-center justify-content-center text-muted text-decoration-none h-100">
							<i class="fa fa-user"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="menu_layer" id="menu_layer" onclick="closeNav()">
			<div class="mobile_menu">
				<a class="float-right px-3 py-1 m-1 bg-danger text-white text-decoration-none" onclick="closeNav()" href="javascript:void(0)">X</a>
				<div class="clearfix"></div>
				<ul class="mobile_menus">
					<li>
						<a href="index.php">Home</a>
					</li>
					<li>
						<a href="image-editing-company-in-bangladesh.php">About Us</a>
					</li>
					<li class="position-relative">
						<a class="border-bottom" href="photoshop-image-editing-service.php">Services</a>
						<div class="services_mobile_menu pl-3">
							<a class="border-bottom" href="image-background-removal-services.php">Image Background Removal Services</a>
							<a class="border-bottom" href="image-masking-service.php">Photoshop Image Masking Service</a>
							<a class="border-bottom" href="photoshop-image-retouching-service.php">Photoshop Image Retouching Service</a>
							<a class="border-bottom" href="ghost-mannequin-effect-photoshop.php">Ghost Mannequin Removal Services</a>
							<a class="border-bottom" href="multi-color-clipping-path-service.php">Multi clipping path Services</a>
							<a class="border-bottom" href="photo-shadow-effect.php">Shadow Creation</a>
						</div>
					</li>
					<li>
						<a href="contact-us.php">Contact</a>
					</li>
					<li class="position-relative">
						<a class="border-bottom" href="javascript:void(0)">Resources</a>
						<div class="services_mobile_menu pl-3">
							<a class="border-bottom" href="image-background-removal-services.php">Image Background Removal Services</a>
							<a class="border-bottom" href="free-quote.php">Get a Free Quote</a>
							<a class="border-bottom" href="image-manupulation-service-faq.php">FAQ</a>
							<a class="border-bottom" href="ftp-request.php">Request for FTP</a>
							<a class="border-bottom" href="sitemap.php">Site Map</a>
							<a class="border-bottom" href="privacy-policy.php">Privacy Policy</a>
						</div>
					</li>
					<li>
						<a href="https://www.clippingpathretouching.com/blog/" target="_blank">Blog</a>
					</li>
					<li>
						<a href="free-trial.php">Free Trial</a>
					</li>
				</ul>
			</div>
		</div>
		<!-- mobile device end -->
		<!-- header part end -->