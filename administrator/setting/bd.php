<?php
$host = "localhost";
$user = "root";
$password = "";
$bd = "bixxus";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$bd",$user,$password);
}catch (Exception $ex) {
    echo $ex->getMessage();
};
?>