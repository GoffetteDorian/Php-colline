<?php foreach($boards as $board){ ?>
  <li class="nav-item active">
    <a class="nav-link" href="index.php?board=<?php echo $board["name"]; ?>"><?php echo $board["name"]; ?></a>
  </li>
<?php } ?>



<h2><?php echo $board["name"]; ?></h2>




<li class="list-group-item">   
            <h4><?php echo $message["username"]; ?></h4>
            <?php echo $message["creation_date"]; ?>
            <?php echo $message["content"]; ?>
          </li>