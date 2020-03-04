


<?php
  require_once("./config.php");
  $pdo = db_connect(); //Connect to the db

  require_once("./model/model.php");

  $titre = "index"; 
  require("./view/head.php");

 // $test = getUsers($pdo);

  $boards = getBoards($pdo);
  require("./view/navbar.php");

  $currentBoard = "General";
  $topics = getCurrentTopics($pdo, $currentBoard);
  $messages = getTopicsMessages($pdo, 1); 
  require("./view/topics.php");


  
  require('./view/foot.php');


  $pdo = null; //Close the connection
?>
