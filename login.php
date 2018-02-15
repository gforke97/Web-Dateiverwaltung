  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
 
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
          <div><br/><br/><br/><br/><br/><br/></div>
  <!-- Compiled and minified JavaScript -->
<div class="col-xs-3"></div>
  <div class="col-xs-6 text-center" id='box'>
<?php 
/**
*@author: Naveen
*
*@link: http://www.github.com/naveen17797/

*/
class jls {


public function checkUserAlreadyRegistered () {

  if (file_exists("./db/login.json"))
   {

	return true;


    }

  else {

	  return false;

    }


}








private function loadloginform() {
	$this->displaylogintemplate();
}





private function displaylogintemplate() {

$logintemplate = "
<h4>Login</h4>
<br/><br/><br/>
<form method='POST'>
<input type='text' name='log-name' placeholder='Benutzernamen eingeben'><br/><br/>
<input type='password' name='log-password' placeholder='Passwort eingeben'><br/><br/>
<input type='submit' class='btn btn-large purple' value='log in'>


</form>
";

echo $logintemplate;

}








public function loadjls() {

if ($this->checkUserAlreadyRegistered()) {
$this->loadloginform();


}

else {



$this->loadRegistrationform();

}


}






private function loadRegistrationform() {


$this->displayregistrationtemplate();



}






private function displayregistrationtemplate() {


$template = "
<h4>Register</h4>
<br/><br/>
<form method='POST'>
<input type='text' name='uname' placeholder='Benutzernamen eingeben'><br/><br/>
<input type='password' name='password' placeholder='password' placeholder='Passwort eingeben'>
<br/><br/>
<input type='password' name='repassword' placeholder='Passwort erneut eingeben'>
<br/><br/>
<input type='submit' class='btn btn-large red' value='Registrieren'>
</form>


";

echo $template;




}








public function createuserentry($uname, $password, $filename, $success_message) {


if (fopen($filename, w)) {

    fclose($filename);
	$this->createjsonfile($uname, $password, $filename);
	echo $success_message;

}
else {

	$file_Error = "the file cant be created due to no suitable permisisons";


	echo $file_Error;


}

}







private function createjsonfile($uname, $password, $filename) {

$handle = fopen($filename, "w");


$password = password_hash($password, PASSWORD_DEFAULT);

$uname = password_hash($uname, PASSWORD_DEFAULT);


$array = array("uname"=>$uname, "password"=>$password);

$string = json_encode($array);


fwrite($handle, $string);

fclose($handle);



}





public function login($uname, $password) {

$data = file_get_contents("./db/login.json");

$json = json_decode($data, true);




$j_uname = $json['uname'];

$j_password = $json['password'];


if (password_verify($uname, $j_uname)) {

	if (password_verify($password, $j_password)) {


	echo "success";

	}
	else {

		echo "Falsches Passwort";
	}

}

else {

echo "Der eingegebene Benutzername ist falsch.";


}



}











}





$jls = new jls;


$jls->loadjls();





if (isset($_POST['uname']) && isset($_POST['password']) && isset($_POST['repassword'])) {

  if (!empty($_POST['uname']) && !empty($_POST['password']) && !empty($_POST['repassword'])) {

  		if ($jls->checkUserAlreadyRegistered()) {

  			echo "a user has been already registered, no users can be added further";
  		}

  		else {

  		$password = $_POST['password'];

  		$repassword = $_POST['repassword'];

  		$uname = $_POST['uname'];

  		$success_message = "Ihr Benutzername wurde registriert";

  		$filename = "./db/login.json";

      if ($password == $repassword) {
  	    $jls->createuserentry($uname, $password, $filename, $success_message);
  	   }
  	   else {
  	   	echo "both passwords are not same, retype and submit";
  	   }
  	}
  }

}



if (isset($_POST['log-name']) && isset($_POST['log-password'])) {

	if (!empty($_POST['log-name']) && !empty($_POST['log-password'])) {

		$log_name = $_POST['log-name'];

		$log_password = $_POST['log-password'];

			if ($jls->checkUserAlreadyRegistered()) {

				$jls->login($log_name, $log_password);
			}

			else {

			}

	}


}






























?>
</div>
<style type="text/css">
	#box {
		border: 40px solid #eee;
		background-color: #fff;
	}
	body {
		background-color: #eee;
	}
	input[type='text'], input[type='password']{
		width: 300px;
	}
</style>
<title>Json Login System[JLS]</title>