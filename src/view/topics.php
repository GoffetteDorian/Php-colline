<?php
include('./model/config.php');
include('./view/Parsedown.php');

$topic = getCurrentTopic($pdo, $_GET["topic"]);
$currentUserId = getUserIdByEmail($pdo, $_SESSION["email"]);


if (isset($_POST["edit"])) {
  $currentMessageId = $_POST["edit"];
  goToURL($_SERVER["REQUEST_URI"], $_POST["edit"]);
}

if (isset($_POST["send_edit"])) {
  $update = [
    "idMessages" => $_POST["send_edit"],
    "content" => $_POST["content"],
  ];

  updateMessage($pdo, $update);
  goToURL($_SERVER["REQUEST_URI"], $_POST["send_edit"]);
}

if (isset($_POST["delete"])) {
  // echo "<pre>";
  // print_r($_POST);
  // echo "</pre>";
  deleteMessage($pdo, $_POST["delete"]);
  goToURL($_SERVER["REQUEST_URI"], $_POST["delete"]);
}



// BOARDS: SECRET - TOPICS
// $code = "s3cr3t";
// $code_validation = false;
// if(isset($_GET["board"]) && $_GET["board"] == "Very Secret"){
//   if(isset($_GET["code"]) && $_GET["code"] == $code){
//     $code_validation = true;
//   }
// }
?>


<?php if($code_validation || $_GET["board"] != "Very Secret"){  ?>
<div class="container">
  <div class="py-5 text-center">
    <h3><?php echo $topic["title"]; ?></h3>
  </div>

  <?php require("./view/breadcrumb.php") ?>

  <!--Close topic--> 
  <!-- --------------------------------------------------------------------------------------------------- -->    
  
  <?php
    $topicId = $topic["idtopics"];
    $topicUserId = $topic["users_idusers"];
    $close = $close["close"];

    if ($currentUserId == $topicUserId) { ?>
      <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
      <button type="submit" name="close" class="btn btn-danger active">Close the topic</button>
      </form>
      <?php } 
   
    else { ?>
      <button type="button" name="close" class="btn btn-primary" disable>Close the topic</button>
    <?php }


    if(isset($_POST['close'])){ 
          $close ++;
        }
        "UPDATE users SET close = '1' ";

    if($close === 1){
      echo "topic is close";
      }?>
    
  <!-- --------------------------------------------------------------------------------------------------- -->



  <!-- Showing all messages -->
  <ul class="list-group">
    <?php 
    $messages = getTopicsMessages($pdo, $topic["idtopics"]);

    foreach ($messages as $message) { ?>

      <li class="list-group-item">  
        <!-- Message -->
        <div class="row">
          <div class="col-lg-10">
            <div class="row">
              <div id="<?php echo $message["idmessages"] ?>" class="col-lg-10">
                <?php
                $messageId = $message["idmessages"];
                $messageUserId = $message["users_idusers"];
                ?>
                <?php if (isset($_POST["edit"]) && $messageId == $currentMessageId) { ?>

                  <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
                    <div class="col-lg-12 d-flex justify-content-end align-self-end">
                      <textarea name="content" class="col-lg-11" row="5"><?php echo $message["content"] ?></textarea>
                      <button type="submit" name="send_edit" class="btn col-lg-1 send" value="<?php echo $message["idmessages"] ?>"><img src="../public/img/send.svg"></button>
                  </form>
              </div>
            <?php } else {
                  if ($message["deleted"] == 1) {
                    echo "Message Deleted";
                  } else {
                    $parse = new Parsedown();
                    echo $parse->text($message["content"]);
                  }
            ?>
            </div>
            <!--btn edit-delete-->

            <?php
                  if (!isset($_POST["edit"]) && !$message["deleted"] == 1) {
                    if ($currentUserId == $messageUserId) { ?>
                <div class="col-lg-2 d-flex justify-content-end">
                  <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
                    <button type="submit" name="edit" class="btn deletedit" value="<?php echo $message["idmessages"] ?>"><img src="../public/img/edit.svg"></button>
                    <button type="submit" name="delete" class="btn deletedit" value="<?php echo $message["idmessages"] ?>"><img src="../public/img/cross.svg"></button>
                  </form>
                </div>
              <?php } ?>
            <?php } ?>

          </div>


          <hr />
          <div class="row">
            <div class="col-lg-10 signature d-flex align-end">
              <?php
                  echo $parse->text($message["signature"]);
              ?>

            <?php } ?>
            </div>

          </div>
        </div>


        <!-- User writing the message -->
        <div class="col-lg-2">
          <div class="card">
            <div class="card-body text-center">
              <div class="circle">
                <img class="rounded-circle" src="<?php echo $message["avatar"]; ?>" alt="placeholder img">
              </div>
              <div class="card-title">
                <h2> <?php echo $message["username"]; ?> </h2>
              </div>
              <h5><?php echo $message["creation_date"]; ?></h5>
            </div>
          </div>
        </div>
      </li>
    <?php } ?>
  </ul>

  <!-- Creating a new message -->
<div class="list-group">
    <div class="card-body">
      <form action="create_message.php" method="POST">
        <div class="row">
          <div class="col-md-10">
            <label for="content">New message</label>
            <textarea type="text" class="form-control textarea-control" name="content" id="content" rows="5" placeholder="Enter your message" data-emojiable="true" value required></textarea>

          </div>
          <div class="col-md-2 text-center d-flex align-items-end">

            <button class="btn btn-primary btn-sm btn-block" type="submit">Send</button>
          </div>
        </div>
      </form>  
    </div>
  </div>
</div>

<?php 
    } else { ?>
      <div class="no-code">
        <h1>YOU DO NOT HAVE ACCESS TO THIS PAGE</h1>
      </div>  
    
  <?php } ?>
