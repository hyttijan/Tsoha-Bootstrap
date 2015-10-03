<?php
/**Message luokka sisältää erilaisia toimintoja, jotka liittyvät viesteihin*/
class Message extends BaseModel{
    public $user,$id,$content,$time;
            
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    /**createMessage-funktio luo uuden viestin keskusteluun saamiensa paramatrien pohjalta*/
    public function createMessage($topic,$message){
         $query=DB::connection()->prepare("INSERT INTO viesti(keskustelu,kayttaja,sisalto,aika) VALUES(:topic,:user,:message,now())");
         $query->execute(array('topic'=>$topic,'user'=>$_SESSION['user'],'message'=>$message));
         
         
    }
    /**removeMessages-funktio poistaa viestit saamiensa id:eitten perusteella*/
    public function removeMessages($ids){
        foreach($ids as $id){
            $query = DB::connection()->prepare("DELETE FROM viesti WHERE viestiid=:id");
            $query->execute(array('id'=>$id));
        }
    }
    /**search-funktio etsii viesteja saamansa parametrin pohjalta*/
       public function search($searchword){
        $query = DB::connection()->prepare("SELECT * FROM viesti WHERE sisalto LIKE :searchword");
        $query->execute(array('searchword'=>"%".$searchword."%"));
        $rows = $query->fetchAll();
        
        if($rows){
        $messages = array();    
        
        foreach($rows as $row){
            $messages[] = new Message(array('id'=>$row['viestiid'],'user'=>$row['kayttaja'],'content'=>$row['sisalto'],'time'=>$row['aika']));
        }
        return $messages;
        }
        return null;
    }
    /**all-funktio palauttaa kaikki viestit, jotka ovat keskustelussa keskustelun id:n perusteella*/
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
