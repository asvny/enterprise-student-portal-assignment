<?php
  
  $role_name = $_SESSION["role"] == 0 ? "Guest" : "Admin";
  $privilege = $_SESSION["role"] == 0 ? "normal" : "administrator";
  
  $isAdmin = $_SESSION["role"] == 1;
?>

<a href="index.php">Home</a>,<br>

Welcome, <?= $role_name ?><br>

You are now logged in under <strong><?= $privilege ?></strong> privilege<br>

<a class="mt-4 d-block" href="index.php?command=logout">Logout</a>

<a class="d-block" href="sensors.php">View environmental data</a>

<?php
  if ($isAdmin) {
?>
<a class="d-block" href="add-student.php">Add student</a>
<?php
  }
?>