<html>
	<head>
		<meta charset="utf-8">
		
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
			
		<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/alertify.min.js"></script>
		<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/alertify.min.css"/>
		<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/themes/default.min.css"/>
		
		<script src="main.js"></script>
		
		<link rel="stylesheet" type="text/css" href="main.css">
	</head>
	
	<body>	
	
	<!--Bei jedem Neuladen der Seite muss sich der Benutzer neu einloggen.-->
	<?php
		session_start();
		$_SESSION = array();
		session_destroy();
	?>
		
		<div class="jumbotron">
			<h1 class="display-4">Web Dateiverwaltung</h1>
			<p class="lead">Einfache Dateiverwaltung zwischen zwei FTP Servern</p>
		</div>
		

		<div class="row container-fluid">	<!--Rows muessen innerhalb eines Containers platziert werden, damit die Scrolleiste nicht sichtbar wird.-->			
			<div class="col" id="ftpfenster1">
				<div class="col-sm">
					<form class="form-inline form-control" id="login1" action="utils/login.php" method="post">
						<div class="input-group">
							<div class="input-group" aria-describedby="basic-addon1">
								<input class="form-control" id="server1" placeholder="Serveradresse" type="text" name="server" />
								<input class="form-control" id="nutzer1" placeholder="Nutzer" type="text" name="nutzer" />
								<input class="form-control" id="passwort1" placeholder="Passwort" type="password" name="passwort" />
								<button class="input-group-append btn" id="login-button1" type="submit">Login</button>
							</div>
						</div>
					</form>
				</div>
				
				<div class="col-sm" id="upload1" style="visibility:hidden">
					<div class="input-group" style="margin-bottom: 1em;">
						<span class="input-group-prepend">
							<button class="btn btn-default" type="button" onclick="showfiles(1)">Aktualisieren</button>
						</span>
						<form class="form-inline form-control" id="file-form1" action="utils/uploadfile.php" method="POST">
							<label class="btn btn-default btn-file">Dateien auswählen..
								<input style="display: none;" type="file" id="file-select1" name="dateien[]" multiple/>
							</label>
							<button class="btn btn-default" type="submit" id="upload-button1">Upload</button>
						</form>
					</div>
				</div>
				
				<div class="col-" id="fileslist1" style="visibility:hidden">
				</div>		
			</div>	
			
			
			<div class="col" id="ftpfenster2">
				<div class="col-sm">
					<form class="form-inline form-control" id="login2" action="utils/login.php" method="post">
						<div class="input-group">
							<div class="input-group" aria-describedby="basic-addon1">
								<input class="form-control" id="server2" placeholder="Serveradresse" type="text" name="server" />
								<input class="form-control" id="nutzer2" placeholder="Nutzer" type="text" name="nutzer" />
								<input class="form-control" id="passwort2" placeholder="Passwort" type="password" name="passwort" />
								<button class="input-group-append btn" id="login-button2" type="submit">Login</button>
							</div>
						</div>
					</form>
				</div>
				
				<div class="col-sm" id="upload2" style="visibility:hidden">
					<div class="input-group" style="margin-bottom: 1em;">
						<span class="input-group-prepend">
							<button class="btn btn-default" id="force-inline" type="button" onclick="showfiles(2)">Aktualisieren</button>
						</span>
						<form class="form-inline form-control" id="file-form2" action="utils/uploadfile.php" method="POST">
							<label class="btn btn-default btn-file">Dateien auswählen..
								<input style="display: none;" type="file" id="file-select2" name="dateien[]" multiple/>
							</label>
							<button class="btn btn-default" type="submit" id="upload-button2">Upload</button>
						</form>
					</div>
				</div>
				
				<div class="col-" id="fileslist2" style="visibility:hidden">
				</div>
			</div>
		</div>
		
		
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
			
		<script type="text/javascript">
			var script = document.createElement('script');
			script.setAttribute('src', 'fileuploadhandler.js');
			script.setAttribute('type', 'text/javascript');
			document.getElementsByTagName('head')[0].appendChild(script);
			
			var script = document.createElement('script');
			script.setAttribute('src', 'loginhandler.js');
			script.setAttribute('type', 'text/javascript');
			document.getElementsByTagName('head')[0].appendChild(script);

		</script>
		
	</body>
	
</html>
