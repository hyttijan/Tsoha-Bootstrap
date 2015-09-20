<?php
class Category extends BaseModel{
        public $id,$name;
    public function __construct($attributes){
        parent::__construct($attributes);
    }
    public function all(){
        $query = DB::connection()->prepare('SELECT * FROM kategoria');
        $query->execute();
        $rows =$query->fetchAll();
        $categories = array();
        
        foreach($rows as $row){
        $categories[] = new Category(array('id'=>$row['kategoriaid'],'name'=>$row['kategorianimi']));
        }
        return $categories;
    }
    public function find($id){
        $query = DB::connection()->prepare('SELECT * FROM kategoria WHERE kategoriaid=:id');
        $query->execute(array('id'=>$id));
        $row =$query->fetch();
  
       if($row){
           
       
        $category = new Category(array('id'=>$row['kategoriaid'],'name'=>$row['kategorianimi']));
         return $category;
       }
       return null;
        
    }
    
    
    
}

?>

