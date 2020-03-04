<?php 
function getUsers($pdo){
  $req = $pdo->query('SELECT * FROM users'); 
  return $req;
}

function getBoards($pdo){
  $req = $pdo->query('SELECT * FROM boards');
  return $req;
}

?>
