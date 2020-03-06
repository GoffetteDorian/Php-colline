<?php
session_start();

// initializing variables
$username = '';
$email = '';
$errors = array();

// connect to the database
// $db = mysqli_connect('remotemysql.com', 'qpBidspZIE', 'UR92tr5A42', 'qpBidspZIE');
// $db = mysqli_connect('eu-cdbr-west-02.cleardb.net', 'b6ce3f355cfde8', 'fd44f147', 'heroku_4a25fe8af1897c7');
$db = mysqli_connect('mysql', 'root', 'root', 'mydb');

function delete_profile($db){
    // $db = mysqli_connect('mysql', 'root', 'root', 'mydb');
     $email = $_SESSION['email'];
     $query = "DELETE FROM users WHERE email='$email'";
     mysqli_query($db, $query);     
}

function logout()
{
    // Initialize the session
    session_start();

    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session.
    session_destroy();

    // Redirect to login page
    echo '<meta http-equiv="refresh" content="1;URL=login.php">';
    
}


function register($db){
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

        $password = md5($password_1); //encrypt the password before saving in the database

        $query = "INSERT INTO users (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
        mysqli_query($db, $query);
        $_SESSION['email'] = $email;
        $_SESSION['success'] = 'You are now logged in';
        header('location: ../index.php');
    }



function login($db) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($email)) {
        array_push($errors, 'Email is required');
    }
    if (empty($password)) {
        array_push($errors, 'Password is required');
    }

    $password = md5($password);
        $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $results = mysqli_query($db, $query);
        //    echo $_SESSION['password'];
        // echo $SESSION['email'];
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['success'] = 'You are now logged in';
            header('location: profile.php');
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


  


?>
