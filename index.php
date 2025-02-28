<?php echo "inicia" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Suscipit facere pariatur blanditiis consequuntur vitae at id eligendi, reprehenderit earum autem accusantium distinctio asperiores labore esse voluptate quibusdam maiores quis totam.</p>
    <h1>Hola 1</h1>
    <?
    $db_user = $_ENV['DATABASE_USERNAME'];
    $db_pass = $_ENV['DATABASE_PASSWORD'];
    $db_url = $_ENV['DATABASE_URL'];
    $db_name = $_ENV['DATABASE_NAME'];
    
    $conn = new mysqli($db_url, $db_user, $db_pass, $db_name);
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    } 
    echo "Conexión exitosa a la base de datos GestionPesetas"; 

    //$conn->close();

    ?>
</body>
</html>
