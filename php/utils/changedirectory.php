<?php
$ordner=$_GET['ordner'];
 
 include('createconnection.php');
 
 $ftp->chdir($_SESSION['aktordner']);
 
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
  
 $_SESSION['aktordner'] = $ftp->pwd();
 
 $ftp->close();
 
?>
