<?php
	$session=$_GET['session'];
	$server=$_POST['server'];
	$user=$_POST['nutzer'];
	$password=$_POST['passwort'];
	
	include(__DIR__.'/../lib/FtpClient.php');
	include(__DIR__.'/../lib/FtpException.php');
	include(__DIR__.'/../lib/FtpWrapper.php');
	
	session_start();
	
	switch($session) {
		case 1:
		$_SESSION['ip1'] = $server;
		$_SESSION['user1'] = $user;
		$_SESSION['pass1'] = $password;
		$_SESSION['aktordner1'] = "";
		break;
		
		case 2:
		$_SESSION['ip2'] = $server;
		$_SESSION['user2'] = $user;
		$_SESSION['pass2'] = $password;
		$_SESSION['aktordner2'] = "";
		break;
	}
?>