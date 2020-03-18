<?php
session_start();

// initializing variables
$username = '';
$email = '';


// connect to the database
// $db = mysqli_connect('remotemysql.com', 'qpBidspZIE', 'UR92tr5A42', 'qpBidspZIE');
// $db = mysqli_connect('eu-cdbr-west-02.cleardb.net', 'b6ce3f355cfde8', 'fd44f147', 'heroku_4a25fe8af1897c7');
// $host = "g4yltwdo6z0izlm6.chr7pe7iynqr.eu-west-1.rds.amazonaws.com";
// $dbname = "kxda9r88l71g6qmh";
// $user = "fa6nqso0nfvipgp1";
// $pass = "cz8wfcdeh1cs95l9";

$host = "mysql";
$dbname = "mydb";
$user = "root";
$pass = "root";
$db = new PDO("mysql:host=" . $host . "; dbname=" . $dbname, $user, $pass);

function delete_profile($db)
{
    // $db = mysqli_connect('mysql', 'root', 'root', 'mydb');
    $email = $_SESSION['email'];
    $query =$db->prepare("DELETE FROM `users` WHERE `email` = '$email'");
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $query->closeCursor();
    $query = null;
}

function logout()
{

    session_start();
    unset($_SESSION['user_session']);

    if (session_destroy()) {
        header("Location: index.php");
    }
}


function register($db)
{
    
    // receive all input values from the form
    $username = strip_tags($_REQUEST['username']);
    $email = strip_tags($_REQUEST['email']);
    $password_1 = strip_tags($_REQUEST['password_1']);
    $password_2 = strip_tags($_REQUEST['password_2']);

    // form validation: ensure that the form is correctly filled ...
    if (empty($username)) {
        echo '<div class="text-white">Username is required</div>';
    }
    if (empty($email)) {
        echo '<div class="text-white">Email is required</div>';
    }
    if (empty($password_1)) {
        echo '<div class="text-white">Password is required</div>';
    }
    if (empty($password_2)) {
        echo '<div class="text-white">Confirm password is required</div>';
    }
    if ($password_1 != $password_2) {
        echo '<div class="text-white">The two password do not match</div>';
    }

    // first check the database to make sure
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM `users` WHERE `username` = '$username' OR `email` = '$email' LIMIT 1";
    $sth = $db->prepare($user_check_query);
    $sth->execute();
    $user = $sth->fetchAll(PDO::FETCH_OBJ);
    $sth->closeCursor();
    $sth = null;

    if ($user) {
        // if user exists
        if ($user['username'] === $username) {
            echo '<div class="text-white">Username already exists</div>';
        }

        if ($user['email'] === $email) {
            echo '<div class="text-white">Email already exists</div>';
        }
    }

    $password = password_hash($password_1, PASSWORD_DEFAULT); //encrypt the password before saving in the database

    $query = "INSERT INTO `users` (username, email, password) 
VALUES('$username', '$email', '$password')";
    $sth = $db->prepare($query);
    $sth->execute();
    $_SESSION['email'] = $email;
    $gravatar = 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($email))) . '?d=identicon';
    $stmt = "UPDATE `users` SET `avatar` = '$gravatar' WHERE `email` = '$email'";
    $sth = $db->prepare($stmt);
    $sth->execute();
    $_SESSION['success'] = 'You are now logged in';
    header('location: ./index.php');
}



function login($db)
{
    
    $email = strip_tags($_REQUEST['email']);
    $password = strip_tags($_REQUEST['password']);

    
    if (empty($email)) {
        echo '<div class="text-white">Email is required</div>';
    }
    if (empty($password)) {
        echo '<div class="text-white">Password is required</div>';
    }

    // $hash = password_hash($password, PASSWORD_DEFAULT);

    $result = "SELECT * FROM `users` WHERE `email` = '$email'";
    $sth = $db->prepare($result);
    $sth->execute();
    $row = $sth->fetch();
    $pass = $row['password'];
    $idusers = $row['idusers'];
    $username = $row['username'];
   
 

    if (password_verify($password, $pass)) {
        $_SESSION['idusers'] = $idusers;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['success'] = 'You are now logged in';
        echo '<script>window.location.href="../index.php"</script>';
    } else {
        echo '<div class="text-white">Wrong email/password combination</div>';
        var_dump($row['username']);
        var_dump($row['idusers']);
        var_dump($pass);
        var_dump($row['password']);
    }
 
    }



// //NEW PASSWORD



// //NEW USERNAME


// var_dump($change_usr);

//AVATAR

$email = $_SESSION['email'];

$gravatar = 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($email))) . '?d=identicon';


function change_username()
{
    echo '<label for="username_new" class="text-info" >Enter new Username:</label><br>';
    echo '<input type="text" name="username_new" id="username_new" class="form-control"  value="" ><br>';
    echo '<input type="submit" name="use_new" class="btn btn-info btn-md" value="submit"><br>';
}

function username_change($db)
{
    $username_new = $_POST['username_new'];
    $email = $_SESSION['email'];
    $sql = "UPDATE `users` SET `username` = '$username_new' WHERE `email` = '$email'";
    $sth = $db->prepare($sql);
    $sth->execute();
    $sth->closeCursor();
    $sth = null;
}

function change_pass()
{
    echo '<label for="password_old" class="text-info" >Enter Old Password:</label><br>';
    echo '<input type="password" name="password_old" id="password_old" class="form-control"  value="" ><br>';
    echo '<label for="password_new" class="text-info" >Enter New Password:</label><br>';
    echo '<input type="password" name="password_new" id="password_new1" class="form-control"  value="" ><br>';
    echo '<label for="password_confirm" class="text-info" > Confirm New Password:</label><br>';
    echo '<input type="password" name="password_confirm" id="password_new2" class="form-control"  value="" ><br>';
    echo '<input type="submit" name="submit_pass" id="submit_pass" class="btn btn-info btn-md text-align-center"  value="Submit" ><br>';
}

function pass_change($db)
{
    $email = $_SESSION['email'];
    $pass_old = $_POST['password_old'];
    $pass_new1 = $_POST['pasword_new'];
    $pass_new2 = $_POST['pasword_confirm'];
    $pass_new = password_hash($pass_new1, PASSWORD_DEFAULT);

    $sql = "SELECT `password` FROM `users` WHERE `email` = '$email'";
    $sth = $db->prepare($sql);
    $sth->execute();
    $pass = $sth->fetchColumn();
    $sth->closeCursor();
    $sth = null;


    if (password_verify($pass_old, $pass) && ($pass_new1 == $pass_new2)) {

        $query = "UPDATE `users` SET `password` = '$pass_new' WHERE `email` = '$email'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->closeCursor();
        $stmt = null;

    } else if ($pass_new1 != $pass_new2) {
        echo 'Passwords must be the same';
    }else if(password_verify($pass_old, $pass) == false) {
        echo 'Current password is not correct';
    }

}

?>