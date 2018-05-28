<?php
  
  include("session.php");
  include("templates/header.php");
  include("db.php");
  
  $template = "templates/login.php";
  
  $command  = $_GET["command"];
  $isLogout = isset($command) && $command == 'logout';
  
  if ($isLogout) {
      $DB->logout();
  }
  
  $username = $_REQUEST["username"];
  $password = $_REQUEST["password"];
  $captcha  = $_REQUEST["captcha"];
  
  $hasValues = isset($username) && isset($password) && isset($captcha);
  
  if ($hasValues) {
      $DB->authenticate($username, $password, $captcha);
  }
  
  
  $isLogged = $_SESSION["isLogged"];
  
  if (isset($isLogged) && $isLogged) {
      $template = "templates/logged.php";
  }
  
  include($template);
  
  include("templates/footer.php");
  
?>