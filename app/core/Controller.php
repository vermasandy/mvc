<?php
class Controller {
	private $lineNumber;

	private $fileName;

	protected function pwdVerify($pwd,$hashAndSalt){		
		if (password_verify($pwd, $hashAndSalt)) {
		   return true;
		}
		return false;		
	}

	protected function viewNotFound($view){
		die("View <u>". $view ." </u> doesn't Exist");
	}

	protected function modelNotFound($Model){
		die("Undefined Model <span style='background-color:red;color:#fff;'> ". $Model ." </span><br />File ". $this->fileName ." <br />Line Number ". $this->lineNumber ."");
	}

	protected function generateSecureToken($length = 20)
	{
	    return bin2hex(random_bytes($length));
	}

	protected function writeSessionAfterLogin($key,$data = null) {
		$_SESSION[$key] = json_encode($data);
		return true;
	}

	public function view($view,$data = []){	    
	    if(!file_exists('../app/views/'.$view.'.php')){
	    	return $this->viewNotFound($view);	    	
	    }	    		
	    extract($data);				
		require_once '../app/views/'.$view.'.php';	
	}

	public function loginAttempt($model,$data = []){
		$Umodel = ucfirst($model);
		if(!file_exists('../models/'.$model.'.php')){
			$debug = debug_backtrace();
			$this->lineNumber = $debug[0]['line'];
			$this->fileName = $debug[0]['file']; 		
			return $this->modelNotFound($Umodel);
		}				
		$getEmail = $Umodel::whereEmail($data['email'])->first();
		if($getEmail === NULL) {
			return false;
		}		
		if($this->pwdVerify($data['password'],$getEmail->password)){
			return $this->writeSessionAfterLogin($model,$getEmail->toArray());			
		}
		return false;
		
	}	

	public function hash($pwd){
		return password_hash($pwd, PASSWORD_DEFAULT);		
	}
		
}