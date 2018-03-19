loginhandler(1);
loginhandler(2);

function loginhandler(session) {
	var form = document.getElementById("login"+session);
	var formData = new FormData();
	
	form.onsubmit = function(event) {
		event.preventDefault();
		
		formData.append('server', document.getElementById('server'+session).value);
		formData.append('nutzer', document.getElementById('nutzer'+session).value);
		formData.append('passwort', document.getElementById('passwort'+session).value);
		
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
		
		var url = "utils/login.php?session="+session;
		xmlhttp.open("POST", url, true);
		
		// Set up a handler for when the request finishes.
		xmlhttp.onload = function () {
			if (xmlhttp.status === 200) {
				// Login successfull.
				document.getElementById('upload'+session).style.visibility = "visible";
				document.getElementById('fileslist'+session).style.visibility = "visible";
				showfiles(session);
				} else {
				alert('Fehler beim Login!');
			}
		};
		xmlhttp.send(formData);
	}
}