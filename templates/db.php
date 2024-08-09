<?php 
 try {
  $dsn = 'mysql:host=localhost;dbname=pizza_interplan;charset=utf8';
  $user = 'pizzarumo';
  $pass = '2024.rumo';
  $option = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  ];
  $db = new PDO($dsn, $user, $pass, $option);
} catch (PDOException $e) {
  var_dump($e->errorInfo);
}
