<?php

    $msg = '';

    $content = '';

    session_start();

    if(array_key_exists("email", $_COOKIE) && $_COOKIE['email']){
        $_SESSION['email'] = $_COOKIE['email'];
    }

    if(array_key_exists("email", $_SESSION) && $_SESSION['email']){
        
        $msg  .= "Welcome ".$_SESSION['email'];

        $link = mysqli_connect("sdb-g.hosting.stackcp.net", "userDatabase-31383520f7", "fall2018", "userDatabase-31383520f7");
        if(mysqli_connect_error()){
            die("Error connecting to Database");
        }  

        $query = "SELECT `text` FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_SESSION['email'])."' LIMIT 1";

        $row = mysqli_fetch_array(mysqli_query($link, $query));

        $content = $row['text'];

    }
    else{
        header("Location: http://barathdandu-com.stackstaging.com/7-MySQL/index.php"); 
        exit();
    }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Docs</title>

    <link rel = "icon" href = "https://www.iconbunny.com/icons/media/catalog/product/cache/2/thumbnail/600x/1b89f2fc96fc819c2a7e15c7e545e8a9/3/1/3146.6-documents-icon-iconbunny.jpg" type = "image/x-icon">

    <style>

    body {
        margin: 0;
        background-color:#e0ffff;
    }
    textarea {
        width: 100%;
        height: 92vh;
        border: none;
        background-color: transparent;
        resize: none;
        outline: none;
        }

    </style>

  </head>
  <body>
   
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" >Docs</a>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" "><?php   echo  $msg;  ?></a>
                </li>
            </ul>
                <a href = "http://barathdandu-com.stackstaging.com/7-MySQL/index.php?logout=1" type="button" class="btn btn-warning">Log Out</a>
            </div>
        </div>
    </nav>
   
    <div class="container-fluid">
    
        <textarea class = "mt-3 form-control">
        <?php echo $content; ?>
        </textarea>
    
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <script type = "text/javascript">
    
    $("textarea").bind('input propertychange', function(){

        $.ajax({
            method: "POST",
            url: "http://barathdandu-com.stackstaging.com/7-MySQL/updatedatabase.php/",
            data: {content: $("textarea").val()}
        });

    });

    </script>

  </body>
</html>