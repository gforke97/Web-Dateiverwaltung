<?php
	$session=$_GET['session'];
	$datei=$_GET['datei'];
	
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
	
	$downloadpfad = DIRECTORY_SEPARATOR . "tmp" . DIRECTORY_SEPARATOR . $datei;
	
	if (($ftp->get($downloadpfad, $datei, 2)) == FALSE) {
		http_response_code(404);
	}
	else {
		//Do nothing.
	}
	
	$ftp->close();
	
	if (file_exists($downloadpfad)) {
		switch($session) {
			case 1:
			//Prepares the connection to the OTHER server.
			//File should be transferred to it.
			$session = 2;
			include('createconnection.php');
			$ftp->chdir($_SESSION['aktordner2']);
			
			if (($ftp->put($datei, $downloadpfad, 2)) == FALSE) {
				http_response_code(404);
			}
			else {
				//Do nothing.
			}
			$ftp->close();
			
			break;
			
			case 2:
			//Prepares the connection to the OTHER server.
			//File should be transferred to it.
			$session = 1;
			include('createconnection.php');
			$ftp->chdir($_SESSION['aktordner1']);
			
			if (($ftp->put($datei, $downloadpfad, 2)) == FALSE) {
				http_response_code(404);
			}
			else {
				//Do nothing.
			}
			$ftp->close();
			
			break;
		}
	}
	else {
		http_response_code(404);
	}
	
?>
