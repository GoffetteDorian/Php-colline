


<?php
  require_once("./config.php");
  $pdo = db_connect(); //Connect to the db

  require_once("./model/model.php");

  $titre = "index"; 
  require("./view/head.php");

  $boards = getBoards($pdo);
  require("./view/navbar.php");

  echo getcwd();
  
  // $users = getUsers($pdo);
  // foreach($users as $row) {
  //     echo "<pre>";  
  //     print_r($row);
  //     echo "</pre><br/>";
  // }


  
  require('./view/foot.php');


  $pdo = null; //Close the connection
?>
