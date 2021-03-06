<?php include('../model/config.php'); ?>
<?php
  if (isset($_POST['register'])) {
  register($db);
  header('location: /');  
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../public/css/style.css">
</head>
<body>
<?php require("./navbar.php"); ?>
<div id="register">
        
        <div class="container">
            <div id="register-row" class="row justify-content-center align-items-center">
                <div id="register-column" class="col-md-6">
                    <div id="register-box" class="col-md-12">
                        <form id="register-form" class="form" action="register.php" method="post">
                            <h3 class="text-center">Register</h3>
                            <div class="form-group">
                                <label for="username" class="">Username</label><br>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="">Password</label><br>
                                <input type="password" name="password_1" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="t">Confirm Password</label><br>
                                <input type="password" name="password_2" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email" class="">Email</label><br>
                                <input type="text" name="email" id="email" class="form-control"><br>
                                <input type="submit" name="register" class="btn btn-info btn-md btn-block" value="submit">
                            </div>

                        <div class="row">
                            <a href="../index.php" class="col-md-12 text-right">Already have an account?</a>
                        </div>                        
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>