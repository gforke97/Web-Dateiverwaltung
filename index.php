<html>

  <head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">

    <!--Bootstrap Framework-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!--Main CSS-->
    <link rel="stylesheet" type="text/css" href="main.css">

	<script>
	function showfiles(session) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("fileslist"+session).innerHTML = this.responseText;
        }
    };
    var url = "utils/showdirectorycontent.php?session=" + session;
	xmlhttp.open("GET", url, false);
    xmlhttp.send();
	}


	function changedirectory(session, str) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp = new XMLHttpRequest();
		
	var url = "utils/changedirectory.php?session=" + session + "&ordner=" + str;
	xmlhttp.open("GET",url, false);
    xmlhttp.send();

	showfiles(session);
	}

    function downloadfile(session, str) {
	
	var url = "utils/downloadfile.php?session=" + session + "&datei=" + str;

	window.open(url);
	}


	function deletefile(session, str) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp = new XMLHttpRequest();
		
    if (confirm('Möchten Sie die Datei wirklich löschen?')) {
	var url = "utils/deletefile.php?session=" + session + "&vollerpfad=" + str;
    xmlhttp.open("GET",url, false);
    xmlhttp.send();

    showfiles(session);
    } else {
    // nichts
    }
	}


    function renamefile(session, str) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp = new XMLHttpRequest();

	xmlhttp.onload = function () {
	if (xmlhttp.status === 200) {
    // Datei umbenannt.
	showfiles(session);
	} else {
    alert('Fehler beim Umbenennen!');
	}
	};

	var neuername = prompt("Bitte einen neuen Dateinamen angeben.", str);

	if (neuername != null) {
	var url = "utils/renamefile.php?session=" + session + "&altername=" + str + "&neuername=" + neuername;
    xmlhttp.open("GET", url, false);
    xmlhttp.send();
	}
    }


	function deletedirectory(session, str) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp = new XMLHttpRequest();

    if (confirm('Möchten Sie den Ordner mit allen Dateien und Unterordnern wirklich löschen?')) {
    var url = "utils/deletedirectory.php?session=" + session + "&vollerpfad=" + str;
    xmlhttp.open("GET",url, false);
    xmlhttp.send();

    showfiles(session);
    } else {
    // nichts
	}
	}
	function deletedirectory2(str) {
	if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    if (confirm('Möchten Sie den Ordner mit allen Dateien und Unterordnern wirklich löschen?')) {
    var url = "utils/deletedirectory2.php?vollerpfad=" + str;
    xmlhttp.open("GET",url, false);
    xmlhttp.send();

    showfiles();
    } else {
    // nichts
   }
}

</script>
  </head>

  <body>

    <div class="jumbotron">

      <h1 class="display-4">Web Dateiverwaltung</h1>

      <p class="lead">Einfache Dateiverwaltung zwischen zwei FTP Servern</p>

    </div>

<?php
chdir(__DIR__);

session_start();
$_SESSION['ip1'] = "192.168.0.16";
$_SESSION['user1'] = "test";
$_SESSION['pass1'] = "test";
$_SESSION['aktordner1'] = "";

$_SESSION['ip2'] = "192.168.0.16";
$_SESSION['user2'] = "test";
$_SESSION['pass2'] = "test";
$_SESSION['aktordner2'] = "";

