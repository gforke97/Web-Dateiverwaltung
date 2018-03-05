<?php
	
 include(__DIR__.'/../lib/FtpClient.php');
 include(__DIR__.'/../lib/FtpException.php');
 include(__DIR__.'/../lib/FtpWrapper.php');
 
 session_start();
 $ftp = new \FtpClient\FtpClient();
 $ftp->connect($_SESSION['ip']);
 $ftp->login($_SESSION['user'], $_SESSION['pass']);
 
 $ftp->chdir($_SESSION['aktordner']);
 $aktordner = $_SESSION['aktordner'];
  
 $items = $ftp->scanDir(false);
 
 $ftp->close();
 
 //print_r ($items['file#/putty.zip']);
 global $dateien, $ordners;
 //global $ordner = array();

foreach($items as $dateiordner){
	#print_r ($dateiordner['type']);
	if ($dateiordner['type'] == "file"){
	//print_r ($dateiordner);
	$dateien[] = $dateiordner;
	}
	if ($dateiordner['type'] == "directory"){
        //print_r ($dateiordner);
	$ordners[] = $dateiordner;
	}
}

echo "<br>";
echo "<table>";
echo "<tr>";
echo "<th>Datei</th>";
echo "<th>Größe</th>";
echo "<th>Typ</th>";
echo "<th>Datum</th>";
echo "<th>Aktionen</th>";
echo "</tr>";

echo "<tr>";
echo "<td><button type=\"button\" onclick=\"changedirectory('..');\">..</button></td>";
echo "</tr>";

foreach ($ordners as $ordner){
echo "<tr>";
echo "<td><button type=\"button\" onclick=\"changedirectory('$ordner[name]');\">$ordner[name]</button></td>";
echo "<td></td>";
echo "<td>Ordner</td>";
echo "<td>$ordner[day]. $ordner[month]</td>";
if ($aktordner != '') {
	$aktordner = $aktordner . '/';
}
$vollerpfad = $aktordner . $ordner[name];
echo "<td><button type=\"button\" onclick=\"deletedirectory('$vollerpfad');\">Löschen</button></td>";
echo "</tr>";
}

foreach ($dateien as $datei){
$vollerpfad = $aktordner . DIRECTORY_SEPARATOR . $datei[name];
echo "<tr>";
echo "<td><button type=\"button\" onclick=\"downloadfile('$datei[name]');\">$datei[name]</button></td>";
echo "<td>$datei[size]</td>";
echo "<td>Datei</td>";
echo "<td>$datei[day]. $datei[month]</td>";
echo "<td><button type=\"button\" onclick=\"deletefile('$vollerpfad');\">Löschen</button></td>";
echo "</tr>";
}

echo "</table>";

?>
