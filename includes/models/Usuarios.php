<?php
require_once '../funciones/Database.php';

if($_POST['accion'] == 'create')
{
    $new_name = [
      "name" => $_POST['name'],
    ];

    $sql = ("SELECT LAST_INSERT_ID()");
    try {
        $stmt = $conn->prepare("INSERT INTO user(name) VALUES (:name)");
        $stmt->execute($new_name);
        $result = $conn->prepare($sql);
        $result->execute();
        $id = $result->fetchColumn();
        $respuesta = [
            'respuesta' => 'correcto',
            'data' => [
                'name' => $new_name,
                'id' => $id,
            ],
        ];
    }catch (PDOException $error){
        echo $error->getMessage();
        $respuesta = [
            'error' => $error->getMessage()
        ];
    }
    echo json_encode($respuesta);
}



