<?php
	include("admin/db/dbc.php");
	session_start();
	//If your session isn't valid, it returns you to the login screen for protection
	if(empty($_SESSION['id_pengguna'])){
	 header("location:access-denied.php");
	}

	$totalVoted = 0;
	$votedCandidate = array();
	//server-side validation to determine which calon has a vote. Store all 6 voted calon in array
	if(!empty($_POST['voted'])) {
		foreach($_POST['voted'] as $check) {
			$votedCandidate[$totalVoted] = $check;
			$totalVoted++;
		}
	 }
	 else
		  echo "<script>alert('noneVoted'); </script>"; 
	
	//Query update jumlah undi for voted calon
	for($i=0; $i < $totalVoted; $i++){
		mysqli_query($conn, "UPDATE jcalon SET jumlah_undi=jumlah_undi+1 WHERE id='$votedCandidate[$i]'");
	}
	//Query update status_undi for logged in user
	$id_pengguna = $_SESSION['id_pengguna'];
	mysqli_query($conn, "UPDATE jpelajar SET status_undi=1 WHERE id='$id_pengguna'");

	header("Location: success.php", true, 301);
	exit();

	//Debug code
	/*while ($row=mysql_fetch_array($result)){
		for($i=0; $i < $totalVoted; $i++){
			if($row['id'] == $votedCandidate[$i]){
				echo "<script>alert('".$row['id']."'); </script>";
			}
		}
	}*/
	/*
	foreach($votedCandidate as $candidate) 
		mysql_query("UPDATE jcalon SET jumlah_undi=jumlah_undi+1 WHERE id='$candidate'");*/
?>
