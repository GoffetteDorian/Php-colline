<?php
  session_start();
  require_once("config.php");
  $pdo = db_connect(); 

  require_once("./model/model.php");

  $parse = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY);
  parse_str($parse, $queries);

  $idUser = getUserIdByEmail($pdo, $_SESSION["email"]);
  $idBoard = getBoardByName($pdo, $queries["board"])["idboards"];
  $title = $_POST["title"];

  $sql = 'INSERT INTO topics (title, creation_date, users_idusers, boards_idboards)
          VALUES ("' . $title . '" , CURRENT_TIMESTAMP, ' . $idUser . ', ' . $idBoard . ')';

  echo $sql;

  $sth = $pdo->prepare($sql);
  $sth->execute();
  $sth->closeCursor();

  //redirect to previous url
  goToURL($_SERVER['HTTP_REFERER']);  
?>