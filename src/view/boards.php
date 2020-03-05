<!-- REQUIRE DESIGNING -->


<?php if(!isset($_GET["board"])){ ?>
  <ul class="list-group">
    <?php foreach($boards as $board){ ?>
        <div class="board">
          <a class="nav-link" href="index.php?board=<?php echo $board["name"]; ?>">
            <h3><?php echo $board["name"]; ?></h3>
          </a>
          <span><?php echo $board["description"] ?></span>
        </div>
        <li class="list-group-item">
          <ul class="list-group">
            <?php $topics = getLatestTopics($pdo, $board["idboards"]);
            foreach($topics as $topic){ ?>
              <a class="nav-link" href="index.php?board=<?php echo $board["name"]; ?>?topic=<?php echo $topic["title"]; ?>">
                <h4><?php echo $topic["title"] ?></h4>
              </a>
              <p><?php echo $topic["creation_date"]; ?></p>
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
  
  <div>
    <h3><?php echo $currentBoard["name"]; ?></h3>
    <p><?php echo $currentBoard["description"]; ?></p>   
  </div>
  <ul class="list-group">
  <?php 
  $topics = getCurrentTopics($pdo, $_GET["board"]);
  foreach($topics as $topic){ ?>
  <a class="nav-link" href="index.php?board=<?php echo $_GET["board"]; ?>?topic=<?php echo $topic["title"]; ?>">
    <li class="list-group-item">
      <h3><?php echo $topic["title"]; ?></h3>
      <p><?php echo $topic["creation_date"]; ?></p>
    </li>
  <?php } ?>
  </ul>
<?php }?>