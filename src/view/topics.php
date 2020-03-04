<ul class="list-group">
  <?php foreach($topics as $topic){ ?>
    <li class="list-group-item">
      <h3><?php echo $topic["title"]; ?></h3>
      <ul class="list-group">
        <?php foreach($messages as $message){ ?>
          <li class="list-group-item"></li>
        <?php } ?>
        
      </ul>
    </li>
  <?php } ?>
</ul>