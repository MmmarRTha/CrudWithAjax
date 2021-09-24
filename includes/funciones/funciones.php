<?php

function fetchAll()
{
    include 'Database.php';
    $sql = "SELECT * FROM user";

    try{
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }catch (PDOException $error) {
        echo $error->getMessage();
    }
}

function fetchUser($id)
{
    include 'Database.php';
    if(isset($id)){
        $query = "SELECT * FROM user WHERE id = :id";

        try {
            $stmt = $conn->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch (PDOException $error){
            echo $error->getMessage();
        }
    }else{
        echo "Se requiere un ID de usuario para poder editar.";
        exit;
    }
}