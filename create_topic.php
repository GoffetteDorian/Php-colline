<?php
session_start();
require_once("config.php");
$pdo = db_connect();

require_once("./model/model.php");

$parse = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY);
parse_str($parse, $queries);

$idUser = $_SESSION["user"]["idusers"];
$idBoard = getBoardByName($pdo, $queries["board"])["idboards"];
$title = $_POST["title"];

$sql = 'INSERT INTO topics (title, creation_date, users_idusers, boards_idboards)
          VALUES ("' . $title . '" , CURRENT_TIMESTAMP, ' . $idUser . ', ' . $idBoard . ')';

$sth = $pdo->prepare($sql);
$sth->execute();
$sth->closeCursor();

  //redirect to previous url
  // header('Location: ' . $_SERVER['HTTP_REFERER']);
