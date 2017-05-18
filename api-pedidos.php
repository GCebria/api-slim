<?php

require_once 'vendor/autoload.php';

$app = new \Slim\Slim();

$db = new mysqli("localhost", "root", "", "aulaespill");


$app->get("/pedidos", function() use($db, $app){
    $query = $db -> query ("SELECT * FROM pedidos");
    $pedidos=array();
    while($fila = $query->fetch_assoc()){
      $pedidos[]=$fila;
    }
    echo json_encode($pedidos);
});

$app->get("/pedidos/:idPedido", function($idPedido) use($db, $app){
    $query = "SELECT * FROM pedidos WHERE idPedido = {$idPedido}";
    $pedido = $db->query($query);
    echo json_encode($pedido -> fetch_assoc());
});


$app->post("/pedidos", function() use($db, $app){
    $query = "INSERT into pedidos values (NULL, "
              . "'{$app->request->post("fechaPedido")}',"
              . "'{$app->request->post("idUsuario")}'"
              .")";
  $insert = $db->query($query);
  if($insert){
      $result = array("STATUS" => "true", "message" => "pedido insertado correctamente.");
  }else{
      $result = array("STATUS" => "false", "message" => "pedido no insertado.");
  }
  echo json_encode($result);
});

$app->put("/pedidos/:idPedido", function($idPedido) use($db, $app){
  $query="UPDATE pedidos SET idPedido = {$idPedido}, fechaPedido = '{$app->request->post("fechaPedido")}',"
      ."idUsuario = '{$app->request->post("idUsuario")}' WHERE idPedido={$idPedido}";
	$update=$db->query($query);
	if($update){
		$result = array("STATUS" => "true", "message" => "pedido se ha actualizado correctamente!!!");
	}else{
		$result = array("STATUS" => "false", "message" => "pedido NO SE HA actualizado!!!");
	}
	echo json_encode($result);
  });

  $app->delete("/pedidos/:idPedido", function($idPedido) use($db, $app){
    $query="DELETE FROM pedidos WHERE idPedido = {$idPedido}";
          $delete = $db->query($query);
          if($delete){
              $result = array("STATUS" => "true", "message" => "pedido borrado.");
          }else{
              $result = array("STATUS" => "false", "message" => "pedido no borrado.");
          }
          echo json_encode($result);
  });

$app->run();
