<?php
  // require_once("./config.php");
  $request = $_SERVER['REQUEST_URI'];
  
  switch($request){
    default: 
      require __DIR__ . '/view/index.php';
      break;

    // default: 
    //   http_response_code(404);
    //   require __DIR__ . '/view/404.php';
    //   break;
  }
?>
