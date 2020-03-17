<?php session_start(); ?>
<?php
  require_once("./config.php");
  $pdo = db_connect(); //Connect to the db

  require_once("./model/model.php");
  //$_SESSION["user"] = getUser($pdo, "Dorian");

  $titre = "index"; 
  require("./view/head.php");

 // $test = getUsers($pdo);
  $code = "s3cr3t";
  $code_validation = false;
  if(isset($_GET["board"]) && $_GET["board"] == "Very Secret"){
    if(isset($_GET["code"]) && $_GET["code"] == $code){
      $code_validation = true;
    }
}

  require("./view/navbar.php");

  
  if(isset($_SESSION["email"])){
    if(!isset($_GET["topic"])){
      require("./view/boards.php");
    }
    else{
      require("./view/topics.php");
    }
  }
  else{
    require("./view/login.php");
  }
  
  
    // $topics = getCurrentTopics($pdo, $_GET["board"]);
    // require("./view/topics.php");
  
  
  require('./view/foot.php');

  $pdo = null; //Close the connection
?>