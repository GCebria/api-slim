<?php

require_once 'vendor/autoload.php';

$app = new \Slim\Slim();

$db = new mysqli("localhost", "root", "", "aulaespill");


$app->get("/alumnos", function() use($db, $app){
    $query = $db -> query ("SELECT * FROM alumnos");
    $alumnos=array();
    while($fila = $query->fetch_assoc()){
      $alumnos[]=$fila;
    }

    echo json_encode($alumnos);
});

$app->get("/alumnos/:id", function($id) use($db, $app){
    $query = "SELECT * FROM alumnos WHERE id = {$id}";

    $alumno = $db->query($query);

    echo json_encode($alumno -> fetch_assoc());
});


$app->post("/alumnos", function() use($db, $app){
    $query = "INSERT into alumnos values (NULL, "
              . "'{$app->request->post("nombre")}',"
              . "'{$app->request->post("apellidos")}',"
              . "'{$app->request->post("telefono")}',"
              . "'{$app->request->post("email")}',"
              . "'{$app->request->post("contrasena")}',"
              . "'{$app->request->post("direccion")}',"
              . "'{$app->request->post("ciudad")}',"
              . "'{$app->request->post("cp")}',"
              . "'{$app->request->post("pais")}'"
              .")";

  $insert = $db->query($query);
  if($insert){
      $result = array("STATUS" => "true", "message" => "alumno insertado correctamente.");
  }else{
      $result = array("STATUS" => "false", "message" => "alumno no insertado.");
  }
  echo json_encode($result);
});

$app->put("/alumnos/:id", function($id) use($db, $app){

  $query="UPDATE alumnos SET nombre = '{$app->request->post("nombre")}', apellidos = '{$app->request->post("apellidos")}', "
			. "telefono = '{$app->request->post("telefono")}', email = '{$app->request->post("email")}', "
      . "contrasena = '{$app->request->post("contrasena")}', direccion = '{$app->request->post("direccion")}', "
      . "ciudad = '{$app->request->post("ciudad")}', cp = '{$app->request->post("cp")}', "
      . "pais = '{$app->request->post("pais")}' WHERE id={$id}";

	$update=$db->query($query);
	if($update){
		$result = array("STATUS" => "true", "message" => "alumno se ha actualizado correctamente!!!");
	}else{
		$result = array("STATUS" => "false", "message" => "alumno NO SE HA actualizado!!!");
	}

	echo json_encode($result);
  });

  $app->delete("/alumnos/:id", function($id) use($db, $app){
    $query="DELETE FROM alumnos WHERE id = {$id}";

          $delete = $db->query($query);


          if($delete){
              $result = array("STATUS" => "true", "message" => "alumno borrado.");
          }else{
              $result = array("STATUS" => "false", "message" => "alumno no borrado.");
          }

          echo json_encode($result);

  });


$app->run();
