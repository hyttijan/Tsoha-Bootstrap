<?php
/**UserController luokka kontrollerina User-luokalle*/
class  UserController extends BaseController{
    /**login-funktio ottaa yhteyden User malliin ja yrittää kirjautua saamillaan parametreilla,jos kirjautuminen
    onnistuu tallennetaan käyttäjän id sessioon, jos ei käyttäjä palautetaan virhe-ilmotuksen kanssa etusivulle*/
    public static function login(){
        $params = $_POST;
        
        if(self::get_user_logged_in()){
            HelloWorldController::index();
        }
        else{
        
        $user = User::authenticate($params);
        if(!$user){
            $error ="Kirjautuminen epäonnistui";
            View::make('home.html',array('error'=>$error));
        }
        else{
            $_SESSION['user']= $user->id;
            HelloWorldController::index();
        }
        }
        
    }
    /**modifyUsers-funktio ottaa User malliin yhteyden, jos sillä on parametreja. Se suorittaa käyttäjien poiston ja oikeuksien muutoksen
    parametrina saamilleen käyttäjille*/
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
        
    }
    /**logout-funktio lopettaa käyttäjän session ja ohjaa tämän etusivulle*/
    public static function logout(){
        $_SESSION['user'] =null;
        Redirect::to('/',array('message'=>'Olet kirjautunut ulos'));
    }
    /**register-funktio ottaa yhteyden User malliin ja pyrkii rekisteröimään uuden käyttäjän, jos rekisteröinti onnistui käyttäjä ohjataan etusivulle,
     * jos rekisteröinti epäonnistuu käyttäjä ohjataan takaisin rekisteröintisivulle.
     */
    public static function register(){
             $params = $_POST;
        $message= User::register($params['username'],$params['password'],$params['password2']);
        if($message=="Rekisteröinti onnistui"){
          
            View::make('home.html',array('message'=>$message));
        }
        else{
            
            View::make('rekisterointi.html',array('error'=>$message));
        }
    }
}

?>
