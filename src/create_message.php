<?php
  session_start();
  require_once("config.php");
  $pdo = db_connect(); 

  require_once("./model/model.php");

  //to be changed when user is logged in
  $parse = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY);
  parse_str($parse, $queries);

  $idUser = $_SESSION["user"]["idusers"];
  $topic = getCurrentTopic($pdo, $queries["topic"]);

  $sql = 'INSERT INTO messages (content, creation_date, users_idusers, topics_idtopics)
          VALUES ("' . $_POST["content"] . '", CURRENT_TIMESTAMP, ' . $idUser . ', ' . $topic["idtopics"] . ')';

  $sth = $pdo->prepare($sql);
  $sth->execute();
  $sth->closeCursor(); 
  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>