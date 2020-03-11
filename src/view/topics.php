<?php include('./model/config.php'); ?>
<?php $topic = getCurrentTopic($pdo, $_GET["topic"]); ?>

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
            <?php echo $message["content"]; ?>
            <hr />
            <div class="text-center">
              <?php echo $message["signature"]; ?>
            </div>
          </div>

          <!-- User writing the message -->
          <div class="col-sm-2">
            <div class="card">
              <div class="card-body">
                <img class="card-img-top" src="<?php echo $message["avatar"]; ?>" alt="placeholder img">
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