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
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'.basename($downloadpfad).'"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($downloadpfad));
		readfile($downloadpfad);
		exit;
	}
	else {
		http_response_code(404);
	}
	
?>
