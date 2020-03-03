<?php
  function db_connect(){
    $host = "eu-cdbr-west-02.cleardb.net";
    $dbname = "heroku_4a25fe8af1897c7";
    $user = "b6ce3f355cfde8";
    $pass = "fd44f147";
    try {
        $pdo = new PDO("mysql:host=".$host."; dbname=".$dbname, $user, $pass); //Create the connection to the bdd
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
    return $pdo;
  }
?>