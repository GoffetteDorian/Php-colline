<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <ul class="navbar-nav mr-auto">
    <?php 
      foreach($boards as $board){
        echo '<li class="nav-item active">';
        echo '<a class="nav-link" href="#">' . $board["name"] . '</a>';
        echo '</li>';
      }
    ?>
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