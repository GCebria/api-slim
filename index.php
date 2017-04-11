<?php
require_once 'vendor/autoload.php';
$app = new \Slim\Slim();

$app->get ("hola/:nombre", function($nombre){
  echo "Hola ".$nombre;
});

$app->get("/hola/:uno/:dos", function($uno, $dos){
  echo $uno."<br/>";
  echo $dos."<br/>";
});

$app->run();
