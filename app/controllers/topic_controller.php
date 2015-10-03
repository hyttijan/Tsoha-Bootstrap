<?php
/**TopicController toimii Keskustelujen kontrollerina*/
class TopicController extends BaseController{
/**messages-funktio hakee messages mallista ja topic mallista keskustelun viestit,käyttäjät ja keskustelun nimen*/
  public static function messages($id){
     $user = self::get_user_logged_in();
     $messages=  Message::all($id);
     $topic = Topic::find($id);
     View::make('keskustelu.html',array('topic'=>$topic,'messages'=>$messages));
 }
 /**addMessage-funktio lähettää User mallille käskyn lisätä uusi viesti parametrina saatuun keskusteluun,jos viesti on tyhjä lähetetään virheilmoitus*/
 public static function addMessage($id){
    $params =  $_POST;
    if($params['content']!=null&&!ctype_space($params['content'])){
        
   
    $message = Message::createMessage($id,$params['content']);
    $messages=  Message::all($id);
    $topic = Topic::find($id);
    View::make('keskustelu.html',array('topic'=>$topic,'messages'=>$messages));
     }
       $messages=  Message::all($id);
    $topic = Topic::find($id);
    View::make('keskustelu.html',array('topic'=>$topic,'messages'=>$messages,'error'=>'Viestisi oli tyhjä'));
 }
 /**removeTopics-funktio lähettää Topic-mallille kutsun poistaa kaikki parametreinaan saamansa keskustelut*/
 public static function removeTopics(){
     $params = $_POST;
     if(!empty($params['topics'])){
     
     Topic::removeTopics($params['topics']);
     }
 }
 /**removeMessages-funktio lähettää Message-mallille kutsun poistaa kaikki parametreinaan saamansa viestit*/
  public static function removeMessages(){
     $params = $_POST;
     if(!empty($params['messages'])){
         
     
     Message::removeMessages($params['messages']);
     }
     
     }
     /**createTopics-funktio lähettää Topic-mallille kutsun luoda uusi keskustelu ja Message-mallille lisätä uusi viesti*/
 public static function createTopic(){
     $params = $_POST;
     if($params['title']!=null&&$params['content']!=null&&!ctype_space($params['title'])&&!ctype_space($params['content'])){
         
    
     $topic = Topic::createTopic($params['title'],$params['category']);
     $message = Message::createMessage($topic->id,$params['content']);
     $messages = Message::all($topic->id);
     View::make('keskustelu.html',array('topic'=>$topic,'messages'=>$messages));
     }
     $categories=  Category::all();
     View::make('luokeskustelu.html',array('categories'=>$categories,'error'=>"Otsikko tai aloitusviestisi oli tyhjä"));
 }
 /**searchTopicsMessages-funktio hakee hakusanan perusteella topics-mallista ja messages-mallista löytyykö niistä hakusanaa vastaavia keskusteluja ja viestejä*/
 public static function searchTopicsMessages(){
     $searchword = $_POST['searchword'];
     $topics = Topic::search($searchword);
     $messages = Message::search($searchword);
     $users = User::all();
     $categories = Category::all();
     $user = self::get_user_logged_in();
     View::make('hallinto.html',array('searchword'=>$searchword,'user'=>$user,'users'=>$users,'topics'=>$topics,'messages'=>$messages,'categories'=>$categories));
     
 }
}

?>

