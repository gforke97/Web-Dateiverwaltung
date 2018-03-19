<?php
	$session=$_GET['session'];
	$vollerpfad=$_GET['vollerpfad'];
	
	include('createconnection.php');
	
	if (($ftp->delete($vollerpfad)) == FALSE) {
		http_response_code(404);
	} 
	
	$ftp->close();
	
?>
