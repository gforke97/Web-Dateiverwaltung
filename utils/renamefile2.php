<?php
$altername=$_GET['altername'];
$neuername=$_GET['neuername'];
 
 include('createconnection.php');
 include('nameisvalid.php');
 
 $aktordner = $_SESSION['aktordner2'];
 $volleralterpfad = $aktordner . DIRECTORY_SEPARATOR . $altername;
 $vollerneuerpfad = $aktordner . DIRECTORY_SEPARATOR . $neuername;
 
 if ((!isValid($neuername))||(($ftp->rename($volleralterpfad, $vollerneuerpfad)) == FALSE)) {
  http_response_code(404);
 }
 
  $ftp->close();

?>