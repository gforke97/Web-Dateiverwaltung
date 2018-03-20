<?php
	include_once(__DIR__.'/../lib/FtpClient.php');
	include_once(__DIR__.'/../lib/FtpException.php');
	include_once(__DIR__.'/../lib/FtpWrapper.php');
	
	session_start();
	
	switch($session) {
		case 1:
		$ftp = new \FtpClient\FtpClient();
		
		if (($ftp->connect($_SESSION['ip1'], false, 21, 5)) == FALSE) {
			http_response_code(404);
			exit(1);
		}
		
		if (($ftp->login($_SESSION['user1'], $_SESSION['pass1'])) == FALSE) {
			http_response_code(404);
			exit(1);
		}
		
		break;
		
		case 2:
		$ftp = new \FtpClient\FtpClient();
		
		if (($ftp->connect($_SESSION['ip2'], false, 21, 5)) == FALSE) {
			http_response_code(404);
			exit(1);
		}
		
		if (($ftp->login($_SESSION['user2'], $_SESSION['pass2'])) == FALSE) {
			http_response_code(404);
			exit(1);
		}
		break;
	}
	
?>