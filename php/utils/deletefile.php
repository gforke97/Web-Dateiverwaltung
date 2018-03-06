<?php
$vollerpfad=$_GET['vollerpfad'];
 
 include(__DIR__.'/../lib/FtpClient.php');
 include(__DIR__.'/../lib/FtpException.php');
 include(__DIR__.'/../lib/FtpWrapper.php');
 
 session_start();
 $ftp = new \FtpClient\FtpClient();
 $ftp->connect($_SESSION['ip']);
 $ftp->login($_SESSION['user'], $_SESSION['pass']);
 
 $ftp->delete($vollerpfad);
 
 $ftp->close();
 
?>
