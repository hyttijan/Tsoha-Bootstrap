<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });
  $routes->get('/kategoria',function(){
  HelloWorldController::kategoria(); 
  });
   $routes->get('/keskustelu',function(){
  HelloWorldController::keskustelu(); 
  });
  $routes->get('/foorumi', function() {
      CategoriesController::index();
  });
   $routes->get('/kategoria-:id', function($id) {
      CategoriesController::category($id);
  });
    $routes->get('/kirjaudu', function() {
        UserController::login();
  });
 $routes->post('/kirjaudu', function() {
        UserController::login();
  });
      $routes->get('/kirjauduulos', function() {
        UserController::logout();
  });

   $routes->get('/keskustelu-:id', function($id) {
     TopicController::messages($id);
  });
    $routes->post('/keskustelu-:id', function($id) {
     TopicController::addMessage($id);
  });

  $routes->get('/hiekkalaatikko-:id', function($id) {
      HelloWorldController::sandbox($id);
  });
  $routes->get('/rekisterointi',function(){
     HelloWorldController::rekisterointi(); 
  });
  $routes->post('/rekisterointi',function(){
      UserController::register();
  });
  $routes->get('/luokeskustelu',function(){
     HelloWorldController::luokeskustelu(); 
  });
   $routes->post('/luokeskustelu',function(){
       TopicController::createTopic();
  });