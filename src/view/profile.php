<?php include('../model/config.php') ?>
<!DOCTYPE html>
<html>

<head>
    <title>Profile</title>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./public/css/profile.scss">
</head>

<body>
    <div id="profile">

        <div class="container">
            <div id="profile-row" class="row justify-content-center align-items-center">
                <div id="profile-column" class="col-md-6">
                    <div id="profile-box" class="col-md-12">
                        <form id="profile-form" class="form" action="profile.php" method="post">
                            <h3 class="text-center text-info">Profile</h3>
                            <div class="text-center">
                            <img src="<?php echo $gravatar; ?>" alt="avatar">
                            </div>
                            <div class="form-group">
                                <label for="email" class="text-info">Email</label><br>
 <input type="text" name="email_change" id="email_change" class="form-control" disabled='disabled' value="<?php echo $_SESSION['email']; ?>"><br>


                            </div>
                            <div class="form-group">

                                <input type="submit" name="username_change" id="username_change" class="form-control"
                                    value="Change Username"><br>
                                <?php
                                if (isset($_POST['username_change'])) {
                                    echo '<label for="username_new" class="text-info" >Enter new Username:</label><br>';
                                    echo '<input type="text" name="username_new" id="username_new" class="form-control"  value="" ><br>';
                                    echo '<input type="submit" name="use_new" class="btn btn-info btn-md" value="submit"><br>';
                                }
                                if (isset($_POST['use_new'])) {
                                    $username_new = $_POST['username_new'];
                                    $email = $_SESSION['email'];
                                    $change_usr = mysqli_query(
                                        $db,
                                        "UPDATE users SET username = '$username_new' WHERE email = '$email'"
                                    );
                                }
                                ?>


                            </div>




                            <div class="form-group">
                                <input type="submit" name="password_change" id="password_change" class="form-control"
                                    value="Change Password"><br>
                                    <?php
                                    if (isset($_POST['password_change'])) {
                                        echo '<label for="password_old" class="text-info" >Enter Old Password:</label><br>';
                                        echo '<input type="password" name="password_old" id="password_old" class="form-control"  value="" ><br>';
                                        echo '<label for="password_new" class="text-info" >Enter New Password:</label><br>';
                                        echo '<input type="password" name="password_new" id="password_new1" class="form-control"  value="" ><br>';
                                        echo '<label for="password_confirm" class="text-info" > Confirm New Password:</label><br>';
                                        echo '<input type="password" name="password_confirm" id="password_new2" class="form-control"  value="" ><br>';
                                        echo '<input type="submit" name="submit_pass" id="submit_pass" class="form-control"  value="" ><br>';
                                    }

                                    if (isset($_POST['submit_pass'])) {
  $email = $_SESSION['email'];
  $pass_old = $_POST['password_old'];
  $hash = md5($pass_old);
  $pass_new1 = $_POST['pasword_new']; 
  $pass_new2 = $_POST['pasword_confirm']; 
  $pass_new = md5($pass_new1);
  $result = mysqli_query($db, "SELECT password FROM users WHERE email = '$email'");
  $pass_check = mysqli_fetch_array($result);
  $check_pass = $pass_check['password'];

                                                             
  if (($hash == $check_pass) && ($pass_new1 == $pass_new2)){
      
      mysqli_query($db, "UPDATE users SET password='$pass_new' WHERE email='$email'");
  } else {
      echo 'Wrong password (old or new)';
  }
  }  
 
                                    ?>
                            </div>
                                                    <div class='form-group'>
                                <input type="submit" name="signature" id="signature" class="form-control"
                                    value="Change signature"><br>
                              <?php if (isset($_POST['signature'])) {
    echo '<textarea name="signature_text" id="signature_text" rows="4" cols="50"></textarea><br>';
    echo '<input type="submit" name="change_sign" class="btn btn-info btn-md" value="submit"><br>';
                              }

                              if (isset($_POST['change_sign'])){
                                  $email = $_SESSION['email'];
                                  $signature = mysqli_real_escape_string($db, $_POST['signature_text']);
                                  $query = "UPDATE users SET signature='$signature' WHERE email='$email'";
                                  mysqli_query($db, $query);
                              }
                              
                              ?>
                            </div>
                            <div class='form-group'>
                                <input type="submit" name="logout_profile" id="logout_profile" class="form-control"
                                    value="Logout"><br>
                              <?php if (isset($_POST['logout_profile'])) {
                                  logout();
                              } ?>
                            </div>
                            <div class='form-group'>
                                <input type="submit" name="delete_profile" id="delete_profile" class="form-control text-danger"
                                    value="DELETE PROFILE"><br>
                                    <?php
                                    if (isset($_POST['delete_profile'])){
                                        echo '<input type="submit" name="delete_confirm" id="delete_profile" class="form-control text-danger"
                                    value="REALLY?"><br>';
                                    }
                                    if (isset($_POST['delete_confirm'])){
                                        echo 'deleted';
                                    }
?>
                            </div>
    
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>

</html>