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


    $url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
    $urlParts = explode('/', $url);
    echo $url;
    echo '<br>';
    echo $urlParts[0];
    echo '<br>';
    echo $urlParts[1];
    echo '<br>';
    echo $urlParts[2];
    echo '<br> hola 10';
    // echo "GET";
    $query = "SELECT * FROM USERS";
    $result = $conn->query($query);

    //if ($result->num_rows > 0) {
    echo '[';
        while($row = $result->fetch_assoc()) {
            echo '{"id": "'. $row["id"]. '", "name": "'. $row["first_name"]. '", "lastName": "'. $row["last_name"]. '", "secondLastName": "'. $row["second_last_name"]. '", "email": "'. $row["email"]. '", "dni": "'. $row["dni"]. '"},';
        }
        echo ']'; // Cerrar el array
        $result->free();
        $conn->close();
        exit();
    //}
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