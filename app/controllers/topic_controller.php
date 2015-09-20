<?php
class TopicController extends BaseController{

  public static function messages($id){
     $user = self::get_user_logged_in();
     $messages=  Message::all($id);
     $topic = Topic::find($id);
     View::make('keskustelu.html',array('topic'=>$topic,'messages'=>$messages));
 }
 public static function addMessage($id){
    $params =  $_POST;
    $message = Message::createMessage($id,$params['content']);
    $messages=  Message::all($id);
    $topic = Topic::find($id);
    View::make('keskustelu.html',array('topic'=>$topic,'messages'=>$messages));
 }
 public static function createTopic(){
     $params = $_POST;
     
     $topic = Topic::createTopic($params['title'],$params['category']);
     $message = Message::createMessage($topic->id,$params['content']);
     $messages = Message::all($topic->id);
     View::make('keskustelu.html',array('topic'=>$topic,'messages'=>$messages));
 }
}

?>

