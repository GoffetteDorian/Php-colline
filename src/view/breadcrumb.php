

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
        <?php 
          $url = "index.php?board=" . $_GET["board"];
          if(isset($_GET["code"]) && $_GET["code"] == $code){
            $url .= "&code=" . $code;
          }
        ?>
        <a href="<?php echo $url ?>">
          <?php echo $_GET["board"]; ?>
        </a>
      </li>
      <li class="breadcrumb-item active">
        <?php echo $_GET["topic"]; ?>
      </li>
    <?php } ?>
  </ol>
</nav>
