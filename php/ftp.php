 <?php
 include 'lib/FtpClient.php';
 include 'lib/FtpException.php';
 include 'lib/FtpWrapper.php';
 $ftp = new \FtpClient\FtpClient();
 $ftp->connect('192.168.0.16');
 $ftp->login('test', 'test');

 ?>