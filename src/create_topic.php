<?php
  require_once("config.php");
  $pdo = db_connect();
  
  

  //to be changed when user is logged in
  print_r($_SESSION["user"]);

  // $sql = "";
  // $sth = $pdo->prepare($sql);
  // $sth->execute();
  // $result = $sth->fetchAll();
  // print_r ($result);   
  // header('Location: ' . $_SERVER['HTTP_REFERER']);
?>