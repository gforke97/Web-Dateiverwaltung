loginhandler(1);
loginhandler(2);

function loginhandler(session) {
	var form = document.getElementById("login"+session);
	var loginButton = document.getElementById('login-button'+session);
	var formData = new FormData();
	
	form.onsubmit = function(event) {
		event.preventDefault();
		
		// Update button text.
		loginButton.innerHTML = 'Logging in...';		
		
		formData.append('server', document.getElementById('server'+session).value);
		formData.append('nutzer', document.getElementById('nutzer'+session).value);
		formData.append('passwort', document.getElementById('passwort'+session).value);
		
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
		
		var url = "utils/login.php?session="+session;
		xmlhttp.open("POST", url);
		
		// Set up a handler for when the request finishes.
		xmlhttp.onload = function () {
			switch (xmlhttp.status) {
				case 200:
					// Login successfull.
					loginButton.innerHTML = 'Login';
					loginButton.style.visibility = "hidden";
					document.getElementById('upload'+session).style.visibility = "visible";
					document.getElementById('fileslist'+session).style.visibility = "visible";
					alertify.success('Login erfolgreich.');
					showfiles(session);
					break;
				case 460:
					loginButton.innerHTML = 'Login';
					alertify.error('Keine Verbindung mit Server möglich!');
					break;
				case 461:
					loginButton.innerHTML = 'Login';
					alertify.error('Kein Login mit angegebenen Daten möglich!');
					break;
			}			
		};
		xmlhttp.send(formData);
	}
}