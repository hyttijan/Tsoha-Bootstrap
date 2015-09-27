<?php
class  UserController extends BaseController{
    
    public static function login(){
        $params = $_POST;
        
        if(self::get_user_logged_in()){
            HelloWorldController::index();
        }
        else{
        
        $user = User::authenticate($params);
        if(!$user){
            $message ="Kirjautuminen epäonnistui";
            View::make('home.html',array('message'=>$message));
        }
        else{
            $_SESSION['user']= $user->id;
            HelloWorldController::index();
        }
        }
        
    }
    public static function modifyUsers(){
        
   
        $params = $_POST;
        if(!empty($params['users'])){
        User::removeUsers($params['users']);
        }
        if(!empty($params['users2'])){
        User::modifyUsers($params['users2']);
        }
      
        $user = self::get_user_logged_in();
        $users = User::all();
         View::make('hallinto.html',array('users'=>$users,'user'=>$user));
    }
    public static function logout(){
        $_SESSION['user'] =null;
        Redirect::to('/',array('message'=>'Olet kirjautunut ulos'));
    }
    
    public static function register(){
             $params = $_POST;
        $message= User::register($params['username'],$params['password'],$params['password2']);
        if($message=="Rekisteröinti onnistui"){
          
            View::make('home.html',array('message'=>$message));
        }
        else{
            
            View::make('rekisterointi.html',array('message'=>$message));
        }
    }
}

?>
