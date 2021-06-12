<?php

    session_start();

    if (array_key_exists("content", $_POST)) {
        
        $link = mysqli_connect("sdb-g.hosting.stackcp.net", "userDatabase-31383520f7", "fall2018", "userDatabase-31383520f7");
        if(mysqli_connect_error()){
            die("Error connecting to Database");
        }        
        $query = "UPDATE `users` SET `text` = '".mysqli_real_escape_string($link, $_POST['content'])."' WHERE email = '".mysqli_real_escape_string($link, $_SESSION['email'])."' LIMIT 1";
        
        mysqli_query($link, $query);
        
    }

?>
        
        
    