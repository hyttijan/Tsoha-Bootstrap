<?php
class Topic extends BaseModel{
    public $id,$title;
    public function __construct($attributes) {
        parent::__construct($attributes);
    
        
    }
    public function createTopic($title,$category){
        $query=DB::connection()->prepare("INSERT INTO keskustelu(keskusteluotsikko,kategoria) VALUES(:title,:category) RETURNING keskusteluid");
        $query->execute(array('title'=>$title,'category'=>$category));
        $row=$query->fetch();
       $id= $row['keskusteluid'];
       $topic = new Topic(array('id'=>$id,'title'=>$title));
       return $topic;
        
    }
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
