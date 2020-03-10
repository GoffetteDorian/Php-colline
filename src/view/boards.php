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
          
        </div>
        <!-- Showing first 3 topics corresponding to most recent messages -->
          <li class="list-group-item">
            <div class="board">
              <span><?php echo $board["description"] ?></span>

              <?php $topics = getLatestTopics($pdo, $board["idboards"]);
              foreach($topics as $topic){ ?>
                <a class="nav-link" href="index.php?board=<?php echo $board["name"]; ?>&topic=<?php echo $topic["title"]; ?>">
                  <h4><img src="./view/images/message.svg"><?php echo $topic["title"] ?></h4>
                </a>
                <p><?php echo $topic["creation_date"]; ?></p>
              <?php } ?>
            </div>
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
    <p><?php echo $currentBoard["description"]; ?></p>   
  </div>

  <?php require("./view/breadcrumb.php") ?>
  <!-- Creation of new topic in board -->
  <div class="card">
    <div class="card-body">
      <h4>New topic</h4>
      <form action="create_topic.php" method="POST">
        <div class="row">
          <div class="col-md-8">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" placeholder value required>
          </div>
          <div class="col-md-4 text-right text-bottom">
            <button class="btn btn-primary btn-lg" type="submit">Create topic</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <hr />


  <!-- Showing the list of all topics -->
  
  <ul class="list-group">
    <?php 
    $topics = getCurrentTopics($pdo, $_GET["board"]);
    foreach($topics as $topic){ ?>
      <li class="list-group-item">
        <div class="row">
          <div class="col-sm-6">
            <a href="index.php?board=<?php echo $_GET["board"]; ?>&topic=<?php echo $topic["title"]; ?>">
              <h3><?php echo $topic["title"]; ?></h3>
            </a>
          </div>
          <div class="col-sm-6">
            <p><?php echo $topic["creation_date"]; ?></p>
          </div>
        </div>
      </li>
    <?php } ?>
  </ul>
  
<?php }?>
</div>