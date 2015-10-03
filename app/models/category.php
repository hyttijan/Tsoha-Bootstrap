<?php
/**Category luokka sisältää erilaisia toimintoja, jotka liittyvät kategorioihin*/
class Category extends BaseModel{
        public $id,$name;
    public function __construct($attributes){
        parent::__construct($attributes);
    }
    /**all-funktio hakee kaikki kategoriat tietokannasta*/
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
    /**find-funktio etsii parametrina saamansa id:n perusteella kategorian*/
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
    /**add-funktio lisää uuden kategorian*/
    public function add($newcategory){
        $query= DB::connection()->prepare('INSERT INTO kategoria(kategorianimi) VALUES(:newcategory)');
        $query->execute(array('newcategory'=>$newcategory));
    }
    /**remove-funktio poistaa parametrina saamansa id:n perusteella kategorioita*/
    public function remove($ids){
        foreach($ids as $id){
        $query = DB::connection()->prepare('DELETE FROM kategoria WHERE kategoriaid=:id');
        $query->execute(array('id'=>$id));
        }
    }
    
    
    
}

?>

