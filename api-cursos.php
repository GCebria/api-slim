<?php

require_once 'vendor/autoload.php';

$app = new \Slim\Slim();

$db = new mysqli("localhost", "root", "", "aulaespill");


$app->get("/cursos", function() use($db, $app){
    $query = $db -> query ("SELECT * FROM cursos");
    $cursos=array();
    while($fila = $query->fetch_assoc()){
      $cursos[]=$fila;
    }

    echo json_encode($cursos);
});

$app->get("/cursos/:id", function($id) use($db, $app){
    $query = "SELECT * FROM cursos WHERE id = {$id}";

    $curso = $db->query($query);

    echo json_encode($curso -> fetch_assoc());
});


$app->post("/cursos", function() use($db, $app){
    $query = "INSERT into cursos values (NULL, "
              . "'{$app->request->post("nombre")}',"
              . "'{$app->request->post("descripcion")}',"
              . "'{$app->request->post("foto")}',"
              . "'{$app->request->post("precio")}',"
              . "'{$app->request->post("tutor")}'"
              .")";

  $insert = $db->query($query);
  if($insert){
      $result = array("STATUS" => "true", "message" => "Curso insertado correctamente.");
  }else{
      $result = array("STATUS" => "false", "message" => "Curso no insertado.");
  }
  echo json_encode($result);
});

$app->put("/cursos/:id", function($id) use($db, $app){

  $query="UPDATE cursos SET nombre = '{$app->request->post("nombre")}', descripcion = '{$app->request->post("descripcion")}', "
			. "foto = '{$app->request->post("foto")}', precio = '{$app->request->post("precio")}', "
      . "tutor = '{$app->request->post("tutor")}' WHERE id={$id}";

	$update=$db->query($query);
	if($update){
		$result = array("STATUS" => "true", "message" => "Curso se ha actualizado correctamente!!!");
	}else{
		$result = array("STATUS" => "false", "message" => "Curso NO SE HA actualizado!!!");
	}

	echo json_encode($result);
  });

  $app->delete("/cursos/:id", function($id) use($db, $app){
    $query="DELETE FROM cursos WHERE id = {$id}";

          $delete = $db->query($query);


          if($delete){
              $result = array("STATUS" => "true", "message" => "Curso borrado.");
          }else{
              $result = array("STATUS" => "false", "message" => "Curso no borrado.");
          }

          echo json_encode($result);

  });


$app->run();
