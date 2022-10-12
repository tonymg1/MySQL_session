
<?php
    require "database.php";

    $message = '';

        //Si no está vacio email y contraseña, agrega a la base de datos
        //Agregar a la tabla users, seguido de los datos que queremos almacenar

        //De la variable conn (creada en database.php) le vamos a hacer una consulta con prepare como está definida 
        //artiba como variable, simplemente se le pasa la variable
    
        //Con bindParam se vinculan parámetros que le hemos agregado

        //Se encripta la contraseña antes de almacenarlo en la base de datos
  
        
        //Comprobrar si se está ejecutando correctamente
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $_POST['email']);
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $stmt->bindParam(':password', $password);
        
            if ($stmt->execute()) {
              $message = 'Successfully created new user';
            } else {
              $message = 'Sorry there must have been an issue creating your account';
            }
          }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>
</head>
<body>
    <?php require "partials/header.php"?>

    
    <?php 
    //Esto lo hace para mostrar si se ha creado, yo creo que bastaría con un return arriba
    if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>SignUp</h1>
    <span>or <a href="login.php">Login</a></span>
    <form action="index"></form>
    <form action="signup.php" method="POST">
        <!-- TAMPOCO USA QUERY PARAMS -->
        <input type="text" name="email" placeholder="Enter your email">
        <input type="password" name="password" placeholder="Enter your password">
        <input type="password" name="confirm_password" placeholder="Confirm your password">
        <input type="submit" value="Submit">
    </form>
</body>
</html>