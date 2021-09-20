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