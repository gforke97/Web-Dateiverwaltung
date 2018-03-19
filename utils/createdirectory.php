<?php
	$session=$_GET['session'];
	$ordnername=$_GET['ordnername'];
	
	include('createconnection.php');
	include('nameisvalid.php');
	
	switch($session) {
		case 1:
		$aktordner = $_SESSION['aktordner1'];
		break;
		
		case 2:
		$aktordner = $_SESSION['aktordner2'];
		break;
		
		default:
		http_response_code(404);
		exit(1);
	}
	
	$vollerpfad = $aktordner . DIRECTORY_SEPARATOR . $ordnername;
	
	if ((!isValid($ordnername))||(($ftp->mkdir($vollerpfad)) == FALSE)) {
		http_response_code(404);
	}
	
	$ftp->close();
	
?>