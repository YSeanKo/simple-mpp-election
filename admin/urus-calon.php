<?php
	include("db/dbc.php");
	session_start();
	//If your session isn't valid, it returns you to the login screen for protection
	if(empty($_SESSION['id_pentadbir'])){
	 header("location:access-denied.php");
	}
	if(!isset($_SESSION['search_found']))
		$_SESSION['search_found'] = 0;
?>

<?php 
	$result = mysqli_query($conn, "SELECT jc.id as id_calon, jp.nama_penuh, jp.no_matrik, jp.no_kp, jk.nama_penuh as nama_kursus, js.nama as batch
			  FROM jcalon jc, jpelajar jp, jkursus jk, jsesi js WHERE jc.id_pelajar=jp.id AND jp.id_kursus=jk.id AND jp.id_sesi = js.id"); 
			  
	$_SESSION['jum_calon'] = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistem Pencalonan MPP ILP Ledang</title>

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
                        <a href="home.php" class="site_title"> <span>ILP LEDANG</span></a>
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
									<a  href="urus-batch.php"><i class="fa fa-user"></i> Urus Pelajar</span></a>
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
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Urus Calon</h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="clearfix"></div>
                        <!-- Form tambah calon -->
						<div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Tambah Calon</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <form class="form-horizontal form-label-left" action="search.php" method="POST">

                                        <div class="form-group">

                                            <div class="col-sm-9">
												 
                                                <div class="input-group">
                                                    <input type="text" name="key" placeholder="No. Kad Pelajar" autofocus class="form-control">
                                                    <span class="input-group-btn">
														<input type="submit" value="Cari!" name="submit" class="btn btn-primary"> 
													</span>
                                                </div>
												<!-- Display errors in search_errors stack if any and unset once done -->
												<?php if (isset($_SESSION['search_errors'])): ?>
												<div class="form-errors">
													<?php foreach($_SESSION['search_errors'] as $error): ?>
														<p><?php echo $error ?></p>
													<?php endforeach; ?>
												</div>
												<?php unset($_SESSION['search_errors']); endif;?>
                                            </div>		
											
											
                                        </div>
                                       
                                    </form>
	                                <!-- If pelajar found, display form to calonkan pelajar, with details-->
									<?php if ($_SESSION['search_found'] == 1): ?>
										<?php
										echo "<script>";
										echo "	function confirm() {";
										echo "		return confirm('Calonkan pelajar ini?');";
										echo "	}";
										echo "</script>";									
										echo "<form onsubmit='confirm();' class='form-horizontal form-label-left' action='tambahcalon.php' method='POST'>";
										echo "<input type='hidden' name='addkey' value='".$_SESSION['qid']."'/>";
											echo "<table class='table table-bordered'>";
											echo "  <thead>";
											echo "      <tr>";
											echo "          <th>Nama Penuh</th>";
											echo "          <th>No. K/P.</th>";
											echo "            <th>Kursus</th>";
											echo "			<th></th>";
											echo "        </tr>";
											echo "    </thead>";
											echo "    <tbody>";
											echo "        <tr>";
											echo "            <th scope='row'>".$_SESSION['qnama_penuh']."</th>";
											echo "            <td>".$_SESSION['qno_kp']."</td>";
											echo "            <td>".$_SESSION['qjabatan']."</td>";
											echo "			<td><input style='margin-top:-3%' name='tambah' type='submit' value='Tambah' class='btn btn-default btn-xs'></input></td>";
											echo "        </tr>";
											echo "    </tbody>";
											echo "</table>";
										echo " </form>";
										?>
									<?php $_SESSION['search_found']=0; endif;?>
									
									<!-- Display errors in add_errors stack if any and unset once done -->
												
									<?php if (isset($_SESSION['add_errors'])): ?>
										<div class="form-errors">
											<?php foreach($_SESSION['add_errors'] as $error): ?>
												<p><?php echo $error ?></p>
											<?php endforeach; ?>
										</div>
									<?php unset($_SESSION['add_errors']); endif;?>
									
                                </div>
                            </div>
                        </div>
						
						<!-- Display list of all calon in table -->
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Senarai Calon</h2>
								<form action="resetcalon.php" method="POST" onsubmit="return confirm('Teruskan dengan reset calon?');">
									<!--submit form buang semua calon -->
									<button type="submit" name="creset" class="source pull-right btn btn-danger">Reset Calon</button>	
									<?php if (isset($_SESSION['creset_errors'])): ?>
										<div class="form-errors">
											<?php foreach($_SESSION['creset_errors'] as $error): ?>
												<p style='margin-top:.5%;'>&nbsp;&nbsp;|&nbsp;<?php echo $error ?></p>
											<?php endforeach; ?>
										</div>
									<?php unset($_SESSION['creset_errors']); endif;?>
								</form>
                                    <div class="clearfix"></div>
                                </div>
								<!-- Display errors in del_errors stack if any and unset once done -->	
                                <div class="x_content">
									<?php if (isset($_SESSION['del_errors'])): ?>
										<div class="form-errors">
											<?php foreach($_SESSION['del_errors'] as $error): ?>
												<p><?php echo $error ?></p>
											<?php endforeach; ?>
										</div>
									<?php unset($_SESSION['del_errors']); endif;?>
									
                                    <table style="max-width:none;table-layout:fixed; word-wrap: break-word;" class="table table-striped responsive-utilities jambo_table bulk_action">
                                        <thead>
                                            <tr class="headings">
                                                <th class="column-title">#</th>
                                                <th class="column-title">Nama Penuh </th>
                                                <th class="column-title">No. Kad Pelajar </th>
                                                <th class="column-title">No. K/p </th>
                                                <th class="column-title">Kursus </th>
												<th class="column-title">Batch </th>
                                                <th class="column-title no-link last"><span class="nobr">Urus</span>
                                                </th>
											</tr>
										</thead>

										<tbody>
										<?php
										$temp = 1;
										while ($row=mysqli_fetch_array($result)){
											echo "<form class='form-horizontal form-label-left' action='buangcalon.php' method='POST'>";
											echo "<input type='hidden' name='delkey' value='".$row['id_calon']."'/>";
											echo "<tr class='even pointer'>";
											echo "	<td class='a-center '>".$temp."</td>";
											echo "	<td class=' '>".$row['nama_penuh']."</td>";
											echo "	<td class=' '>".$row['no_matrik']." </td>";
											echo "	<td class=' '>".$row['no_kp']."</td>";
											echo "	<td class=' '>".$row['nama_kursus']."</td>";
											echo "	<td class=' '>".$row['batch']."</td>";
											echo "	<td class=' last'><input class='btn btn-link btn-xs' type='submit' name='buang' value='Delete' style='color:red; margin-top:-3%'/></td>";
                                            echo "</tr>";
											echo "</form>";
											$temp++;
										}
										?>
										</tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- footer content -->

                <footer>
                    <div class="">
						<p class="text-center"> Penafian: Institut Latihan Perindustrian Ledang (ILP Ledang) 
						adalah tidak bertanggungjawab bagi apa-apa kehilangan atau kerugian yang disebabkan oleh penggunaan mana-mana 
						maklumat yang diperolehi dari sistem ini.
						</p>
                        <p class="pull-right"> Hakcipta Terpelihara © 2016 |
                            <span class="lead"> <i class="fa fa-paw"></i> <a href="http://www.ilpledang.gov.my/v5/index.php/en/">ILP LEDANG</a></span>
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

    <script src="js/custom.js"></script>

</body>

</html>