<?php
    $isLoggedIn = $_SESSION['isLogged'];
    $notLoggedIn = !(isset($isLoggedIn) && $isLoggedIn);

    if($notLoggedIn){
        header('Location: index.php');
    }
?>