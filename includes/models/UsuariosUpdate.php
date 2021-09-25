<?php

if($_POST['accion'] == 'update') {
    //echo json_encode($_POST);
    require_once '../funciones/Database.php';
    //validar las entradas
    $id_update = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $nombre = filter_var($_POST['name'], FILTER_SANITIZE_STRING);

    $user = [
      'id' => $_POST['id'],
      'name' => $_POST['name']
    ];

    $sql = "UPDATE user SET name = :name WHERE id = :id";
    try{
        $stmt = $conn->prepare($sql);
        $resultado = $stmt->execute($user);
        $respuesta_editar = [
          'respuesta' => 'correcto'
        ];
    }catch (PDOException $error){
        echo $error->getMessage();
        $respuesta_editar = [
            'error' => $error->getMessage()
        ];
    }
    echo json_encode($respuesta_editar);
}
