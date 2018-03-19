<?php
 include(__DIR__.'/../lib/FtpClient.php');
 include(__DIR__.'/../lib/FtpException.php');
 include(__DIR__.'/../lib/FtpWrapper.php');
 
 session_start();
 
   switch($session) {
	case 1:
		$ftp = new \FtpClient\FtpClient();
		$ftp->connect($_SESSION['ip1']);
		$ftp->login($_SESSION['user1'], $_SESSION['pass1']); 
		break;
	
	case 2:
		$ftp = new \FtpClient\FtpClient();
		$ftp->connect($_SESSION['ip2']);
		$ftp->login($_SESSION['user2'], $_SESSION['pass2']); 
		break;
 }
 
?>