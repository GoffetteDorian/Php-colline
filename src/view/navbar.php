<nav class="navbar navbar-expand-lg navbar-light bg-light red">
  <ul class="navbar-nav mr-auto">
    <?php foreach($boards as $board){ ?>
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo $board["name"]; ?>"><?php echo $board["name"]; ?></a>
      </li>
    <?php } ?>
  </ul>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item active">
      <a class="nav-link" href="#">home</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="#">profile</a>
    </li>
  </ul>
</nav>