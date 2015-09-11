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
    HelloWorldController::foorumi();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  $routes->get('/rekisterointi',function(){
     HelloWorldController::rekisterointi(); 
  });
  $routes->get('/luokeskustelu',function(){
     HelloWorldController::luokeskustelu(); 
  });