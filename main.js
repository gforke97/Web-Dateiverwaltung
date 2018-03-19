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

function createdirectory(session) {
	xmlhttp = new XMLHttpRequest();
	
	xmlhttp.onload = function () {
		if (xmlhttp.status === 200) {
			//Ordner erstellt.
			showfiles(session);
			} else {
			alert('Fehler beim Erstellen des Ordners!');
		}
	};
	
	var ordnername = prompt("Bitte einen neuen Ordnernamen angeben.");
	
	if (ordnername != null) {
		var url = "utils/createdirectory.php?session=" + session + "&ordnername=" + ordnername;
		xmlhttp.open("GET", url, false);
		xmlhttp.send();
	}
}	