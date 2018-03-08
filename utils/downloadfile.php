<<<<<<< HEAD:php/utils/downloadfile.php
<?php
//kompletter Pfad
$datei=$_GET['datei'];
 
 include(__DIR__.'/../lib/FtpClient.php');
 include(__DIR__.'/../lib/FtpException.php');
 include(__DIR__.'/../lib/FtpWrapper.php');
 
 session_start();
 $ftp = new \FtpClient\FtpClient();
 $ftp->connect($_SESSION['ip']);
 $ftp->login($_SESSION['user'], $_SESSION['pass']);
 
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
 
?>
=======
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
>>>>>>> pr/3:utils/downloadfile.php
