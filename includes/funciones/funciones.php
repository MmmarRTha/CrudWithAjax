<?php

function getUsuarios()
{
    include 'Database.php';
    $sql = "SELECT * FROM user";

    try{
       $stmt = $conn->query($sql);
        return $stmt;
    }catch (PDOException $error) {
        echo $error->getMessage();
        return false;
    }
}

//obtiene un contacto y toma un id
function getUser($id)
{
    include 'Database.php';
    $sql = "SELECT * FROM user WHERE id = $id";
    try{
        $stmt = $conn->query($sql);
        return $stmt;
    }catch (PDOException $error) {
        echo $error->getMessage();
        return false;
    }
}