<?php
$ordner=$_GET['ordner'];
 
 include('createconnection.php');
 
 $ftp->chdir($_SESSION['aktordner2']);
 
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
  
 $_SESSION['aktordner2'] = $ftp->pwd();
 
 $ftp->close();
 
?>
