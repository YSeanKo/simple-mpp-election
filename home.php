<?php
	include("admin/db/dbc.php");
	session_start();
	//If your session isn't valid, it returns you to the login screen for protection
	if(empty($_SESSION['id_pengguna'])){
		header("location:access-denied.php");
	}
?>

<?php 
    //Query data for calon
	$result = mysqli_query($conn, "SELECT jc.id, jp.nama_penuh, jp.no_matrik FROM jcalon jc, jpelajar jp WHERE jc.id_pelajar=jp.id")
	or die(" Tiada calon ditemui\n"); 

	$_SESSION['jum_calon'] = mysqli_num_rows($result);
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

    <div class="title">
        <center><h2>Calon</h2></center><br><br>
		
    </div>

    <div class="container"> <!-- Container -->  
	<center><h4>Sila pilih 6 orang calon.</h4></center> <!--Edit -->
		<form id="formsubmit" method="post" action="submitVote.php"> 
				
			<div class="row">
			<?php 
			//Query data for each calon and insert as a row
					$temp = 1;
					while ($row=mysqli_fetch_array($result)){
						echo '<div class="col-md-3 col-sm-3 col-lg-3">';
						echo "   <div class='t-style2' id='calon-".$temp."'>";
						echo "       <img src='img/pelajar/".$row['no_matrik'].".jpg' class='img-responsive' alt='".$row['no_matrik']."'>";
						echo "       <h4>".$row['nama_penuh']."</h4>";
						echo "      <div class='t-social2' id='scalon-".$temp."'>";
						echo '           <a href="#"><label style="color:#FFF; font-weight:800;">PILIH</label></a>';
						echo '       </div>';
						echo "       <input style='opacity:0;position:absolute;top: -9999px;left: -9999px;' class='calon-checkbox' type='checkbox' value='".$row['id']."' name='voted[]' />";
						echo '   </div>';
						echo '</div>';
						$temp++;
					}
			?>
			</div> 
			<div class="row">
				<div class="col-md-offset-4 col-sm-4 col-lg-4">
					<input type="submit" value="Selesai" class="btn btn-block btn-lg btn-success"></input>
				</div>	
			</div>	
		</form>
    </div> <!-- End Container -->
	<script> 
		<?php 
		    //Setup jQuery checkbox validation for each row - maximum
			$num_rows = $_SESSION['jum_calon'];

			for ($i = 1; $i <= $num_rows; $i++)
			{
				echo "$(document).on('click', '#calon-".$i."', function (event) {";
				echo "var checkbox = $(this).find('input[type="; echo'"checkbox"'; echo"]');";
				echo "var maxAllowed = 5;"; //6 allowed, for some reason
				echo "var cnt = $('input.calon-checkbox:checked').length;";
				echo "if (cnt > maxAllowed && checkbox.is(':checked') == false) {";
				echo "var checkbox = $(this).find('input[type="; echo'"checkbox"'; echo"]');";
				echo 'checkbox.prop("checked", "");';
				echo "	alert('Anda boleh pilih 6 calon sahaja.');";
				echo "}";
				
				echo "else{";
				
				echo "var target = $(event.target);";
				echo "if (target.is('input:checkbox')) {";
				echo "	return;}";
			
				echo "var checkbox = $(this).find('input[type="; echo'"checkbox"'; echo"]');";
				echo "checkbox.prop('checked', !checkbox.is(':checked'));";

				echo "$('#calon-".$i."').toggleClass('t-style2-selected');";
				echo "$('#scalon-".$i."').toggleClass('t-social2-selected');";
				echo "}";
				echo "});";
			}
		?>
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
	 <!-- JS for checkbox validation - min 6 -->
	<script>
		$('#formsubmit').submit(function (e) {
				var number_of_checked_checkbox= $(".calon-checkbox:checked").length;
				if(number_of_checked_checkbox < 6){
					alert("Silih pilih 6 orang calon.");
					e.preventDefault();
				}
			});
	</script>
  </body>
</html>