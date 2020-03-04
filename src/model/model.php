<?php 
function getUsers($pdo){
  $sql = 'SELECT * FROM users';
  $sth = $pdo->prepare($sql);
  $sth->execute();
  $result = $sth->fetchAll();
  return $result;
}

function getBoards($pdo){
  $sql = 'SELECT * FROM boards';
  $sth = $pdo->prepare($sql);
  $sth->execute();
  $result = $sth->fetchAll();
  return $result;
}

function getCurrentTopics($pdo, $board){
  $sql = 'SELECT * FROM topics WHERE boards_idboards = (SELECT idboards FROM boards WHERE name = "' . $board . '")';
  $sth = $pdo->prepare($sql);
  $sth->execute();
  $result = $sth->fetchAll();
  return $result;
}

function getTopicsMessages($pdo, $topic){
  $sql = 'SELECT content, username
          FROM messages 
          JOIN topics ON topics_idtopics = topics.idtopics 
          JOIN users ON messages.users_idusers = users.idusers 
          WHERE topics.idtopics = ' . $topic;
  $sth = $pdo->prepare($sql);
  $sth->execute();
  $result = $sth->fetchAll();
  return $result;
}


?>
