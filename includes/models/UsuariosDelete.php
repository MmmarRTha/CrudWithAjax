<?php

if($_GET['accion'] === 'borrar'){
    require_once '../funciones/Database.php';

    $id_delete = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    try {
        $sql = ("DELETE FROM user WHERE id = :id");
        $stmt = $conn->prepare($sql);
        $stmt->bindValue('id', $_GET['id']);
        $stmt->execute();
        $respuesta_borrar = [
            'respuesta' => 'correcto'
        ];
    }catch (PDOException $error){
        echo $error->getMessage();
        $respuesta_borrar = [
            'error' => $error->getMessage()
        ];
    }
    echo json_encode($respuesta_borrar);
}
