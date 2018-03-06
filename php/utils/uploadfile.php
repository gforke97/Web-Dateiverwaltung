<?php
 //Dateinamen im Temp-Verzeichnis (automatisch von PHP generiert)
 $dateientmpname = $_FILES['dateien']['tmp_name'];
 //Dateinamen der vom Nutzer hochgeladenen Dateien
 $dateienrealname = $_FILES['dateien']['name'];
 
 include(__DIR__.'/../lib/FtpClient.php');
 include(__DIR__.'/../lib/FtpException.php');
 include(__DIR__.'/../lib/FtpWrapper.php');
 
 session_start();
 $ftp = new \FtpClient\FtpClient();
 $ftp->connect($_SESSION['ip']);
 $ftp->login($_SESSION['user'], $_SESSION['pass']);
 
 $ftp->chdir($_SESSION['aktordner']);
 
 //Ordnet im FTP-Upload einem Dateinamen im Tmp-Verzeichnis den korrekten 
 //(vom Nutzer übergebenen) Dateinamen zu.
 for ($i = 0; $i < count($dateientmpname); $i++) {
	$upload = $ftp->put($dateienrealname[$i], $dateientmpname[$i], FTP_BINARY );
 }
  
 $ftp->close();
 
?>