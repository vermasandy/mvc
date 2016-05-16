<?php
class home extends Controller{ 
 
 /*
  |------------------------------------------
  |  Loading View Example
  |------------------------------------------ 
  |
  | @param view('viewName',$data (optional));
  | 
  */
  public function index(){     	
 	return $this->view('welcome');
  }

  public function foo() {
    
  }

 /*
  |-----------------------------------------------------
  |  Login Example
  |----------------------------------------------------- 
  |
  | @param loginAttempt('modelName',array $credentails);
  | @retrun false if login fails | true if 
  | login successfull (also stores user data in 
  |	session i.e. $_SESSION['modelName'])
  |
  */
 
  public function login(){
    
 	$credentials = [
    'email' => 'johndoe@gmail.com',
    'password' => '123'
    ];   
    $login = $this->loginAttempt('auser',$credentials);
    if($login === true){
      //login successfull
    }
    //login failed
  }

 /*
  |-------------------------------------
  |  Register Example
  |-------------------------------------  
  */
 
  public function register(){
 	User::create([
 		'username' => 'JohnDoe',
 		'email' => 'johndoe@gmail.com',
 		'password' => $this->hash('123') //password shoud be hashed
 	]);
  }
  
}
