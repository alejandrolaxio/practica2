<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
      $message = 'Se ha creado el usuario con éxito';
    } else {
      $message = 'Losiento, se ha producido un error al crear el usuario';
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registrarse</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>

    <?php require 'header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Registrarse</h1>
    <span>o <a href="alta.php">Iniciar Sesión</a></span>

    <form action="signup.php" method="POST">
      <input name="email" type="text" placeholder="Introduzca su email">
      <input name="password" type="password" placeholder="Introduzca una contraseña">
      <input name="confirm_password" type="password" placeholder="Confirme la contraseña">
      <input type="submit" value="Enviar">
    </form>

  </body>
</html>