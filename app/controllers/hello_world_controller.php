<?php
  
  class HelloWorldController extends BaseController{

    public static function index(){
        $user = self::get_user_logged_in();
   	  View::make('home.html',array('user'=>$user));
    }
    public static function hallinto(){
        $user = self::get_user_logged_in();
        $users = User::all();
        View::make('hallinto.html',array('users'=>$users,'user'=>$user));
        
    }
    public static function foorumi(){
       View::make('foorumi.html'); 
    }
    public static function kategoria(){
        View::make('kategoria.html');
    }
    public static function keskustelu(){
        View::make('keskustelu.html');
    }

    public static function sandbox($id){
        $query=DB::connection()->prepare('SELECT kayttaja.kayttajanimi,viesti.viestiid,viesti.sisalto,viesti.aika FROM kayttaja,viesti WHERE viesti.kayttaja=kayttaja.kayttajaid AND viesti.keskustelu=:id');
        $query->execute(array('id'=>$id));
        $rows = $query->fetchAll();
        $messages = array();
        
        foreach($rows as $row){
            $messages[] = new Message(array('user'=>$row['kayttajanimi'],'id'=>$row['viestiid'],'content'=>$row['sisalto'],'time'=>$row['aika']));
        }
         Kint::dump($messages);
       
      
    }
    public static function rekisterointi(){
        View::make('rekisterointi.html');
    }
    public static function etsi(){
        self::check_logged_in();
        $user = self::get_user_logged_in();
        $params = $_POST;
        
        $users = User::username_like($params['searchword']);
        View::make('hallinto.html',array('user'=>$user,'users'=>$users));
    }
    public static function luokeskustelu(){
        self::check_logged_in();
       
        
        $categories = Category::all();
        View::make('luokeskustelu.html',array('categories'=>$categories));
       
        
    }
    
    
  }
