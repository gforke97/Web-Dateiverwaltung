<<<<<<< HEAD
<?php
$vollerpfad=$_GET['vollerpfad'];
 
 include('createconnection.php');

 if (($ftp->rmdir($vollerpfad, true)) == FALSE) {
 http_response_code(404);
 }

 $ftp->close();
 
?>

=======
<?php
	$session=$_GET['session'];
	$vollerpfad=$_GET['vollerpfad'];
	
	include('createconnection.php');
	
	if (($ftp->rmdir($vollerpfad, true)) == FALSE) {
		http_response_code(404);
	}
	
	$ftp->close();
	
?>

>>>>>>> pr/4
