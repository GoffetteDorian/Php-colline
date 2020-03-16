<!-- REQUIRE DESIGNING -->
<div class="container">
<?php 
  $boards = getBoards($pdo);
  if(!isset($_GET["board"])){ ?>

  <!-- Showing list of all boards if no board is already selected (on index) -->
  <ul class="list-group">
    <?php foreach($boards as $board){ ?>
        <div class="board">
          <a class="nav-link" href="index.php?board=<?php echo $board["name"]; ?>">
            <h3><?php echo $board["name"]; ?></h3>
          </a>
          <span><?php echo $board["description"] ?></span>
        </div>
        <!-- Showing first 3 topics corresponding to most recent messages -->
        <li class="list-group-item">
          <ul class="list-group">
            <?php $topics = getLatestTopics($pdo, $board["idboards"]); ?>
            <?php foreach($topics as $topic){ ?>
              <a class="nav-link" href="index.php?board=<?php echo $board["name"]; ?>&topic=<?php echo $topic["title"]; ?>">
                <h4><img src="../public/img/bubble.svg"><?php echo $topic["title"] ?></h4>
              </a>
              <h5><?php echo $topic["creation_date"]; ?></h5>
            <?php } ?>
          </ul>
        </li>
      
    <?php } ?>
  </ul>
<?php } 
else{ 
  $currentBoard = getBoardByName($pdo, $_GET["board"]);
  //echo "<pre>"; print_r($currentBoard); echo "</pre>";
  ?>
  
  <div class="py-5 text-center">
    <h3><?php echo $currentBoard["name"]; ?></h3>
    <span><?php echo $currentBoard["description"]; ?></span>   
  </div>
  <?php require("./view/breadcrumb.php"); ?>
  <!-- Creation of new topic in board -->
  <div class="list-group">
    <div class="card-body">
      <h4>New topic</h4>
      <form action="create_topic.php" method="POST">
        <div class="row">
          <div class="col-md-10">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" placeholder value required>
          </div>
          <div class="col-md-2 text-center d-flex align-items-end">
            <button class="btn btn-primary btn-sm btn-block" type="submit">Create topic</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <hr />


  <!-- Showing the list of all topics -->
  <ul class="list-group">
    <li class="list-group-item">
      <?php $topics = getCurrentTopics($pdo, $_GET["board"]); ?>
      <?php foreach($topics as $topic){ ?>
              <a class="nav-link" href="index.php?board=<?php echo $_GET["board"]; ?>&topic=<?php echo $topic["title"]; ?>">
                <h4><img src="../public/img/bubble.svg"><?php echo $topic["title"]; ?></h4>
              </a>
              <h5><?php echo $topic["creation_date"]; ?></h5>
      <?php } ?>
    </li>
  </ul>
  
<?php }?>
</div>