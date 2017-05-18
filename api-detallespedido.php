<?php

require_once 'vendor/autoload.php';

$app = new \Slim\Slim();

$db = new mysqli("localhost", "root", "", "aulaespill");


$app->get("/detallespedido", function() use($db, $app){
    $query = $db -> query ("SELECT * FROM detallespedido");
    $detallespedido=array();
    while($fila = $query->fetch_assoc()){
      $detallespedido[]=$fila;
    }

    echo json_encode($detallespedido);
});

$app->get("/detallespedido/:idDetallespedido", function($idDetallespedido) use($db, $app){
    $query = "SELECT * FROM detallespedido WHERE idDetallespedido = {$idDetallespedido}";

    $usuario = $db->query($query);

    echo json_encode($usuario -> fetch_assoc());
});


$app->post("/detallespedido", function() use($db, $app){
    $query = "INSERT into detallespedido values (NULL, "
              . "'{$app->request->post("idCurso")}',"
              . "'{$app->request->post("precio")}',"
              . "'{$app->request->post("idPedido")}'"
              .")";

  $insert = $db->query($query);
  if($insert){
      $result = array("STATUS" => "true", "message" => "detalles insertados correctamente.");
  }else{
      $result = array("STATUS" => "false", "message" => "destalles no insertados.");
  }
  echo json_encode($result);
});

$app->put("/detallespedido/:idDetallespedido", function($idDetallespedido) use($db, $app){

  $query="UPDATE detallespedido SET idDetallespedido = {$idDetallespedido}, idCurso = '{$app->request->post("idCurso")}', precio = '{$app->request->post("precio")}', "
			. "idPedido = '{$app->request->post("idPedido")}' WHERE idDetallespedido={$idDetallespedido}";

	$update=$db->query($query);
	if($update){
		$result = array("STATUS" => "true", "message" => "los detalles se ha actualizado correctamente!!!");
	}else{
		$result = array("STATUS" => "false", "message" => "los detalles NO SE HA actualizado!!!");
	}

	echo json_encode($result);
  });

  $app->delete("/detallespedido/:idDetallespedido", function($idDetallespedido) use($db, $app){
    $query="DELETE FROM detallespedido WHERE idDetallespedido = {$idDetallespedido}";

          $delete = $db->query($query);


          if($delete){
              $result = array("STATUS" => "true", "message" => "detalelles borrados.");
          }else{
              $result = array("STATUS" => "false", "message" => "detalles no borrados.");
          }

          echo json_encode($result);

  });


$app->run();
