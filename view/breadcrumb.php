<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="/">Home</a>
    </li>
    <?php if(!isset($_GET["topic"])){ ?>
      <li class="breadcrumb-item active">
        <?php echo $_GET["board"]; ?>
      </li>
    <?php }
      else { ?>
      <li class="breadcrumb-item">
        <a href="index.php?board=<?php echo $_GET["board"]; ?>">
          <?php echo $_GET["board"]; ?>
        </a>
      </li>
      <li class="breadcrumb-item active">
        <?php echo $_GET["topic"]; ?>
      </li>
    <?php } ?>
  </ol>
</nav>