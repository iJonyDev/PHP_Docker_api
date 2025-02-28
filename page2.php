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