<ul class="list-group">
  <?php foreach($topics as $topic){ ?>
    <li class="list-group-item">
      <h3><?php echo $topic["title"]; ?></h3>
      <ul class="list-group">
        <?php 
          $messages = getTopicsMessages($pdo, $topic["idtopics"], 3); 
          foreach($messages as $message){ ?>
          <li class="list-group-item">   
            <h4><?php echo $message["username"]; ?></h4>
            <?php echo $message["creation_date"]; ?>
            <?php echo $message["content"]; ?>
          </li>
        <?php } ?>
        
      </ul>
    </li>
  <?php } ?>
</ul>