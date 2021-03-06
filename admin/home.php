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
	$result = mysqli_query($conn, "SELECT jc.id, jp.nama_penuh FROM jcalon jc, uthm_smp.jpelajar jp WHERE jc.id_pelajar=jp.id")
	//or die(mysqli_error($conn));
	or die(" Tiada calon ditemui\n"); 
	//Query pelajar
	$result_pelajar = mysqli_query($conn, "SELECT jp.id FROM uthm_smp.jpelajar jp")
	or die(" Tiada pelajar ditemui\n"); 
	//Query jumlah pelajar sudah undi
	$result_sudah_undi = mysqli_query($conn, "SELECT jp.id FROM uthm_smp.jpelajar jp WHERE jp.status_undi=1")
	or die(" Tiada pengundi ditemui\n");
	//Query jumlah undi bagi semua calon
	$result_jum_undi = mysqli_query($conn, "SELECT SUM(jc.jumlah_undi) as total FROM jcalon jc")
	or die(" Tiada undi ditemui\n");

	$_SESSION['jum_calon'] = mysqli_num_rows($result);
	$_SESSION['jum_pelajar'] = mysqli_num_rows($result_pelajar);
	$_SESSION['jum_sudah_undi'] = mysqli_num_rows($result_sudah_undi);
	 
	$j_undi = mysqli_fetch_assoc($result_jum_undi);
	$_SESSION['jum_undi'] = $j_undi['total'];
	 
	$_SESSION['peratus_undi'] = $_SESSION['jum_sudah_undi']/$_SESSION['jum_pelajar']*100;
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

<body class="nav-md" >
    <div class="container body">
        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="home.php" class="site_title"> <span>UTHM</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <div class="profile">             
                            <span>&nbsp;&nbsp;&nbsp;SISTEM PENCALONAN MPP</span>
                    </div>
                    <br/>
					
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

                <!-- top tiles -->
                <div class="row tile_count">
                    <div class="animated flipInY col-md-2 col-sm-2 col-xs-6 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-users"></i> Calon </span>
                            <div class="count"><?php echo $_SESSION['jum_calon'] ?></div>
                        </div>
                    </div>
                    <div class="animated flipInY col-md-2 col-sm-2 col-xs-6 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-users"></i> Pelajar</span>
                            <div class="count"><?php echo $_SESSION['jum_pelajar'] ?></div>
                        </div>
                    </div>
					<div class="animated flipInY col-md-2 col-sm-2 col-xs-6 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-users"></i> Pengundi</span>
                            <div class="count"><?php echo $_SESSION['jum_sudah_undi'] ?></div>
                        </div>
                    </div>
					<div class="animated flipInY col-md-2 col-sm-2 col-xs-6 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-check"></i> Undi</span>
                            <div class="count"><?php echo $_SESSION['jum_undi'] ?></div>
                        </div>
                    </div>
                    <div class="animated flipInY col-md-2 col-sm-2 col-xs-12 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-check  "></i> Peratus Undian</span>
                            <div class="count"><?php echo sprintf('%0.2f', $_SESSION['peratus_undi']); ?>%</div>
                        </div>
                    </div>
                </div>
                <!-- /top tiles -->

                <div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="dashboard_graph">
                            <div class="x_title">
                                <h2></h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="bs-example" data-example-id="simple-jumbotron">
                                    <div class="jumbotron">
                                        <h1>Laman Pentadbir</h1>
                                        <p style="font-size:24px;">Sistem Pencalonan MPP UTHM</p>
                                    </div>
                                </div>
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
    <!-- /footer content -->
</body>

</html>