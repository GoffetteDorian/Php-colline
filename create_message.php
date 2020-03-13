<?php
session_start();
require_once("config.php");
$pdo = db_connect();

require_once("./model/model.php");

$parse = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY);
parse_str($parse, $queries);

echo $_SESSION["email"];
$idUser = getUserIdByEmail($pdo, $_SESSION["email"]);

$topic = getCurrentTopic($pdo, $queries["topic"]);


$sql = 'INSERT INTO messages (content, creation_date, users_idusers, topics_idtopics, deleted)
          VALUES ("' . $_POST["content"] . '", CURRENT_TIMESTAMP, ' . $idUser . ', ' . $topic["idtopics"] . ', FALSE)';

echo $sql;

echo "<pre>";
echo $_SESSION;
echo "</pre>";

// $sth = $pdo->prepare($sql);
// $sth->execute();
// $sth->closeCursor(); 

  //redirect to previous url
 // goToURL($_SERVER['HTTP_REFERER']);  
