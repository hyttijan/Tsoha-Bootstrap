<?php
class Message extends BaseModel{
    public $user,$id,$content,$time;
            
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    public function createMessage($topic,$message){
         $query=DB::connection()->prepare("INSERT INTO viesti(keskustelu,kayttaja,sisalto,aika) VALUES(:topic,:user,:message,now())");
         $query->execute(array('topic'=>$topic,'user'=>$_SESSION['user'],'message'=>$message));
         
         
    }
    public function all($id){
       $query=DB::connection()->prepare('SELECT kayttaja.kayttajanimi,viesti.viestiid,viesti.sisalto,viesti.aika FROM kayttaja,viesti WHERE viesti.kayttaja=kayttaja.kayttajaid AND viesti.keskustelu=:id');
        $query->execute(array('id'=>$id));
        $rows = $query->fetchAll();
        $messages = array();
        
        foreach($rows as $row){
            $messages[] = new Message(array('user'=>$row['kayttajanimi'],'id'=>$row['viestiid'],'content'=>$row['sisalto'],'time'=>$row['aika']));
        }
    return $messages;
        
    }
    
    
}

?>
