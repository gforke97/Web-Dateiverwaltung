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
        <input type='submit' class='btn btn-large purple' value='log in'> <input type='submit' class='btn btn-large purple' value='register'>
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


    public function loadjlsregistration() {
        $this->loadRegistrationform();
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
        <input type='password' name='password' placeholder='Passwort eingeben'>
        <br/><br/>
        <input type='password' name='repassword' placeholder='Passwort erneut eingeben'>
        <br/><br/>
        <input type='submit' class='btn btn-large red' value='Registrieren'>
        </form>
        ";
        echo $template;
    }


    public function createuserentry($uname, $password, $filename, $success_message) {
        if ($file = fopen($filename, 'a')) {
            fclose($file);
	        $this->createjsonfile($uname, $password, $filename);
	        echo $success_message;
        }
        else {
	        $file_Error = "the file cant be created due to no suitable permisisons";
	        echo $file_Error;
        }
    }


    private function createjsonfile($uname, $password, $filename) {
        $handle = fopen($filename, 'a');
        $password = password_hash($password, PASSWORD_DEFAULT);
        $array = array("uname"=>$uname, "password"=>$password);
        $string = json_encode($array);
        fwrite($handle, $string."\r\n");
        fclose($handle);
    }


    /**
     * @param $uname
     * @param $password
     */
    public function login($uname, $password) {
        $data = file_get_contents("./db/login.json");
        $datas = $this->json_split_objects($data);
        for($n=0;$n<(count($datas));$n++) {
            $json = json_decode($datas[$n], true);
            $j_uname = $json['uname'];
            $j_password = $json['password'];
            $succes = "";
            $fpwd = "";
            if ($uname == $j_uname) {
                if (password_verify($password, $j_password)) {
                    $succes = True;
                }
                else {
                    $fpwd = False;
                }
            }
        }
        if ($succes) {
            echo "success";
        }
        else {
            if ($fpwd) {
                echo "Falsches Passwort";
            }
            else {
                echo "Der eingegebene Benutzername ist falsch.";
            }
        }
    }


    /**
     * @param $json
     * @return mixed
     */
    private function json_split_objects($json)
    {
        $q = FALSE;
        $len = strlen($json);
        for($l=$c=$i=0;$i<$len;$i++)
        {
            $json[$i] == '"' && ($i>0?$json[$i-1]:'') != '\\' && $q = !$q;
            if(!$q && in_array($json[$i], array(" ", "\r", "\n", "\t"))){continue;}
            in_array($json[$i], array('{', '[')) && !$q && $l++;
            in_array($json[$i], array('}', ']')) && !$q && $l--;
            $objects = 0;
            (isset($objects[$c]) && $objects[$c] .= $json[$i]) || $objects[$c] = $json[$i];
            $c += ($l == 0);
        }
        return $objects;
    }


    public function checkuname($uuname) {
        $dataa = file_get_contents("./db/login.json");
        $jsonn = json_decode($dataa, true);
        $js_unamee = $jsonn['uname'];
        if ($uuname == $js_unamee) {
            return true;
        }
        else {
            return false;
        }
    }
}


$jls = new jls;


$jls->loadjls();


if (isset($_POST['uname']) && isset($_POST['password']) && isset($_POST['repassword'])) {

    if (!empty($_POST['uname']) && !empty($_POST['password']) && !empty($_POST['repassword'])) {

  		if ($jls->checkUserAlreadyRegistered() && $jls->checkuname('uname')) {

  			echo "Ein Benutzer mit diesem Namen wurde bereits registriert";
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

	}

    else {
        $jls->loadjlsregistration();
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