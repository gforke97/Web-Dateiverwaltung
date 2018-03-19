<?php
$session=$_GET['session'];
$altername=$_GET['altername'];
$neuername=$_GET['neuername'];
 
 include('createconnection.php');
 include('nameisvalid.php');
 
   switch($session) {
	case 1:
		$aktordner = $_SESSION['aktordner1'];
		break;
	
	case 2:
		$aktordner = $_SESSION['aktordner2'];
		break;
		
	default:
		http_response_code(404);
		exit(1);
 }
 
 $volleralterpfad = $aktordner . DIRECTORY_SEPARATOR . $altername;
 $vollerneuerpfad = $aktordner . DIRECTORY_SEPARATOR . $neuername;
 
 if ((!isValid($neuername))||(($ftp->rename($volleralterpfad, $vollerneuerpfad)) == FALSE)) {
  http_response_code(404);
 }
 
  $ftp->close();

?>