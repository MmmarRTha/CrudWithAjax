<?php
require_once 'config.php';


    $conn = new PDO("mysql:host=". $bdhost . ";dbname=" . $bdname,  $bduser, $bdpass);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
