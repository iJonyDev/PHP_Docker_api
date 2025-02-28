<?php
$db_url = "192.168.1.138:3306";
$db_user = "root";
$db_pass = "myroopass";
$db_name = "mycompany";

$conn = new mysqli($db_url, $db_user, $db_pass, $db_name);
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
echo "Esto se programó en el imacMini" ;
if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {

    echo "GET";
}

if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
    echo "POST";
}

if ( $_SERVER['REQUEST_METHOD'] == 'PUT' )  {   
    echo "PUT";
}

if ( $_SERVER['REQUEST_METHOD'] == 'DELETE' )  {   
    echo "DELETE";
}
?>