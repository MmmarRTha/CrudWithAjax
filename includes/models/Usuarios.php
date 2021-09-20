<?php

//if($_POST['accion'] === 'create')
//{
//    require_once '../funciones/Database.php';
//    $new_name = [
//      "name" => $_POST['name'],
//    ];
//
//    $sql = ("SELECT LAST_INSERT_ID()");
//    try {
//        $stmt = $conn->prepare("INSERT INTO user(name) VALUES (:name)");
//        $stmt->execute($new_name);
//        $result = $conn->prepare($sql);
//        $result->execute();
//        $id = $result->fetchColumn();
//        $respuesta = [
//            'respuesta' => 'correcto',
//            'data' => [
//                'name' => $new_name,
//                'id' => $id,
//            ],
//        ];
//        die();
//    }catch (PDOException $error){
//
//        echo $error->getMessage();
//        $respuesta = [
//            'error' => $error->getMessage()
//        ];
//        die();
//    }
//    echo json_encode($respuesta);
//}

if($_GET['accion'] === 'borrar'){
    require_once '../funciones/Database.php';

    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    try {
        $sql = ("DELETE FROM user WHERE id = :id");
        $stmt = $conn->prepare($sql);
        $stmt->bindValue('id', $_GET['id']);
        $stmt->execute();
        $respuesta = [
            'respuesta' => 'correcto'
        ];
    }catch (PDOException $error){
        echo $error->getMessage();
        $respuesta = [
            'error' => $error->getMessage()
        ];
    }
    echo json_encode($respuesta);
}



