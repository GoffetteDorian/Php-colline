<?php
session_start();

// initializing variables
$username = '';
$email = '';
$errors = array();

// connect to the database
// $db = mysqli_connect('remotemysql.com', 'qpBidspZIE', 'UR92tr5A42', 'qpBidspZIE');
// $db = mysqli_connect('eu-cdbr-west-02.cleardb.net', 'b6ce3f355cfde8', 'fd44f147', 'heroku_4a25fe8af1897c7');
$db = mysqli_connect('g4yltwdo6z0izlm6.chr7pe7iynqr.eu-west-1.rds.amazonaws.com', 'fa6nqso0nfvipgp1', 'cz8wfcdeh1cs95l9', 'kxda9r88l71g6qmh');

function delete_profile($db){
    // $db = mysqli_connect('mysql', 'root', 'root', 'mydb');
    $email = $_SESSION['email'];
    $query = "DELETE FROM users WHERE email='$email'";
    mysqli_query($db, $query);     
}

function logout(){
    session_start();
    $_SESSION = array();
    session_destroy();
    header('location : login.php');   
}


function register($db){
  $errors = array();
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) {
      array_push($errors, 'Username is required');
  }
  if (empty($email)) {
      array_push($errors, 'Email is required');
  }
  if (empty($password_1)) {
      array_push($errors, 'Password is required');
  }
  if (empty($password_2)) {
      array_push($errors, 'Confirm Password is required');
  }
  if ($password_1 != $password_2) {
      array_push($errors, 'The two passwords do not match');
  }

  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) {
      // if user exists
      if ($user['username'] === $username) {
          array_push($errors, 'Username already exists');
      }

      if ($user['email'] === $email) {
          array_push($errors, 'Email already exists');
      }
  }

  $password = password_hash($password_1, PASSWORD_DEFAULT); //encrypt the password before saving in the database

  $query = "INSERT INTO users (username, email, password) 
  VALUES('$username', '$email', '$password')";
  mysqli_query($db, $query);
  $_SESSION['email'] = $email;
  $gravatar = 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($email))) . '?d=identicon';
  mysqli_query($db, "UPDATE users SET avatar='$gravatar' WHERE email='$email'");
  $_SESSION['success'] = 'You are now logged in';
  header('location: ./index.php');
}



function login($db) {
  $errors = array();
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($email)) {
      array_push($errors, 'Email is required');
  }
  if (empty($password)) {
      array_push($errors, 'Password is required');
  }

  $hash = password_hash($password, PASSWORD_DEFAULT);
  $pass_check = password_verify($password, $hash);

  if (password_verify($password, $hash)) {
      $_SESSION['username'] = $username;
      $_SESSION['email'] = $email;
      $_SESSION['success'] = 'You are now logged in';
      
  } else {
      array_push($errors, 'Wrong email/password combination');
  }
}

// //NEW PASSWORD



// //NEW USERNAME


// var_dump($change_usr);
                          
//AVATAR

$email = $_SESSION['email'];

$gravatar = 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($email))) . '?d=identicon';

function recup_avatar($db){
    $email = $_SESSION['email'];
    $result = mysqli_query($db, "SELECT avatar FROM users WHERE email='$email'");
    $row = mysqli_fetch_assoc($result);
    var_dump($result);
    var_dump($row['avatar']);
}

function change_username(){
  echo '<label for="username_new" class="text-info" >Enter new Username:</label><br>';
  echo '<input type="text" name="username_new" id="username_new" class="form-control"  value="" ><br>';
  echo '<input type="submit" name="use_new" class="btn btn-info btn-md" value="submit"><br>';
}

function username_change($db){
    $username_new = $_POST['username_new'];
$email = $_SESSION['email'];
$change_usr = mysqli_query($db, "UPDATE users SET username = '$username_new' WHERE email = '$email'");
}

function change_pass(){
    echo '<label for="password_old" class="text-info" >Enter Old Password:</label><br>';
    echo '<input type="password" name="password_old" id="password_old" class="form-control"  value="" ><br>';
    echo '<label for="password_new" class="text-info" >Enter New Password:</label><br>';
    echo '<input type="password" name="password_new" id="password_new1" class="form-control"  value="" ><br>';
    echo '<label for="password_confirm" class="text-info" > Confirm New Password:</label><br>';
    echo '<input type="password" name="password_confirm" id="password_new2" class="form-control"  value="" ><br>';
    echo '<input type="submit" name="submit_pass" id="submit_pass" class="btn btn-info btn-md"  value="Submit" ><br>';
}

function pass_change($db){
    $email = $_SESSION['email'];
  $pass_old = $_POST['password_old'];
  $hash = password_hash($pass_old, PASSWORD_DEFAULT);
  $pass_new1 = $_POST['pasword_new']; 
  $pass_new2 = $_POST['pasword_confirm']; 
  $pass_new = password_hash($pass_new1, PASSWORD_DEFAULT);
                                        
  if (password_verify($pass_old, $hash) && ($pass_new1 == $pass_new2)){
      
      mysqli_query($db, "UPDATE users SET password='$pass_new' WHERE email='$email'");
  } else {
      echo 'Wrong password (old or new)';
  }

}