?>

    <div class="container-fluid">

      <div class="row">

        <div class="col-sm">

          <div class="input-group" style="margin-bottom: 1em;">

            <span class="input-group-prepend">

              <button class="btn btn-default" type="button" onclick="showfiles(1)">Aktualisieren</button>

            </span>

			      <form class="form-inline form-control" id="file-form" action="utils/fileupload.php" method="POST">

              <label class="btn btn-default btn-file">Dateien auswählen

			           <input style="display: none;" type="file" id="file-select" name="dateien[]" multiple/>

              </label>

			           <button class="btn btn-default" type="submit" id="upload-button">Upload</button>

			      </form>

          </div>

			    <form class="form-inline form-control" id="neuerordner" action="utils/createdirectory.php" method="post">

            <div class="input-group">

              <div class="input-group-prepend">

                <span class="input-group-text" id="basic-addon1">Neuen Ordner erstellen</span>

              </div>

              <div class="input-group" aria-describedby="basic-addon1">

                <input class="input-group" id="neuerordner-select" placeholder=" Neuer Ordner Name" type="text" name="ordner" />

                <input class="input-group-append btn" id="submit-button" type="submit" />

              </div>

            </div>

          </form>

        </div>

        <div class="col-sm">

          <div class="input-group" style="margin-bottom: 1em;">

            <span class="input-group-prepend">

              <button class="btn btn-default" id="force-inline" type="button" onclick="showfiles(2)">Aktualisieren</button>

            </span>

            <form class="form-inline form-control" id="file-form" action="utils/fileupload.php" method="POST">

              <input class="input-group-btn" type="file" id="file-select" name="dateien[]" multiple/>

              <button class="btn btn-default" type="submit" id="upload-button">Upload</button>

            </form>

          </div>

          <form class="form-inline form-control" id="neuerordner" action="utils/createdirectory.php" method="post">

            <div class="input-group">

              <div class="input-group-prepend">

                <span class="input-group-text" id="basic-addon2">Neuen Ordner erstellen</span>

              </div>

              <div class="input-group" aria-describedby="basic-addon2">

                <input class="input-group" id="neuerordner-select" placeholder=" Neuer Ordner Name" type="text" name="ordner" />

			          <input class="input-group-append btn" id="submit-button" type="submit" />

              </div>

            </div>

          </form>

      </div>

      <div class="row">

        <div class="col-sm" id="fileslist1">

        </div>

        <div class="col-sm" id="fileslist2">

        </div>

      </div>

    </div>

    <div class="container-fluid">

      <div class="col-sm">

        <div class="panel-footer">

          <p>Icons made by
            <a href="https://www.flaticon.com/authors/ocha" title="OCHA">OCHA</a>
             from
             <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a>
              is licensed by
              <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a>
          </p>

        </div>

      </div>

    </div>

	<script>
	dateihochladenhandler();
	ordnererstellenhandler();

	function dateihochladenhandler() {
	var form = document.getElementById("file-form");
	var fileSelect = document.getElementById('file-select');
	var uploadButton = document.getElementById('upload-button');

	form.onsubmit = function(event) {
	event.preventDefault();

	// Update button text.
	uploadButton.innerHTML = 'Uploading...';

	// Get the selected files from the input.
	var files = fileSelect.files;

	// Create a new FormData object.
	var formData = new FormData();

	// Loop through each of the selected files.
	for (var i = 0; i < files.length; i++) {
	var file = files[i];

	// Add the file to the request.
	formData.append('dateien[]', file, file.name);
	}

	if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
	var url = "utils/uploadfile.php";
	xmlhttp.open("POST", url, true);

	// Set up a handler for when the request finishes.
	xmlhttp.onload = function () {
	if (xmlhttp.status === 200) {
    // File(s) uploaded.
    uploadButton.innerHTML = 'Upload';
	showfiles();
	} else {
    alert('Fehler beim Dateiupload!');
	}
	};
	xmlhttp.send(formData);
	}
	}


	function ordnererstellenhandler() {
	var form = document.getElementById("neuerordner");
	var neuerordnerselect = document.getElementById("neuerordner-select");

	form.onsubmit = function(event) {
	event.preventDefault();

    var formData = new FormData();
	formData.append('ordnername', neuerordnerselect.value);

	if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
	var url = "utils/createdirectory.php";
	xmlhttp.open("POST", url, true);

	// Set up a handler for when the request finishes.
	xmlhttp.onload = function () {
	if (xmlhttp.status === 200) {
	showfiles();
	} else {
    alert('Fehler beim Erstellen des Ordners!');
	}
	};
	xmlhttp.send(formData);
	}
	}


	</script>

  </body>

</html>
