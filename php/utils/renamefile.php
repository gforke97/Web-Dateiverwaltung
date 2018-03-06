<?php
$altername=$_GET['altername'];
$neuername=$_GET['neuername'];
 
 include('createconnection.php');
 
 $aktordner = $_SESSION['aktordner'];
 $volleralterpfad = $aktordner . DIRECTORY_SEPARATOR . $altername;
 $vollerneuerpfad = $aktordner . DIRECTORY_SEPARATOR . $neuername;
 print"$volleralterpfad";
 print"$vollerneuerpfad";
 
 if (($ftp->rename($volleralterpfad, $vollerneuerpfad)) == FALSE) {
  http_response_code(404);
 }
 
  $ftp->close();

?>