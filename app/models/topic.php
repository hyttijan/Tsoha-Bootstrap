<?php
/**Topic luokka sisältää erilaisia toimintoja, jotka liittyvät keskusteluihin*/
class Topic extends BaseModel{
    public $id,$title;
    public function __construct($attributes) {
        parent::__construct($attributes);
    
        
    }
    /**createTopic-funktio luo uuden aiheen saamiensa parametrien pohjalta*/
    public function createTopic($title,$category){
  
            
        
        $query=DB::connection()->prepare("INSERT INTO keskustelu(keskusteluotsikko,kategoria) VALUES(:title,:category) RETURNING keskusteluid");
        $query->execute(array('title'=>$title,'category'=>$category));
        $row=$query->fetch();
       $id= $row['keskusteluid'];
       $topic = new Topic(array('id'=>$id,'title'=>$title));
       return $topic;
         
    
    }
    /**search-funktio etsii saamansa parametrin pohjalta parametria vastaavia aiheita*/
    public function search($searchword){
        $query = DB::connection()->prepare("SELECT * FROM keskustelu WHERE keskusteluotsikko LIKE :searchword");
        $query->execute(array('searchword'=>"%".$searchword."%"));
        $rows = $query->fetchAll();
        
        if($rows){
        $topics = array();    
        
        foreach($rows as $row){
            $topics[] = new Topic(array('id'=>$row['keskusteluid'],'title'=>$row['keskusteluotsikko']));
        }
        return $topics;
        }
        return null;
    }
    /**removeTopics-funktio poistaa parametrinaan saamansa keskustelut*/
    public function removeTopics($ids){
        foreach($ids as $id){
       $query = DB::connection()->prepare('DELETE FROM keskustelu WHERE keskusteluid=:id');
       $query->execute(array('id'=>$id));
        }
       
    }
    /**topics palauttaa kaikki keskustelut, jotka ovat kategoriassa, jonka id on parametrina*/
    public function topics($id){
          $query = DB::connection()->prepare('SELECT * FROM keskustelu WHERE kategoria=:id');
        $query->execute(array('id'=>$id));
        $rows = $query->fetchAll();
        $topics = array();
        foreach($rows as $row){
            $topics[] = new Topic(array('id'=>$row['keskusteluid'],'title'=>$row['keskusteluotsikko']));
        }
        return $topics;
    }
    /**find-funktio palauttaa parametrinaan saamansa id:n perusteella keskustelun*/
       public function find($id){
        $query = DB::connection()->prepare('SELECT * FROM keskustelu WHERE keskusteluid=:id');
        $query->execute(array('id'=>$id));
        $row =$query->fetch();
  
       if($row){
           
       
        $topic = new Topic(array('id'=>$row['keskusteluid'],'title'=>$row['keskusteluotsikko']));
         return $topic;
       }
       return null;
        
    }
}
?>
