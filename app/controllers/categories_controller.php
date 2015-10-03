<?php
/**CategoriesController toimii kategorien kontrollerina*/
class CategoriesController extends BaseController{
    /**index-funktio hakee Category mallin avulla kategoriat ja luo näkymän foorumisivusta, jossa on kaikki kategoriat*/
 public static function index(){
   
     $categories=  Category::all();
     View::make('foorumi.html',array('categories'=>$categories));
 }/**category-funktio etsii saamansa id parametrin perusteella kategorian kaikki keskustelut ja luo näkymän kategorian keskusteluista*/
  public static function category($id){
  
     $category=  Category::find($id);
     $topics = Topic::topics($id);
     View::make('kategoria.html',array('category'=>$category,'topics'=>$topics));
 }
 /**modifyCategories muokkaa kategorioita poistamalla ja lisäämällä uusia*/
  public static function modifyCategories(){
  $params = $_POST;
     if(!empty($params['categories'])){
     Category::remove($params['categories']);
     }
     if(!empty($params['newcategory'])){
         Category::add($params['newcategory']);
     }
    
 }
}
?>

