<?php
	include("admin/db/dbc.php");
	session_start();
	//If your session isn't valid, it returns you to the login screen for protection
	if(empty($_SESSION['id_pengguna'])){
	 header("location:access-denied.php");
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Pencalonan MPP ILP Ledang</title>
    <meta name="description" content="Sistem Pencalonan MPP ILP Ledang">
    <meta name="keywords" content="">
    <meta name="author" content="">
    
    <!-- Favicons
    ================================================== -->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="img/apple-touch-icon.html">
    <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.html">
    <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.html">

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css"  href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="font-awesome-4.2.0/css/font-awesome.css">

    <link href="css/owl.carousel.css" rel="stylesheet" media="screen">
    <link href="css/owl.theme.css" rel="stylesheet" media="screen">

    <!-- Stylesheet
    ================================================== -->
    <link rel="stylesheet" type="text/css"  href="css/home.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.html">

    <script type="text/javascript" src="js/modernizr.custom.js"></script>

    <!--Google Font-->
    <link href='http://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  
	<script language="JavaScript" src="js/jquery-2.1.1.min.js"></script>

</head>
<body>
    <div id="header" class="text-center">
        <h1>Pencalonan Majlis Perwakilan Pelajar</h1>
        <h3>ILP Ledang Bestari Dalam Taman</h3>
    </div>

    <div class="container"> <!-- Container -->  
		<div class="row">
			<div class="col-md-offset-2 col-sm-offset-2 col-lg-offset-2 col-md-8 col-sm-8 col-lg-8">
				<br><br><br><br><br>
				<h4>Pengundian telah berjaya.</h4><h4>Anda akan dilog keluar secara automatik sebentar lagi.</h4>
			</div>
		</div> 
    </div> <!-- End Container -->
	<!--JS for logout timer -->
	<script> 
		setTimeout(function () {
		window.location.href= 'logout.php'; // the redirect goes here

		},3000); // 5 seconds
	</script> 
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../../../../ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.1.11.1.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="js/bootstrap.js"></script>

    <script src="js/owl.carousel.js"></script>
    <script type="text/javascript" src="js/SmoothScroll.js"></script>  
    <script type="text/javascript" src="js/custom.js"></script>

    <!-- Javascripts
    ================================================== -->
    <script type="text/javascript" src="js/custom.js"></script>
  </body>
</html>