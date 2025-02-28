<?php
header('Content-Type: application/json');
// Conexión a la base de datos
$db_url = "192.168.1.138:3306";
$db_user = "root";
$db_pass = "myroopass";
$db_name = "mycompany";

$conn = new mysqli($db_url, $db_user, $db_pass, $db_name);
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    } 

    // Definir los verbos HTTP
// Peticiones GET (lectura)
if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
    // echo "GET";
    $query = "SELECT id, email FROM USERS";
    $result = $conn->query($query);

    //if ($result->num_rows > 0) {
    $response = '';
    if ($result->num_rows > 0) {
    $response .= '[';
        while($row = $result->fetch_assoc()) {
            $response .=   '{"id": "'. $row["id"]. '", "email": "'. $row["email"]. '"},';
        }
        $response = rtrim($response, ',');
        $response .= ']'; 
        echo $response;
        $result->free();
        $conn->close();
        exit();
    }
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