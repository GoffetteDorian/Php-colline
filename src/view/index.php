<?php
  //session_start();
  require_once("./config.php");
  $pdo = db_connect(); //Connect to the db

  require_once("./model/model.php");
  //$_SESSION["user"] = getUser($pdo, "Dorian");

  $titre = "index"; 
  require("./view/head.php");

 // $test = getUsers($pdo);

  require("./view/navbar.php");

  $boards = getBoards($pdo);
  require("./view/boards.php");
  
  
    // $topics = getCurrentTopics($pdo, $_GET["board"]);
    // require("./view/topics.php");
  
  
  require('./view/foot.php');

  $pdo = null; //Close the connection
?>