<?php
	$session=$_GET['session'];
	$ordner=$_GET['ordner'];
	
	include('createconnection.php');
	
	switch($session) {
		case 1:
		$ftp->chdir($_SESSION['aktordner1']);
		break;
		
		case 2:
		$ftp->chdir($_SESSION['aktordner2']);
		break;
		
		default:
		http_response_code(404);
		exit(1);
	}
	
	if ($ordner=="..") {
		if (($ftp->cdup()) == FALSE) {
			http_response_code(404);
		}
	}
	else {
		if (($ftp->chdir($ordner)) == FALSE) {
			http_response_code(404);
		}
	}
	
	switch($session) {
		case 1:
		$_SESSION['aktordner1'] = $ftp->pwd();
		break;
		
	case 2:
	$_SESSION['aktordner2'] = $ftp->pwd();
	break;
	
	default:
	http_response_code(404);
	exit(1);
	}
	
	$ftp->close();
	
	?>
		