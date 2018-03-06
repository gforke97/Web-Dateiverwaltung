<?php
$ordner=$_GET['ordner'];
 
 include('createconnection.php');
 
 $ftp->chdir($_SESSION['aktordner']);
 
 if ($ordner=="..") {
   $ftp->cdup(); 
 }
 else {
 $ftp->chdir($ordner);
 }
  
 $_SESSION['aktordner'] = $ftp->pwd();
 
  $ftp->close();
 
?>
