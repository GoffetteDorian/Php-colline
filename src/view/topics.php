<?php $topic = getCurrentTopic($pdo, $_GET["topic"]); ?>

<div class="container">

  <!-- Showing all messages -->
  <div class="py-5 text-center">
    <h3><?php echo $topic["title"]; ?></h3>
  </div>
  <ul class="list-group">
    <?php 
      $messages = getTopicsMessages($pdo, $topic["idtopics"]); 
      foreach($messages as $message){ ?>
      <li class="list-group-item">  
        <div class="row">
          <div class="col-sm-10">
            <?php echo $message["content"]; ?>
          </div>
          <div class="card col-sm-2">
            <div class="card-body">
              <img class="card-img-top" src="" alt="placeholder img">
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
  <div class="card">
    <div class="card-body">
      <form action="create_message.php">
        <div class="row">
          <div class="col-md-10">
            <label for="content">New message</label>
            <input type="text" class="form-control" name="content" id="content" placeholder value required>
          </div>
          <div class="col-md-2 text-right">
            <button class="btn btn-primary btn-sm" type="submit">Envoyer</button>
          </div>
        </div>
      </form>  
    </div>
  </div>



</div>