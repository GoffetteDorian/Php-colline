<?php include('../model/config.php'); ?>

<!DOCTYPE html>
<html>
<head>
  <title>forgot</title>
 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
 <link rel="stylesheet" type="text/css" href="../public/css/forgot.css">

</head>
<body>
    <div id="forgot">
        <div class="container">
            <div id="forgot-row" class="row justify-content-center align-items-center">
                <div id="forgot-column" class="col-md-6">
                    <div id="forgot-box" class="col-md-12">
                        <form id="forgot-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">forgot</h3>
                            <div class="form-group">
                                <label for="email" class="text-info">Email:</label><br>
                                <input type="text" name="email" id="email" class="form-control"><br>
                                <input type="submit" name="forgot_pass" id="forgot_pass" class="btn btn-info btn-md">
                            <?php
                                if (isset($_POST['forgot_pass'])){
                                    
                                // envoi d'un email à webmaster@tutovisuel.com
                                mail($_POST['email'], "test", "test");
                                echo 'sent';
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
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>