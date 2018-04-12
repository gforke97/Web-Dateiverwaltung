dateihochladenhandler(1);
dateihochladenhandler(2);

function dateihochladenhandler(session) {
	var form = document.getElementById("file-form"+session);
	var fileSelect = document.getElementById('file-select'+session);
	var uploadButton = document.getElementById('upload-button'+session);
	
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
		
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
		
		var url = "utils/uploadfile.php?session="+session;
		xmlhttp.open("POST", url, true);
		
		// Set up a handler for when the request finishes.
		xmlhttp.onload = function () {
			if (xmlhttp.status === 200) {
				// File(s) uploaded.
				uploadButton.innerHTML = 'Upload';
				alertify.success('Hochladen erfolgreich.');
				showfiles(session);
				} else {
				alertify.error('Fehler beim Dateiupload!');
			}
		};
		xmlhttp.send(formData);
	}
}