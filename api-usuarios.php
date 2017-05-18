<?php

require_once 'vendor/autoload.php';

$app = new \Slim\Slim();

$db = new mysqli("localhost", "root", "", "aulaespill");


$app->get("/usuarios", function() use($db, $app){
    $query = $db -> query ("SELECT * FROM usuarios");
    $usuarios=array();
    while($fila = $query->fetch_assoc()){
      $usuarios[]=$fila;
    }

    echo json_encode($usuarios);
});

$app->get("/usuarios/:idUsuario", function($idUsuario) use($db, $app){
    $query = "SELECT * FROM usuarios WHERE idUsuario = {$idUsuario}";

    $usuario = $db->query($query);

    echo json_encode($usuario -> fetch_assoc());
});

$app->post("/usuarios/login", function() use($db, $app){
  $email = $app->request->post("email");
  $contrasena = $app->request->post("contrasena");
  $query = "SELECT * FROM usuarios WHERE email = '$email' and contrasena = '$contrasena'";
  $result =  mysqli_query($db,$query)or die(mysqli_error());
  $num_row = mysqli_num_rows($result);
		$row=mysqli_fetch_array($result);
		if( $num_row >=1 ) {
			$_SESSION['nombre']=$row['nombre'];
			$response['status'] = 'success';
			$response['message'] = 'This was successful';
		}
		else{
			$response['status'] = 'error';
	    $response['message'] = 'This failed';
		}
		echo json_encode($response);

});



$app->post("/usuarios", function() use($db, $app){
    $query = "INSERT into usuarios values (NULL, "
              . "'{$app->request->post("nombre")}',"
              . "'{$app->request->post("apellidos")}',"
              . "'{$app->request->post("telefono")}',"
              . "'{$app->request->post("email")}',"
              . "'{$app->request->post("contrasena")}',"
              . "'{$app->request->post("direccion")}',"
              . "'{$app->request->post("rolusuario")}'"
              .")";

  $insert = $db->query($query);
  if($insert){
      $result = array("STATUS" => "true", "message" => "usuario insertado correctamente.");
  }else{
      $result = array("STATUS" => "false", "message" => "usuario no insertado.");
  }
  echo json_encode($result);
});

$app->put("/usuarios/:idUsuario", function($idUsuario) use($db, $app){

  $query="UPDATE usuarios SET idUsuario = {$idUsuario}, nombre = '{$app->request->post("nombre")}', apellidos = '{$app->request->post("apellidos")}', "
			. "telefono = '{$app->request->post("telefono")}', email = '{$app->request->post("email")}', "
      . "contrasena = '{$app->request->post("contrasena")}', direccion = '{$app->request->post("direccion")}', "
      . "rolusuario = '{$app->request->post("rolusuario")}' WHERE idUsuario={$idUsuario}";

	$update=$db->query($query);
	if($update){
		$result = array("STATUS" => "true", "message" => "usuario se ha actualizado correctamente!!!");
	}else{
		$result = array("STATUS" => "false", "message" => "usuario NO SE HA actualizado!!!");
	}

	echo json_encode($result);
  });

  $app->delete("/usuarios/:idUsuario", function($idUsuario) use($db, $app){
    $query="DELETE FROM usuarios WHERE idUsuario = {$idUsuario}";

          $delete = $db->query($query);


          if($delete){
              $result = array("STATUS" => "true", "message" => "usuario borrado.");
          }else{
              $result = array("STATUS" => "false", "message" => "usuario no borrado.");
          }

          echo json_encode($result);

  });


$app->run();
