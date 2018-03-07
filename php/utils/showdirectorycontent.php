<html>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Datei</th>
								<th>Größe</th>
								<th>Typ</th>
								<th>Datum</th>
								<th>Aktionen</th>
							</tr>
						</thead>

						<tbody>
							<tr>
								<td>
									<button class="btn" type="button" onclick="changedirectory('..');">..</button>
								</td>
							</tr>

<?php

include('createconnection.php');

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
echo "<td><button class=\"btn btn-link\" type=\"button\" onclick=\"changedirectory('$ordner[name]');\">$ordner[name]</button></td>";
echo "<td></td>";
echo "<td>Ordner</td>";
echo "<td>$ordner[day]. $ordner[month]</td>";
$vollerpfad = $aktordner . DIRECTORY_SEPARATOR . $ordner[name] . DIRECTORY_SEPARATOR;
echo "<td><button class=\"btn\" type=\"button\" onclick=\"deletedirectory('$vollerpfad');\">Löschen <img class=\"img\" src=\"/img/trashbin.png\ alt=\"Trash Bin\"></button>";
echo "<button class=\"btn\" type=\"button\" onclick=\"renamefile('$ordner[name]');\">Umbenennen</button></td>";
echo "</tr>";
}

foreach ($dateien as $datei){
$vollerpfad = $aktordner . DIRECTORY_SEPARATOR . $datei[name];
echo "<tr id=\"tr_directory\">";
echo "<td><button class=\"btn btn-link\" type=\"button\" onclick=\"downloadfile('$datei[name]');\">$datei[name]</button></td>";
$dateigroesse = humanfilesize($datei[size]);
echo "<td>$dateigroesse</td>";
echo "<td>Datei</td>";
echo "<td>$datei[day]. $datei[month]</td>";
echo "<td><button class=\"btn\" type=\"button\" onclick=\"deletefile('$vollerpfad');\">Löschen</button>";
echo "<button class=\"btn\" type=\"button\" onclick=\"renamefile('$datei[name]');\">Umbenennen</button></td>";
echo "</tr>";
}

echo "</tbody>";

echo "</table>";

//Danke an: http://jeffreysambells.com/2012/10/25/human-readable-filesize-php
function humanfilesize($bytes, $decimals = 2) {
    $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
}

?>

				</div>

			</div>

		</div>

	</body>

</html>
