<html>
<head>
<script>
</script>
</head>
<body>

<?php
$ordner=$_GET['ordner'];
 
 include(__DIR__.'/../lib/FtpClient.php');
 include(__DIR__.'/../lib/FtpException.php');
 include(__DIR__.'/../lib/FtpWrapper.php');
 
 session_start();
 $ftp = new \FtpClient\FtpClient();
 $ftp->connect($_SESSION['ip']);
 $ftp->login($_SESSION['user'], $_SESSION['pass']);
 
 $ftp->chdir($_SESSION['aktordner']);
 
 if ($ordner=="..") {
   $ftp->cdup(); 
 }
 else {
 $ftp->chdir($ordner);
 }
  
 $_SESSION['aktordner'] = $ftp->pwd();
 
  $ftp->close();
 
?>

</body>
</html>