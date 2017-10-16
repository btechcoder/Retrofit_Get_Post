<?php

require_once 'DBOperations.php';

class Functions{

private $db;

public function __construct() {

      $this -> db = new DBOperations();

}




public function isEmailValid($email){

  return filter_var($email, FILTER_VALIDATE_EMAIL);
}

public function getMsgParamNotEmpty(){


  $response["result"] = "failure";
  $response["message"] = "Parameters should not be empty !";
  return json_encode($response);

}

public function getMsgInvalidParam(){

  $response["result"] = "failure";
  $response["message"] = "Invalid Parameters";
  return json_encode($response);

}

public function getMsgInvalidEmail(){

  $response["result"] = "failure";
  $response["message"] = "Invalid Email";
  return json_encode($response);

}



public function getUser() {

  $db = $this -> db;

       $result =  $db -> getUser();

       if(!$result) {

        $response["result"] = "failure";
        $response["message"] = "Invaild User!";
        return json_encode($response);

       } else {

        $response["result"] = "success";
        $response["message"] = "User Successful";
        $response["user"] = $result;
        return json_encode($response);
        

       }


}

public function addUser($NomUser,$PrenomUser,$CinUser,$ImgUser) {

	$db = $this -> db;

	if (!empty($NomUser) && !empty($PrenomUser) && !empty($CinUser) && !empty($ImgUser)) {

  		

  			$result = $db -> insertUser($NomUser, $PrenomUser, $CinUser, $ImgUser);

  			if ($result) {

				  $response["result"] = "success";
  				$response["message"] = "user Registered Successfully !";
           //date and times
          $date = date('Y/m/d H:i:s');
          $response["date_create"] = $date;
         //Create File Register.json
          $fp = fopen('createUser.json', 'w');
          fwrite($fp, json_encode($response));
          fclose($fp);

  				return json_encode($response);
  						
  			} else {

  				$response["result"] = "failure";
  				$response["message"] = "Registration Failure";
  				return json_encode($response);

  			}
  		//}					
  	} else {

  		return $this -> getMsgParamNotEmpty();

  	}
}




}
