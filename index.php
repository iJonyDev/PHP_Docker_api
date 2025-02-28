<?php
$db_url = "192.168.1.138:3306";
$db_user = "root";
$db_pass = "myroopass";
$db_name = "mycompany";

$conn = new mysqli($db_url, $db_user, $db_pass, $db_name);
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {

    // echo "GET";
}

if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
    // echo "POST";
}

if ( $_SERVER['REQUEST_METHOD'] == 'PUT' )  {   
    echo "PUT";
}

if ( $_SERVER['REQUEST_METHOD'] == 'DELETE' )  {   
    echo "DELETE";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="./frontend/styles.css" rel="stylesheet" />
  </head>
  <body>
    <div class="container">
      <div class="user-form">
        <h2>Gestionar Usuario</h2>

        <!-- <form id="userForm" method="POST" action="./page2.php"> -->
        <form id="userForm" method="POST">
          <div class="form-grid">
            <input type="hidden" id="userId"/>
            <input type="text" id="firstName" placeholder="Nombre" name="firstName" />
            <input type="text" id="lastName" placeholder="Apellido" />
            <input
              type="text"
              id="secondLastName"
              placeholder="Segundo Apellido"
            />
            <input
              type="email"
              id="email"
              placeholder="Correo electrónico"
            />
            <input type="number" id="dni" placeholder="DNI" />
          </div>
          <button type="submit" id="submitBtn">Agregar Usuario</button>
          <button type="button" id="cancelEdit" style="display: none">
            Cancelar
          </button>
        </form>
      </div>

      <table class="users-table">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Segundo Apellido</th>
            <th>Email</th>
            <th>DNI</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody id="usersList">
        <tr>
            <?php
            if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
            {
            ?>
                <th><?php echo $_POST['firstName']; ?></th>
                <th><?php echo $_POST['lastName']; ?></th>
                <th><?php echo $_POST['secondLastName']; ?></th>
                <th><?php echo $_POST['email']; ?></th>
                <th><?php echo $_POST['dni']; ?></th>  
            <?php
            }
            ?>
          </tr>
        </tbody>
      </table>
    </div>
    <script src="./frontend/app.js" defer></script>
  </body>
</html>
