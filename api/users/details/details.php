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
    // echo $_GET['lang'];
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

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

    echo $_POST['id'];

    $query = "SELECT * FROM USERS where id = '". $_POST['id']. "'";
    $result = $conn->query($query);

    while($row = $result->fetch_assoc()) {
        echo '{"id": "'. $row["id"]. '", "name": "'. $row["first_name"]. '", "lastName": "'. $row["last_name"]. '", "secondLastName": "'. $row["second_last_name"]. '", "email": "'. $row["email"]. '", "dni": "'. $row["dni"]. '"}';
    }
    $result->free();
    $conn->close();
    exit();
}


if ( $_SERVER['REQUEST_METHOD'] == 'PUT' && $data['id'] != '')  {   
    
    $query = "SELECT * FROM USERS where id = '". $data['id']. "'";
    // echo $query;
    $result = $conn->query($query);

    $row = $result->fetch_assoc();
    // $row = $result->fetch_assoc();

    if($row == null) {
        echo '{"error": "user not found"}';
    } else {
        // echo $row['first_name'];
        // echo $row['email'];
        $name = isset($data['name'])? $data['name'] : $row['first_name'];
        $firs_name = isset($data['firstName'])? $data['firstName'] : $row['first_name'];
        $last_name = isset($data['lastName'])? $data['lastName'] : $row['last_name'];
        $second_last_name = isset($data['secondLastName'])? $data['secondLastName'] : $row['second_last_name'];
        $email = isset($data['email'])? $data['email'] : $row['email'];
        $dni = $row['dni'];

        $update = "UPDATE USERS SET first_name = '". $name. "', last_name = '". $last_name. "', second_last_name = '". $second_last_name. "', email = '". $email. "', dni = '". $dni. "' WHERE id = '". $data['id']. "'";
        // echo $update;
        if ($conn->query($update) === TRUE) {
            echo '{"result": "Record updated successfully"}';
         } else {
            echo "Error updating record: " . $conn->error;
         }

        $result->free();
        $conn->close();
        exit();
    }
}

if ( $_SERVER['REQUEST_METHOD'] == 'DELETE' )  {   
    echo "DELETE";
}


?>