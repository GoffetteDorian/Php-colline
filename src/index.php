<?php
  $titre = "index";
  require("./view/head.php");
  require("./view/navbar.php");
  require("./model/model.php");
  $users = getUsers();
  foreach($users as $row) {
      echo "<pre>";  
      print_r($row);
      echo "</pre><br/>";
  }

  require('./view/foot.php');
?>
