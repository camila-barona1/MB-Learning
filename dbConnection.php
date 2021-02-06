<?php

$db_host= "localhost";
$db_user = "root";
$db_password = "";
$db_name = "mb_school";

//Conexion
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

//Check
if ($conn->connect_error) {
    die('conexion fallida');
}
// else{
//     echo"conectado";
//}
?>