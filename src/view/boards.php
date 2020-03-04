
<?php if(!isset($_GET["board"])){ ?>
  <ul class="list-group">
    <?php foreach($boards as $board){ ?>
      <a class="nav-link" href="index.php?board=<?php echo $board["name"]; ?>"><h3><?php echo $board["name"]; ?></h3>
        <li class="list-group-item">
          <ul class="list-group">
            <?php $topics = getLatestTopics($pdo, $board["idboards"]);
            foreach($topics as $topic){ ?>
              <h4><?php echo $topic["title"] ?></h4>
            <?php } ?>
          </ul>
        </li>
      </a>
    <?php } ?>
  </ul>
<?php } 
  else{ ?>
    <ul class="list-group">
    <?php 
    $topics = getCurrentTopics($pdo, $_GET["board"]);
    foreach($topics as $topic){ ?>
    <a class="nav-link" href="index.php?board=<?php echo $_GET["board"]; ?>?topic=<?php echo $topic["title"]; ?>">
      <li class="list-group-item">
        <h3><?php echo $topic["title"]; ?></h3>
      </li>
    <?php } ?>
    </ul>
<?php }?>