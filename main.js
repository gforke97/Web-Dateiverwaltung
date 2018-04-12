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
	
	xmlhttp.onload = function () {
		if (xmlhttp.status === 200) {
			// Gelöscht.
			alertify.success('Erfolgreich gelöscht.');
			showfiles(session);
			} else {
			alertify.error('Fehler beim Löschen!');
		}
	};
	
	alertify.confirm("Web-Dateiverwaltung 2.0", "Möchten Sie die Datei wirklich löschen?",
		function(){
		var url = "utils/deletefile.php?session=" + session + "&vollerpfad=" + str;
		xmlhttp.open("GET",url, false);
		xmlhttp.send();
		
		showfiles(session);
		},
		function(){
		});

}


function renamefile(session, str) {
	// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp = new XMLHttpRequest();
	
	xmlhttp.onload = function () {
		if (xmlhttp.status === 200) {
			// Datei umbenannt.
			alertify.success('Erfolgreich umbenannt.');
			showfiles(session);
			} else {
			alertify.error('Fehler beim Umbenennen!');
		}
	};
	
	alertify.prompt("Web-Dateiverwaltung 2.0", "Neuer Name:", str,
	  function(evt, value ){
			if (value != null) {
			var url = "utils/renamefile.php?session=" + session + "&altername=" + str + "&neuername=" + value;
			xmlhttp.open("GET", url, false);
			xmlhttp.send();
			}
	  },
	  function() {
	  })
	  ;
	}

function deletedirectory(session, str) {
	// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp = new XMLHttpRequest();
	
	xmlhttp.onload = function () {
		if (xmlhttp.status === 200) {
			// Gelöscht.
			alertify.success('Erfolgreich gelöscht.');
			showfiles(session);
			} else {
			alertify.error('Fehler beim Löschen!');
		}
	};
	
	alertify.confirm("Web-Dateiverwaltung 2.0", "Möchten Sie den Ordner mit allen Dateien und Unterordnern wirklich löschen?",
		function(){
			var url = "utils/deletedirectory.php?session=" + session + "&vollerpfad=" + str;
			xmlhttp.open("GET",url, false);
			xmlhttp.send();
		
			showfiles(session);
		},
		function(){
		});

}

function createdirectory(session) {
	xmlhttp = new XMLHttpRequest();
	
	xmlhttp.onload = function () {
		if (xmlhttp.status === 200) {
			//Ordner erstellt.
			alertify.success('Ordner erfolgreich erstellt.')
			showfiles(session);
			} else {
			alertify.error('Fehler beim Erstellen des Ordners!');
		}
	};
	
	alertify.prompt("Web-Dateiverwaltung 2.0", "Neuer Ordner:", "",
	  function(evt, value ){
		if (value != null) {
		var url = "utils/createdirectory.php?session=" + session + "&ordnername=" + value;
		xmlhttp.open("GET", url, false);
		xmlhttp.send();
		}
	  },
	  function() {
	  })
	  ;
	
}

function transferfile (session, str) {
	// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp = new XMLHttpRequest();
	
	xmlhttp.onload = function () {
		
	switch (xmlhttp.status) {
		case 200:
			// Datei transferiert.
			alertify.success('Datentransfer erfolgreich.');
			showfiles(1);
			showfiles(2);
			break;
		case 460:
			alertify.error('Keine Verbindung mit anderem Server möglich!');
			break;
		case 461:
			alertify.error('Kein Login mit angegebenen Daten möglich!');
			break;
		default:
			alertify.error('Fehler beim Datentransfer!');
		}
	};
	
	var url = "utils/transferfile.php?session=" + session + "&datei=" + str;
	xmlhttp.open("GET", url, false);
	xmlhttp.send();
}	