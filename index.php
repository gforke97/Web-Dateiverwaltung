<html>

  <head>

    <!--Bootstrap Framework-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!--Main CSS-->
    <link rel="stylesheet" type="text/css" href="main.css">

	<script>
	function showfiles() {
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("fileslist").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET","utils/showdirectorycontent.php?aufruf=TRUE", false);
    xmlhttp.send();
	}

	function changedirectory(str) {
	if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
	var url = "utils/changedirectory.php?ordner=" + str;
	xmlhttp.open("GET",url, false);
    xmlhttp.send();

	showfiles();
	}

    function downloadfile(str) {
	if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
	var url = "utils/downloadfile.php?datei=" + str;

	window.open(url);
	}

	function deletefile(str) {
	if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    if (confirm('Möchten Sie die Datei wirklich löschen?')) {
    var url = "utils/deletefile.php?vollerpfad=" + str;
    xmlhttp.open("GET",url, false);
    xmlhttp.send();

    showfiles();
    } else {
    // nichts
    }
	}

    function renamefile(str) {
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

	xmlhttp.onload = function () {
	if (xmlhttp.status === 200) {
    // Datei umbenannt.
	showfiles();
	} else {
    alert('Fehler beim Umbenennen!');
	}
	};

	var neuername = prompt("Bitte einen neuen Dateinamen angeben.", str);

	if (neuername != null) {
	var url = "utils/renamefile.php?altername=" + str + "&neuername=" + neuername;
    xmlhttp.open("GET", url, false);
    xmlhttp.send();
	}
    }

	function deletedirectory(str) {
	if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    if (confirm('Möchten Sie den Ordner mit allen Dateien und Unterordnern wirklich löschen?')) {
    var url = "utils/deletedirectory.php?vollerpfad=" + str;
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

    <div class="jumbotron jumbotron-fluid text-center">

      <h1>Web Dateiverwaltung PHP</h1>

    </div>

<?php
chdir(__DIR__);

session_start();
$_SESSION['ip'] = "192.168.0.16";
$_SESSION['user'] = "test";
$_SESSION['pass'] = "test";
$_SESSION['aktordner'] = "";
#$_SESSION['ip'] = "ftp.dlptest.com";
#$_SESSION['user'] = "dlpuser@dlptest.com";
#$_SESSION['pass'] = "eiTqR7EMZD5zy7M";
#$_SESSION['aktordner'] = "";

?>

    <div class="container-fluid">

      <div class="row">

        <div class="col-sm">

          <button class="btn" id="action-bar-top" type="button" onclick="showfiles()">Aktualisieren</button>

			    <form class="form-group" id="file-form" action="utils/fileupload.php" method="POST">

			         <input class="input-group" id="action-bar-top" type="file" id="file-select" name="dateien[]" multiple/>

			         <button class="btn" id="action-bar-top" type="submit" id="upload-button">Upload</button>

			    </form>

			<form id="neuerordner" action="utils/createdirectory.php" method="post">
			 <input id="neuerordner-select" type="text" name="ordner" />
			 <input type="submit" />
			</form>


        </div>

        <div class="col-sm">

        </div>

      </div>

      <div class="row">

        <div class="col-sm" id="fileslist">
		


        </div>

        <div class="col-sm">
			<button class="btn" id="action-bar-top" type="button" onclick="showfiles()">Aktualisieren</button>
			    <form class="form-group" id="file-form" action="utils/fileupload.php" method="POST">

			         <input class="input-group" id="action-bar-top" type="file" id="file-select" name="dateien[]" multiple/>

			         <button class="btn" id="action-bar-top" type="submit" id="upload-button">Upload</button>

			    </form>

			<form id="neuerordner" action="utils/createdirectory.php" method="post">
			 <input id="neuerordner-select" type="text" name="ordner" />
			 <input type="submit" />
			</form>
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


<div>Icons made by <a href="https://www.flaticon.com/authors/ocha" title="OCHA">OCHA</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
  </body>

</html>
