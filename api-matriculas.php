<?php

require_once 'vendor/autoload.php';

$app = new \Slim\Slim();

$db = new mysqli("localhost", "root", "", "aulaespill");


$app->get("/usuarios", function() use($db, $app){
    $query = $db -> query ("SELECT * FROM matriculas");
    $matriculas=array();
    while($fila = $query->fetch_assoc()){
      $matriculas[]=$fila;
    }

    echo json_encode($matriculas);
});

$app->get("/matriculas/:idMatricula", function($idMatricula) use($db, $app){
    $query = "SELECT * FROM matriculas WHERE idMatricula = {$idMatricula}";

    $matricula = $db->query($query);

    echo json_encode($matricula -> fetch_assoc());
});

$app->post("/matriculas/check", function() use($db, $app){
  $usuario = $app->request->post("idUsuario");
  $curso = $app->request->post("idCurso");
  $query = "SELECT * FROM matriculas WHERE idUsuario = '$usuario' and idCurso = '$curso'";
  $result =  mysqli_query($db,$query)or die(mysqli_error());
  $num_row = mysqli_num_rows($result);
		$row=mysqli_fetch_array($result);
		if( $num_row >=1 ) {
			$response['status'] = 'fail';
			$response['message'] = 'El alumno YA está matriculado en ese curso';
		}
		else{
			$response['status'] = 'success';
	    $response['message'] = 'El alumno NO está matriculado en ese curso';
		}
		echo json_encode($response);

});



$app->post("/matriculas", function() use($db, $app){
    $query = "INSERT into matriculas values (NULL, "
              . "'{$app->request->post("idUsuario")}',"
              . "'{$app->request->post("idCurso")}',"
              .")";

  $insert = $db->query($query);
  if($insert){
      $result = array("STATUS" => "true", "message" => "Alumno matriculado correctamente.");
    }else{
      $result = array("STATUS" => "false", "message" => "Alumno no matriculado.");
  }
  echo json_encode($result);
});

$app->put("/matriculas/:idMatricula", function($idMatricula) use($db, $app){

  $query="UPDATE matriculas SET idMatricula = {$idMatricula},"
      . "idUsuario = '{$app->request->post("idUsuario")}', idCurso = '{$app->request->post("idCurso")}'"
			. "WHERE idUsuario={$idUsuario}";

	$update=$db->query($query);
	if($update){
		$result = array("STATUS" => "true", "message" => "matricula se ha actualizado correctamente");
	}else{
		$result = array("STATUS" => "false", "message" => "matricula no actualizada");
	}

	echo json_encode($result);
  });

  $app->delete("/matriculas/:idMatricula", function($idMatricula) use($db, $app){
    $query="DELETE FROM matricula WHERE idMatricula = {$idMatricula}";

          $delete = $db->query($query);


          if($delete){
              $result = array("STATUS" => "true", "message" => "matricula borrada.");
          }else{
              $result = array("STATUS" => "false", "message" => "matricula no borrada.");
          }

          echo json_encode($result);

  });


$app->run();
