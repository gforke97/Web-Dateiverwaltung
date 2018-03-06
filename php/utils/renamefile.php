<?php
$altername=$_GET['altername'];
$neuername=$_GET['neuername'];
 
 include('createconnection.php');
 
 if (($ftp->rename($altername, $neuername)) == FALSE) {
  http_response_code(404);
 }
 
  $ftp->close();

?>