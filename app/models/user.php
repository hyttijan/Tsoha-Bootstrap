<?php
class User extends BaseModel{
        public $level,$id,$name,$password;
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    public function register($username,$password,$password2){
        if(($password!=$password2)||strlen($password)<6){
         return "Rekisteröinti epäonnistui.Syy: Salasanat eivät täsmää tai salasanasi on alle 6 merkkiä";
           
        }
        else if(User::username_exists($username)||strlen($username)<4){
            return "Rekisteröinti epäonnistui.Syy: Käyttäjänimi on jo käytössä tai käyttäjänimesi on alle 4 merkkiä.";
           
        }
        else{

            $statement = DB::connection()->prepare("INSERT INTO kayttaja(kayttajanimi,salasana,kayttajataso) VALUES(:username,:password,1)");
            $statement->execute(array('username'=>$username,'password'=>$password));
            return "Rekisteröinti onnistui";
        }
    }
    public function username_exists($username){
        $query = DB::connection()->prepare("SELECT * FROM kayttaja WHERE kayttajanimi=:username");
        $query->execute(array('username'=>$username));
        $row=$query->fetch();
        if($row){
            return true;
        }
        return false;
        
    }
    public function all(){
        $query = DB::connection()->prepare("SELECT * FROM kayttaja");
        $query->execute();
        $rows = $query->fetchAll();
        $users = array();
        if($rows){
            foreach($rows as $row){
                $users[] = new User(array('id'=>$row['kayttajaid'],'name'=>$row['kayttajanimi'],'password'=>$row['salasana'],'level'=>$row['kayttajataso']));
                
            }
            return $users;
         }
         
         return null;
    }
    public function removeUsers($params){
        if(!empty($params)){
        foreach($params['users'] as $user){
           
            $query= DB::connection()->prepare("UPDATE viesti SET kayttaja = 1 WHERE kayttaja=:id");    
        $query->execute(array('id'=>$user));    
            $query= DB::connection()->prepare("DELETE FROM kayttaja WHERE kayttajaid=:id");
           
        $query->execute(array('id'=>$user));
       
        }
        }
        
    }
    public function username_like($username){
        $query = DB::connection()->prepare("SELECT * FROM kayttaja WHERE kayttajanimi LIKE ::text %:username%");
         $query->execute(array('username'=>$username));
         $rows = $query->fetchAll();
         $users = array();
         if($rows){
            foreach($rows as $row){
                $users[] = new User(array('id'=>$row['kayttajaid'],'name'=>$row['kayttajanimi'],'password'=>$row['salasana'],'level'=>$row['kayttajataso']));
                
            }
            return $users;
         }
         
         return null;
        
    }
    public function find($id){
    $query = DB::connection()->prepare("SELECT * FROM kayttaja WHERE kayttajaid=:id");    
    $query->execute(array('id'=>$id));
    $row = $query->fetch();
    if($row){
        $user = new User(array('name'=>$row['kayttajanimi'],'password'=>$row['salasana'],'id'=>$row['kayttajaid'],'level'=>$row['kayttajataso']));
        return $user;
        
    }
    else{
        return null;
    }
    }
    public function authenticate($params){
        
      if(array_key_exists('username', $params)&&array_key_exists('password', $params)){
          
            
        
        $username = $params['username'];
        $password = $params['password'];
        
        $query = DB::connection()->prepare("SELECT * FROM kayttaja WHERE kayttajanimi=:username and salasana=:password AND kayttajataso<4");
        $query->execute(array('username'=>$username,'password'=>$password));
        $row = $query->fetch();
        if($row){
          $user = new User(array('name'=>$row['kayttajanimi'],'password'=>$row['salasana'],'id'=>$row['kayttajaid'],'level'=>$row['kayttajataso']));
          return $user;
        }
        }
       return null;
    }
}
