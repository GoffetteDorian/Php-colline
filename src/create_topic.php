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

  // If the board is random we count the number of topics in it and if that count is higher than 5 we delete the older topic to add the new one
  if($queries["board"] == "Random"){
    $sql = "SELECT COUNT(*) FROM topics WHERE boards_idboards = " . $idBoard;
    $sth = $pdo->prepare($sql);
    $sth->execute();
    $count = $sth->fetch();
    
    if($count[0] >= 5){
      $sql = "DELETE FROM topics WHERE boards_idboards = " . $idBoard . " ORDER BY creation_date ASC LIMIT 1";
      $sth = $pdo->prepare($sql);
      $sth->execute();
    }
  }

  $sql = 'INSERT INTO topics (title, creation_date, users_idusers, boards_idboards)
          VALUES ("' . $title . '" , CURRENT_TIMESTAMP, ' . $idUser . ', ' . $idBoard . ')';

  $sth = $pdo->prepare($sql);
  $sth->execute(); 
  $sth->closeCursor();

  //redirect to previous url
  goToURL($_SERVER['HTTP_REFERER']);  
?>