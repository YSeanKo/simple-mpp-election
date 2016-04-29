<?php
	include("db/dbc.php");
	session_start();
	//If your session isn't valid, it returns you to the login screen for protection
	if(empty($_SESSION['id_pentadbir'])){
	 header("location:access-denied.php");
	}
?>

<?php 
	//Query calon
	$result = mysqli_query($conn, "SELECT jc.jumlah_undi, jp.nama_penuh FROM jcalon jc, jpelajar jp WHERE jc.id_pelajar=jp.id")
	or die(" Tiada calon ditemui\n"); 
	 
	//Query jumlah undi
	$result_jum_undi = mysqli_query($conn, "SELECT SUM(jc.jumlah_undi) as total FROM jcalon jc")
	or die(" Tiada undi ditemui\n");
	 
	$j_undi = mysqli_fetch_assoc($result_jum_undi);
	$_SESSION['jum_undi'] = $j_undi['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistem Pencalonan MPP UTHM</title>

    <!-- Bootstrap core CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="css/custom.css" rel="stylesheet">

    <script src="js/jquery.min.js"></script>
    <script src="js/nprogress.js"></script>
    <script>
        NProgress.start();
    </script>
    
    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body class="nav-md">

    <div class="container body">
        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title"> <span>UTHM</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    <div class="profile">
						<span>&nbsp;&nbsp;&nbsp;SISTEM PENCALONAN MPP</span>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <h3></h3>
                            <ul class="nav side-menu">
                                <li>
									<a  href="home.php"><i class="fa fa-home"></i> Utama</a>
                                </li>
                                <li>
									<a  href="urus-calon.php"><i class="fa fa-user"></i> Urus Calon</span></a>
                                </li>
                                <li>
									<a  href="urus-pentadbir.php"><i class="fa fa-user-md"></i> Urus Pentadbir</a>
                                </li>
								<li>
									<a  href="keputusan.php"><i class="fa fa-list"></i> Keputusan</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <ul class="nav pull-right">
                                    <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Keluar</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
				<div class="page-title">
					<div class="title_left">
						<h3>Keputusan</h3>
					</div>
				</div>
				<div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel tile">
                            <div class="x_title">
                                <h2>Pembahagian Undi</h2>
								<form action="tukar-status.php" method="POST">
									<!-- JS refresh btn -->
									<button type="button" class="pull-right btn btn-primary" onclick='window.location.reload(true);'>Refresh</button>
									<!--submit form tukar status_pengundian -->
									<button type="submit" name="tutup" class="source pull-right btn btn-danger">Tutup Undi</button>	
									<?php if ($_SESSION['status_pengundian']==0): ?>
										<?php  echo "<p style='margin-top:.5%;' class='pull-left'>&nbsp;&nbsp;|&nbsp;Pengundian telah ditutup</p>";
											   echo "<button style='margin-left:-.5%;' type='submit' name='buka' class='pull-left btn btn-sm btn-link'>(Buka Semula)</button>";
										?>
									<?php endif;?>
								</form>
								 <div class="clearfix"></div>
                            </div>
                            <div class="x_content ">
								<?php
								//Display keputusan pengundian in bar chart
								while ($row=mysqli_fetch_array($result)){
									if($_SESSION['jum_undi'] != 0)
									{
										$peratus = $row['jumlah_undi']/$_SESSION['jum_undi']*100;
										$strPeratus = sprintf('%05.2f', round($peratus, 2));
									}
									else
										{$peratus = 0; $strPeratus = 0;}
									echo '<div class="widget_summary">';
									echo '    <div class="w_left w_55">';
									echo "        <span style='font-size:18px;'>".$row['nama_penuh']."</span>";
									echo '    </div>';
									echo '    <div class="w_center w_55">';
									echo '        <div class="progress">';
									echo "            <div class='progress-bar bg-green' role='progressbar' aria-valuenow='60' aria-valuemin='0' aria-valuemax='100' style='width: ".$peratus."%;'>";
									echo "                <span class='sr-only'>$peratus</span>";
									echo '            </div>';
									echo '        </div>';
									echo '    </div>';
									echo '    <div class="w_right w_20">';
									echo "        <span>".$row['jumlah_undi']." | $strPeratus%</span>";
									echo '    </div>';
									echo '    <div class="clearfix"></div>';
									echo '</div>';
								}
								echo "<br><br><h2 style='margin-right:.5%; font-size:2em;'class='pull-right'>JUMLAH UNDI: ".$_SESSION['jum_undi']."</h2>";
								?>
								<!-- echo errors in status_errors stack if any and unset once done -->
								<?php if (isset($_SESSION['status_errors'])): ?>
									<div class="form-errors">
										<?php foreach($_SESSION['status_errors'] as $error): ?>
											<?php echo "<script>alert('".$error."');</script>" ?>
										<?php echo "<br>"; endforeach; ?>
									</div>
								<?php unset($_SESSION['status_errors']); endif;?>
							
                            </div>
                        </div>
                    </div>
                </div>

                <!-- footer content -->

                <footer>
                    <div class="">
						<p class="text-center"> Penafian: Universiti Tun Hussein Onn Malaysia (UTHM) 
						adalah tidak bertanggungjawab bagi apa-apa kehilangan atau kerugian yang disebabkan oleh penggunaan mana-mana 
						maklumat yang diperolehi dari sistem ini.
						</p>
                        <p class="pull-right"> Hakcipta Terpelihara © 2016 |
                            <span class="lead"> <i class="fa fa-paw"></i> <a href="http://www.uthm.edu.my/v2/">UTHM</a></span>
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
            <!-- /page content -->

        </div>

    </div>

    <script src="js/bootstrap.min.js"></script>

    <!-- bootstrap progress js -->
    <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="js/nicescroll/jquery.nicescroll.min.js"></script>

    <script src="js/custom.js"></script>
    
	<script>
        $(document).ready(function () {
            $('.progress .bar').progressbar(); // bootstrap 2
            $('.progress .progress-bar').progressbar(); // bootstrap 3
        });
    </script>
    <!-- /footer content -->
</body>

</html>
