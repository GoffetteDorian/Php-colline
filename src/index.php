


<?php
  require_once("./config.php");
  $pdo = db_connect();

  require_once("./model/model.php");

  $titre = "index"; 
  require("./view/head.php");

  $boards = getBoards($pdo);
  require("./view/navbar.php");
 
  $users = getUsers($pdo);
  foreach($users as $row) {
      echo "<pre>";  
      print_r($row);
      echo "</pre><br/>";
  }

  require('./view/foot.php');
?>
