<?php
$vollerpfad=$_GET['vollerpfad'];
 
 include('createconnection.php');
 
 $ftp->delete($vollerpfad);
 
 $ftp->close();
 
?>
