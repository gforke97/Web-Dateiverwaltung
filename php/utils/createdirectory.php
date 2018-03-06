<?php
$ordnername=$_POST['ordnername'];
 
 include('createconnection.php');
 include('nameisvalid.php');

 $aktordner = $_SESSION['aktordner'];
 $vollerpfad = $aktordner . DIRECTORY_SEPARATOR . $ordnername;
 
 if ((!isValid($ordnername))||(($ftp->mkdir($vollerpfad)) == FALSE)) {
 http_response_code(404);
 }

 $ftp->close();
 
?>