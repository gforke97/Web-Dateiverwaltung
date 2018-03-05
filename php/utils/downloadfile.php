<html>
<head>
<script>
</script>
</head>
<body>

<?php
//kompletter Pfad
$ordnerdatei=$_GET['ordnerdatei'];
 
 include(__DIR__.'/../lib/FtpClient.php');
 include(__DIR__.'/../lib/FtpException.php');
 include(__DIR__.'/../lib/FtpWrapper.php');
 
 session_start();
 $ftp = new \FtpClient\FtpClient();
 $ftp->connect($_SESSION['ip']);
 $ftp->login($_SESSION['user'], $_SESSION['pass']);
 
 //$ftp->get("/tmp/test.zip", "putty.zip", 2);
 
  $ftp->close();
 
?>

</body>
</html>