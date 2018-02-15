<?php

 include 'lib/FtpClient.php';
 include 'lib/FtpException.php';
 include 'lib/FtpWrapper.php';
 print "Hello World!";
 $ftp = new \FtpClient\FtpClient();
 $ftp->connect('192.168.0.16');
 $ftp->login('test', 'test');

$dateien=array();
$ordner=array();

function ordnerscan($ftp){
 $items = $ftp->scanDir(false);
 //print_r ($items['file#/putty.zip']);
 global $dateien, $ordner;
 //global $ordner = array();

foreach($items as $dateiordner){
	print_r ($dateiordner['type']);
	if ($dateiordner['type'] == "file"){
	//print_r ($dateiordner);
	$dateien[] = $dateiordner;
	}
	if ($dateiordner['type'] == "directory"){
        //print_r ($dateiordner);
	$ordner[] = $dateiordner;
	}
}

print_r ($dateien);
print_r ($ordner);


}




ordnerscan($ftp);

echo $ftp->pwd();


echo "<br>";
echo "<table>";
echo "<tr>";
echo "<th>Datei</th>";
echo "<th>Datum</th>";
echo "<th>Größe</th>";
echo "<th>Aktionen</th>";
echo "</tr>";
foreach ($dateien as $datei){

echo $datei['name'];
echo "<br>";
//echo "Hallo";

echo "<tr>";
echo "<td>$datei[name]</td>";
echo "<td>$datei[day]. $datei[month]</td>";
echo "<td>$datei[size]</td>";
echo "</tr>";


}
echo "</table>";
?>
