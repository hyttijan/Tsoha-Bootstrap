<?php
  
  class HelloWorldController extends BaseController{

    public static function index(){
        $user = self::get_user_logged_in();
   	  View::make('home.html',array('user'=>$user));
    }
    public static function hallinto(){
        $user = self::get_user_logged_in();
        $users = User::all();
        $categories = Category::all();
        View::make('hallinto.html',array('categories'=>$categories,'users'=>$users,'user'=>$user));
        
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

    public static function sandbox(){
   
    }
    public static function rekisterointi(){
        View::make('rekisterointi.html');
    }
  
    public static function luokeskustelu(){
        self::check_logged_in();
       
        
        $categories = Category::all();
        View::make('luokeskustelu.html',array('categories'=>$categories));
       
        
    }
    
    
  }
