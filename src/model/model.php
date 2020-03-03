<?php 
function getUsers($pdo){
  $req = $pdo->query('SELECT * FROM users');
  $pdo = null; //Close the connection 
  return $req;
}

function getBoards($pdo){
  $req = $pdo->query('SELECT * FROM boards');
  $pdo = null;
  return $req;
}

?>