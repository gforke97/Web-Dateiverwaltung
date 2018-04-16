<<<<<<< HEAD
<?php
 //Dateinamen im Temp-Verzeichnis (automatisch von PHP generiert)
 $dateientmpname = $_FILES['dateien']['tmp_name'];
 //Dateinamen der vom Nutzer hochgeladenen Dateien
 $dateienrealname = $_FILES['dateien']['name'];
 
 include('createconnection.php');
 
 $ftp->chdir($_SESSION['aktordner']);
 
 //Ordnet im FTP-Upload einem Dateinamen im Tmp-Verzeichnis den korrekten 
 //(vom Nutzer übergebenen) Dateinamen zu.
 for ($i = 0; $i < count($dateientmpname); $i++) {
	$upload = $ftp->put($dateienrealname[$i], $dateientmpname[$i], FTP_BINARY );
 }
  
 $ftp->close();
 
=======
<?php
	$session=$_GET['session'];
	//Dateinamen im Temp-Verzeichnis (automatisch von PHP generiert)
	$dateientmpname = $_FILES['dateien']['tmp_name'];
	//Dateinamen der vom Nutzer hochgeladenen Dateien
	$dateienrealname = $_FILES['dateien']['name'];
	
	include('createconnection.php');
	
	switch($session) {
		case 1:
		$ftp->chdir($_SESSION['aktordner1']);
		break;
		
		case 2:
		$ftp->chdir($_SESSION['aktordner2']);
		break;
		
		default:
		http_response_code(404);
		exit(1);
	}
	
	
	//Ordnet im FTP-Upload einem Dateinamen im Tmp-Verzeichnis den korrekten 
	//(vom Nutzer übergebenen) Dateinamen zu.
	for ($i = 0; $i < count($dateientmpname); $i++) {
		$upload = $ftp->put($dateienrealname[$i], $dateientmpname[$i], FTP_BINARY );
	}
	
	$ftp->close();
	
>>>>>>> pr/4
?>