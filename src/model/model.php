<?php 
function getUsers($pdo){
  $sql = 'SELECT * FROM users';
  $sth = $pdo->prepare($sql);
  $sth->execute();
  $result = $sth->fetchAll();
  return $result;
}

//Get the list of all the boards
function getBoards($pdo){
  $sql = 'SELECT * FROM boards';
  $sth = $pdo->prepare($sql);
  $sth->execute();
  $result = $sth->fetchAll();
  return $result;
}

function getLatestTopics($pdo, $board){
  $sql = 'SELECT title FROM topics 
          INNER JOIN messages ON idtopics = messages.topics_idtopics
          WHERE topics.boards_idboards = (SELECT idboards FROM boards WHERE idboards = ' . $board . ') 
          GROUP BY idtopics
          ORDER BY messages.creation_date DESC
          LIMIT 3';
  $sth = $pdo->prepare($sql);
  $sth->execute();
  $result = $sth->fetchAll();
  return $result;
}

// Get the list of all topics from a given board id
function getCurrentTopics($pdo, $board){
  $sql = 'SELECT * FROM topics WHERE boards_idboards = (SELECT idboards FROM boards WHERE name = "' . $board . '")';
  $sth = $pdo->prepare($sql);
  $sth->execute();
  $result = $sth->fetchAll();
  return $result;
}

// function getBoardTopics($pdo, $board, $limit = NULL){
//   $sql = 'SELECT content, username, messages.creation_date
//           FROM messages 
//           JOIN topics ON topics_idtopics = topics.idtopics 
//           JOIN users ON messages.users_idusers = users.idusers 
//           WHERE topics.idtopics = ' . $topic . '
//           ORDER BY messages.creation_date
//           DESC';

//   if($limit != NULL){
//     $sql = $sql . ' LIMIT ' . $limit; 
//   }

//   $sth = $pdo->prepare($sql);
//   $sth->execute();
//   $result = $sth->fetchAll();
//   return $result;
// }

// Get the list of messages from a given topic id with a limit of how many messages to be collected
function getTopicsMessages($pdo, $topic, $limit = NULL){
  $sql = 'SELECT content, username, messages.creation_date
          FROM messages 
          JOIN topics ON topics_idtopics = topics.idtopics 
          JOIN users ON messages.users_idusers = users.idusers 
          WHERE topics.idtopics = ' . $topic . '
          ORDER BY messages.creation_date
          DESC';

  if($limit != NULL){
    $sql = $sql . ' LIMIT ' . $limit; 
  }

  $sth = $pdo->prepare($sql);
  $sth->execute();
  $result = $sth->fetchAll();
  return $result;
}


?>
