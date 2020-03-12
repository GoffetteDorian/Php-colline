<?php
include('./model/config.php');
include('./view/Parsedown.php');

$topic = getCurrentTopic($pdo, $_GET["topic"]);
$currentUserId = getUserIdByEmail($pdo, $_SESSION["email"]);


if (isset($_POST["edit"])) {
  $currentMessageId = $_POST["edit"];
}

if (isset($_POST["send_edit"])) {
  $update = [
    "idMessages" => $_POST["send_edit"],
    "content" => $_POST["content"],
  ];

  updateMessage($pdo, $update);
  goToURL($_SERVER["REQUEST_URI"]);
}

if (isset($_POST["delete"])) {
  // echo "<pre>";
  // print_r($_POST);
  // echo "</pre>";
  deleteMessage($pdo, $_POST["delete"]);
  goToURL($_SERVER["REQUEST_URI"]);
}

?>


<?php  ?>

<div class="container">
  <div class="py-5 text-center">
    <h3><?php echo $topic["title"]; ?></h3>
  </div>

  <?php require("./view/breadcrumb.php") ?>

  <!-- Showing all messages -->
  <ul class="list-group">
    <?php
    $messages = getTopicsMessages($pdo, $topic["idtopics"]);

    foreach ($messages as $message) { ?>

      <li class="list-group-item">
        <!-- Message -->
        <div class="row">
          <div class="col-sm-10">
            <?php
            $messageId = $message["idmessages"];
            $messageUserId = $message["users_idusers"];
            ?>
            <?php if (isset($_POST["edit"]) && $messageId == $currentMessageId) { ?>
              <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
                <textarea name="content" class="" row="5"><?php echo $message["content"] ?></textarea>
                <button type="submit" name="send_edit" class="btn btn-success" value="<?php echo $message["idmessages"] ?>">Send</button>
              </form>
            <?php } else {
              if ($message["deleted"] == 1) {
                echo "Message Deleted";
              } else {
                $parse = new Parsedown();
                echo $parse->text($message["content"]);
              }
            ?>
              <hr />
              <div class="text-center">
                <?php
                echo $parse->text($message["signature"]);
                ?>
              </div>
            <?php } ?>
            <?php
            if (!isset($_POST["edit"]) && !$message["deleted"] == 1) {
              if ($currentUserId == $messageUserId) { ?>
                <div class="col-sm-4">
                  <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
                    <button type="submit" name="edit" class="btn btn-outline-success" value="<?php echo $message["idmessages"] ?>">edit</button>
                    <button type="submit" name="delete" class="btn btn-outline-danger" value="<?php echo $message["idmessages"] ?>">delete</button>
                  </form>
                </div>
              <?php } ?>
            <?php } ?>
          </div>



          <!-- User writing the message -->
          <div class="col-sm-2">
            <div class="card">
              <div class="card-body">
                <img class="" src="<?php echo $message["avatar"]; ?>" alt="placeholder img">
                <div class="card-title text-center">
                  <h4><?php echo $message["username"]; ?></h4>
                </div>
                <?php echo $message["creation_date"]; ?>
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

            <!-- <input type="text" class="form-control" name="content" id="content" placeholder value required data-emojiable="true"> -->
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