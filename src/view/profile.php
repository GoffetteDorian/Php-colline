<?php include('../model/config.php'); ?>

<?php
if (isset($_POST['logout_profile'])) {
    logout();
    echo '<script language="javascript">window.location.href ="../index.php"</script>';
}
?>
<?php include('./Parsedown.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Profile</title>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../public/css/style.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="../public/css/emoji.css" rel="stylesheet">
</head>

<body>
    <?php require("./navbar.php"); ?>
    <?php
    if (isset($_SESSION['success']) && $_SESSION['success'] == true) { ?>


        <div id="profile">

            <div class="container">
                <div id="profile-row" class="row justify-content-center align-items-center">
                    <div id="profile-column" class="col-md-6">
                        <div id="profile-box" class="col-md-12">
                            <form id="profile-form" class="form" action="profile.php" method="post">
                                <h3 class="text-center text-info">
                                </h3>

                                <div class="text-center">
                                    <?php
                                    $email = $_SESSION['email'];
                                    $result = mysqli_query($db, "SELECT avatar FROM users WHERE email='$email'");
                                    $row = mysqli_fetch_assoc($result);
                                    $avatar = $row['avatar'];
                                    echo '<img src="' . $avatar . '" alt="avatar"/>';
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="text-info">Email</label><br>
                                    <input type="text" name="email_change" id="email_change" class="form-control" disabled='disabled' value="<?php echo $_SESSION['email']; ?>"><br>


                                </div>
                                <div class="form-group">
                                    <label for="username" class="text-info">Username</label><br>

                                    <div class="form-inline">
                                        <?php
                                        $email = $_SESSION['email'];
                                        $result = mysqli_query($db, "SELECT username FROM users WHERE email='$email'");
                                        $row = mysqli_fetch_assoc($result);
                                        $username = $row['username'];
                                        ?>
                                        <input type="text" name="username_new" id="use_new" class="form-control col-11" value="<?php echo $username; ?>" disabled="disabled">
                                        <button type="submit" name="use_change" id="username_change" class="form-control" value="">
                                            <i class="fa fa-pencil"></i>
                                        </button>

                                        <br>
                                    </div>
                                    <?php
                                    $count = 0;
                                    if (isset($_POST['use_change'])) {
                                        echo '<script>';
                                        echo 'document.getElementById("use_new").removeAttribute("disabled");';
                                        echo '</script>';
                                        echo '<script>';
                                        echo 'document.getElementById("username_change").setAttribute("name","user_change");';
                                        echo '</script>';
                                        $count++;
                                    }
                                    if (isset($_POST['user_change'])) {
                                        username_change($db);
                                        $count++;

                                        echo $count;
                                        if ($count == 1) {
                                            echo '<script language="javascript">window.location.href ="./profile.php"</script>';
                                        }
                                    }
                                    ?>
                                </div>




                                <div class="form-group">


                                    <?php

                                    change_pass();

                                    if (isset($_POST['submit_pass'])) {
                                        pass_change($db);
                                    }

                                    ?>
                                </div>
                                <div class='form-group'>
                                    <label for="signature" class="text-info">Signature</label><br>
                                    <?php
                                    $email = $_SESSION['email'];
                                    $query2 = "SELECT signature FROM users WHERE email='$email'";
                                    $modify = mysqli_query($db, $query2);
                                    $row = mysqli_fetch_assoc($modify);
                                    ?>
                                    <?php
                                    echo '<div class="lead emoji-picker-container">
                                    <textarea class="form-control textarea-control" rows="3" name="signature_change" data-emojiable="true disabled">' . $row["signature"] . '</textarea>

                                    </div><br>';
                                    echo '<input type="submit" name="modif_sign" class="btn btn-info btn-md" value="Modify"><br>';


                                    if (isset($_POST['modif_sign'])) {
                                        $email = $_SESSION['email'];
                                        $query2 = "SELECT signature FROM users WHERE email='$email'";
                                        $modify = mysqli_query($db, $query2);
                                        $row = mysqli_fetch_assoc($modify);
                                        $signature = mysqli_real_escape_string($db, $_POST['signature_change']);
                                        $query = "UPDATE users SET signature='$signature' WHERE email='$email'";
                                        mysqli_query($db, $query);
                                        echo '<meta http-equiv="refresh" content="0">';
                                    }

                                    ?>
                                </div>
                                <div class='form-group'>
                                    <input type="submit" name="logout_profile" id="logout_profile" class="form-control" value="Logout"><br>
                                </div>
                                <div class='form-group'>
                                    <input type="submit" name="delete_profile" id="delete_profile" class="form-control text-danger" value="DELETE PROFILE"><br>
                                    <?php
                                    if (isset($_POST['delete_profile'])) {
                                        echo '<input type="submit" name="delete_confirm" id="delete_profile" class="form-control text-danger"
                                    value="REALLY?"><br>';
                                    }
                                    if (isset($_POST['delete_confirm'])) {

                                        delete_profile($db);
                                        logout();
                                    }
                                    ?>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
        </script>




        <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="../public/lib/js/config.js"></script>
        <script src="../public/lib/js/util.js"></script>
        <script src="../public/lib/js/jquery.emojiarea.js"></script>
        <script src="../public/lib/js/emoji-picker.js"></script>
        <script>
            $(function() {
                // Initializes and creates emoji set from sprite sheet
                window.emojiPicker = new EmojiPicker({
                    emojiable_selector: '[data-emojiable=true]',
                    assetsPath: '../public/img/',
                    popupButtonClasses: 'fa fa-smile-o'
                });
                // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
                // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
                // It can be called as many times as necessary; previously converted input fields will not be converted again
                window.emojiPicker.discover();
            });
        </script>
        <script>
            // Google Analytics
            (function(i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function() {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-49610253-3', 'auto');
            ga('send', 'pageview');
        </script>
    <?php } ?>
    <?php

    if (empty($_SESSION['success'])) { ?>
        <link rel="stylesheet" type="text/css" href="../public/css/style.css">
        <div class="min-vh-100">
            <div class="notfound">
                <a class="error" href="../index.php">
                    <span>L</span>
                    <span>O</span>
                    <span>G</span>
                    <span>I</span>
                    <span>N</span>
                    <span><br></span>
                    <span>F</span>
                    <span>I</span>
                    <span>R</span>
                    <span>S</span>
                    <span>T</span>
                </a>
            </div>
        </div>
    <?php }
    ?>
</body>

</html>