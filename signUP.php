<?php

    $error = "";
    if($_POST['sub']=='sb'){
        
        $link = mysqli_connect("sdb-g.hosting.stackcp.net", "userDatabase-31383520f7", "fall2018", "userDatabase-31383520f7");
        if(mysqli_connect_error()){
            die("Error connecting to Database");
        }

        $query = "SELECT `id` FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";

        $result = mysqli_query($link, $query);

        if(mysqli_num_rows($result) > 0){

            $error .= "<div class='alert alert-danger' role='alert'>Email address has already been taken<br></div>";
        
        }else{

            $hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);

            $query = "INSERT INTO `users`(`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', 
            '".mysqli_real_escape_string($link, $hash)."')";

            if(mysqli_query($link, $query)){
                $error .= "<div class='alert alert-success' role='alert'>You have been signed up!<br></div>";
            }
            else{
                $error .= "<div class='alert alert-danger' role='alert'>There was an error signing you up.<br> Please try again later</div>";
            }
        }
    }


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Register</title>

    <link rel = "icon" href = "https://www.iconbunny.com/icons/media/catalog/product/cache/2/thumbnail/600x/1b89f2fc96fc819c2a7e15c7e545e8a9/3/1/3146.6-documents-icon-iconbunny.jpg" type = "image/x-icon">

    <style>
    
        html, body{height:100%; margin:0;padding:0}

        body{
            background-color:#e0ffff;
        }

        #b{
            border: 3px solid #cccccc;
            border-radius: 3%;
            width:450px;
            background-color:#FFF;
        }

        @media only screen and
        (max-width : 1249px ) {

            #b{
                width:100%;
            }

        }
        
        .btn{
            width: 200px;
        }

    </style>

  </head>
  <body>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <div class="container h-100">
        
        <div class="row h-100 justify-content-center align-items-center">

            <form id = "b" class = "requires-validation p-5 m-5" novalidate method = "POST">
                
                <h1 class="text-center">Sign Up</h1>
                
                <div><?    echo $error;    ?></div>

                <div class="form-group">
                    <label for="Email">Email address</label>
                    <input type="email" class="form-control" id="Email" name = "email" placeholder="E-mail Address" aria-describedby="emailHelp" required  value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"/>
                    <div class="invalid-feedback">
                        Please enter a valid email.
                    </div>
                </div>
                <div class="form-group">
                    <label for="Password">Password</label>
                    <input type="password"  class="form-control" name = "pass" id="Password"placeholder="Password" value="<?php if (isset($_POST['pass'])) echo $_POST['pass']; ?>"/>
                    <div class="invalid-feedback">Password needs to be 8 characters long</div>
                </div>
                <div class="form-group">
                    <label for="confPassword">Confirm Password</label>
                    <input type="password"  class="form-control" name = "confpass" id="confPassword"placeholder="Confirm Password" value="<?php if (isset($_POST['confpass'])) echo $_POST['confpass']; ?>"/>
                    <div class="invalid-feedback">Password and confirm passwords do not match</div>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary" name = "sub" Value = "sb">Sign Up</button>
                </div>
                <p class = "mt-4">Already have an account?  <a href="http://barathdandu-com.stackstaging.com/7-MySQL/index.php" style="color:dodgerblue">Login</a>.</p>
            </form>
        </div>
    </div>    
       <script type="text/javascript">

       function emailCheck(){
            if($("#Email").val()==""){
                $("#Email").addClass('is-invalid');
                return false;
            }else{
                var regMail     =   /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;
                if(regMail.test($("#Email").val()) == false){
                    $("#Email").addClass('is-invalid');
                    return false;
                }else{
                    $("#Email").removeClass('is-invalid');
                    $("#Email").addClass('is-valid');
                    return true;
                }
    
            }
        }
        function passwordCheck(){
            if($("#Password").val().length > 7){
                $("#Password").removeClass('is-invalid');
                $("#Password").addClass('is-valid');
                return true;
            }else {
                $("#Password").addClass('is-invalid');
                return false;
            }
        }

        function confpasswordCheck(){
            if($("#confPassword").val() == $("#Password").val() && $("#confPassword").val().length > 7){
                $("#confPassword").removeClass('is-invalid');
                $("#confPassword").addClass('is-valid');
                return true;
            }else {
                $("#confPassword").addClass('is-invalid');
                return false;
            }
        }

        var alreadySubmitted = false;

        $("#Email, #Password, #confPassword").keyup(function(){
            if(alreadySubmitted == true){
                emailCheck();
                passwordCheck();
                confpasswordCheck();
            }
        });
        $("form").submit(function(e) {
            
            if(emailCheck() != true || passwordCheck() != true || confpasswordCheck() != true){
                e.preventDefault();
                emailCheck();
                passwordCheck();
                confpasswordCheck();
                alreadySubmitted = true;
            }
        });

    </script>


  </body>
</html>     