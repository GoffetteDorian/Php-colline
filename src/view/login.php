<?php 
  include('./model/config.php');
  if (isset($_POST['submit'])) {
    login($db);
    goToURL("./view/profile.php");
  }
?>
<div id="login">
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="" method="post">
                        <h3 class="text-center text-info">Login</h3>
                        <div class="form-group">
                            <label for="email" class="text-info">Email:</label><br>
                            <input type="text" name="email" id="email" class="form-control">
    
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Password:</label><br>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <a href="./view/forgot.php"><button class="btn btn-info btn-md" type="button">Forgot Password?</button></a><br><br>
                            <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">

                        </div>
                        <div id="register-link" class="form-group text-right">
                            <a href="./view/register.php" class="text-info">Register here</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
