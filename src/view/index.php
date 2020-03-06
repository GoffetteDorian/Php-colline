<?php session_start(); ?>
<?php
  require_once("./config.php");
  $pdo = db_connect(); //Connect to the db

  require_once("./model/model.php");
  $_SESSION["user"] = getUser($pdo, "test");

  $titre = "index"; 
  require("./view/head.php");

 // $test = getUsers($pdo);

  require("./view/navbar.php");

  

  if(!isset($_GET["topic"])){
    require("./view/boards.php");
  }
  else{
    require("./view/topics.php");
  }
  
  
    // $topics = getCurrentTopics($pdo, $_GET["board"]);
    // require("./view/topics.php");
  
  
  require('./view/foot.php');

  $pdo = null; //Close the connection
?>