<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Bienvenid@ a Web de CURRÍCULUM</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php require 'header.php' ?>

    <?php if(!empty($user)): ?>
      <br> Bienvenid@. <?= $user['email']; ?>
      <br>Has iniciado sesión con éxito en 
      <a href="cv.php">
        Web de CV
      </a>
    <?php else: ?>
      <h1>Por Favor Inicie Sesión o Regístrese</h1>

      <a href="alta.php">Iniciar Sesión</a> o
      <a href="register.php">Registrarse</a>
    <?php endif; ?>
  </body>
</html>