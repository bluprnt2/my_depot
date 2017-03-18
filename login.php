<!DOCTYPE html>

<html>
    <head>
        <title>Login Form</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!With this we connect CSS and HTML>
        <link rel = "stylesheet" type = "text/css" href="style.css"/>
        <!With this we connect font-awesome.css and index.html>
        <link rel = "stylesheet" type = "text/css" href ="font-awesome.css">
    </head>
    <body>
        <div class = "container">
            <img src ="images/RowanSeal.png"/>
            <!-- Referencing php here-->
            <form action = "login.php" method = "post">  
                <div class = "form-input">
                    <input type ="text" name ="username"
                           placeholder = "Enter Username">
                </div>
                <div class ="form-input">
                    <input type = "password" name ="password"
                           placeholder = "Enter Password">
                </div>
                <input type="submit" name="submit" value="LOGIN" class="btn-login">  
            </form><br> <!--line breaks here -->
            <a href ="#">Forgot Password? </a>
            <p>Login Form powered by <a class="footer-text" href="http://www.rowan.edu/home/">Rowan University </a></p>
        </div>
    </body>
</html>
