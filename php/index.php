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
	var url = "utils/deletefile.php?vollerpfad=" + str;
	xmlhttp.open("GET",url, false);
    xmlhttp.send();

	showfiles();
	}

	function deletedirectory(str) {
	if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
	var url = "utils/deletedirectory.php?vollerpfad=" + str;
	xmlhttp.open("GET",url, false);
    xmlhttp.send();

	showfiles();
	}

	</script>
  </head>

  <body>

    <div class="jumbotron text-center">

      <h1>Web Dateiverwaltung PHP</h1>

    </div>

<?php
chdir(__DIR__);

session_start();
$_SESSION['ip'] = "192.168.0.16";
$_SESSION['user'] = "test";
$_SESSION['pass'] = "test";
$_SESSION['aktordner'] = "";

echo "<button type=\"button\" onclick=\"showfiles()\">Aktualisieren</button>";

echo "<div class=\"col-sm-6\" id=\"fileslist\">";

echo "</div>";

?>


  </body>

</html>
