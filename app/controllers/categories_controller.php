<?php
class CategoriesController extends BaseController{
 public static function index(){
   
     $categories=  Category::all();
     View::make('foorumi.html',array('categories'=>$categories));
 }
  public static function category($id){
  
     $category=  Category::find($id);
     $topics = Topic::topics($id);
     View::make('kategoria.html',array('category'=>$category,'topics'=>$topics));
 }
}
?>

