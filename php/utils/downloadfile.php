<?php
//kompletter Pfad
$datei=$_GET['datei'];
 
 include('createconnection.php');
 
 $ftp->chdir($_SESSION['aktordner']);
 
 $downloadpfad = DIRECTORY_SEPARATOR . "tmp" . DIRECTORY_SEPARATOR . $datei;
 
 $ftp->get($downloadpfad, $datei, 2);
 
  $ftp->close();
  
  if (file_exists($downloadpfad)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($downloadpfad).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($downloadpfad));
    readfile($downloadpfad);
    exit;
  }
  else {
  http_response_code(404);
  }
 
?>
