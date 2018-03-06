<?php
$altername=$_GET['altername'];
$neuername=$_GET['neuername'];
 
 include(__DIR__.'/../lib/FtpClient.php');
 include(__DIR__.'/../lib/FtpException.php');
 include(__DIR__.'/../lib/FtpWrapper.php');
 
 session_start();
 $ftp = new \FtpClient\FtpClient();
 $ftp->connect($_SESSION['ip']);
 $ftp->login($_SESSION['user'], $_SESSION['pass']);
 
 $return = $ftp->rename($altername, $neuername);
 $ftp->close();
 
 if ($return == FALSE) {
  http_response_code(404);
 }

?>