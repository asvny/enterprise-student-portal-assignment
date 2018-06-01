<?php
    $isGuest = $_SESSION["role"] == ROLE_NORMAL;

    if($isGuest){
        header('Location: index.php');
    }
?>