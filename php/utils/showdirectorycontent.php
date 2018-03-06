<html>
<body>
<br>
<table>
<tr>
<th>Datei</th>
<th>Größe</th>
<th>Typ</th>
<th>Datum</th>
<th>Aktionen</th>
</tr>

<tr>
<td><button type="button" onclick="changedirectory('..');">..</button></td>
</tr>

</body>
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

foreach ($ordners as $ordner){
echo "<tr>";
echo "<td><button type=\"button\" onclick=\"changedirectory('$ordner[name]');\">$ordner[name]</button></td>";
echo "<td></td>";
echo "<td>Ordner</td>";
echo "<td>$ordner[day]. $ordner[month]</td>";
if ($aktordner == '') {
	$vollerpfad = $ordner[name] . DIRECTORY_SEPARATOR;
}
else {
	$vollerpfad = $aktordner . DIRECTORY_SEPARATOR . $ordner[name] . DIRECTORY_SEPARATOR;
}
echo "<td><button type=\"button\" onclick=\"deletedirectory('$vollerpfad');\">$vollerpfad</button></td>";
echo "</tr>";
}

foreach ($dateien as $datei){
$vollerpfad = $aktordner . DIRECTORY_SEPARATOR . $datei[name];
echo "<tr>";
echo "<td><button type=\"button\" onclick=\"downloadfile('$datei[name]');\">$datei[name]</button></td>";
$dateigroesse = humanfilesize($datei[size]);
echo "<td>$dateigroesse</td>";
echo "<td>Datei</td>";
echo "<td>$datei[day]. $datei[month]</td>";
echo "<td><button type=\"button\" onclick=\"deletefile('$vollerpfad');\">Löschen</button></td>";
echo "</tr>";
}

echo "</table>";

//Danke an: http://jeffreysambells.com/2012/10/25/human-readable-filesize-php
function humanfilesize($bytes, $decimals = 2) {
    $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
}

?>
</html>
