<html>
<head>
<script>
</script>
</head>
<body>

<?php

//include 'ftp.php';
$aufruf=$_GET['aufruf'];

if ($aufruf== TRUE){

	showdirectorycontent($ftp);
}

function showdirectorycontent($ftp){
 $size = $ftp->dirSize();
 echo $size;
 print_r($ftp);
 
 $items = $ftp->scanDir(false);
 //print_r ($items['file#/putty.zip']);
 global $dateien, $ordner;
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

#print_r ($dateien);
#print_r ($ordner);

#echo $ftp->pwd();


echo "<br>";
echo "<table>";
echo "<tr>";
echo "<th>Datei</th>";
echo "<th>Größe</th>";
echo "<th>Typ</th>";
echo "<th>Datum</th>";
echo "<th>Aktionen</th>";
echo "</tr>";

foreach ($dateien as $datei){

echo "<tr>";
echo "<td>$datei[name]</td>";
echo "<td>$datei[size]</td>";
echo "<td>Datei</td>";
echo "<td>$datei[day]. $datei[month]</td>";
echo "</tr>";
}

foreach ($ordners as $ordner){

echo "<tr>";
echo "<td><button type=\"button\" onclick=\"changedirectory();\">$ordner[name]</button></td>";
echo "<td></td>";
echo "<td>Ordner</td>";
echo "<td>$ordner[day]. $ordner[month]</td>";
echo "</tr>";
}
echo "</table>";
}

?>

</body>
</html>