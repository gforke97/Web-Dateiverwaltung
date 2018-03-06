<?php
$vollerpfad=$_GET['vollerpfad'];
 
 include('createconnection.php');

 $ftp->rmdir($vollerpfad, true);

 $ftp->close();
 
?>

