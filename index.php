<?php
    //gets db connection info
    require_once './scripts/connectToDatabase.php';
    //gets session info
    session_start();
    if($_SESSION['login'] == 'missingInput'){
        $notice = 'Please try again.';
            
        $_SESSION['login'] = '';
    } else if ($_SESSION['login'] == 'MissingInput'){
                $notice = 'Please try again.';
                    
                $_SESSION['login'] = '';
    } else if ($_SESSION['login'] == 'invalidAccount'){
                $notice = 'Account does not exist';
                    
                $_SESSION['login'] = '';
    } else if ($_SESSION['login'] == 'wrongPassword'){
                $notice = 'Invalid password. Please try again.';
                    
                $_SESSION['login'] = '';
    }
    
    
    
    //closes connection
    $database->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Office Supply Emporium</title>
    </head>
    
    <body>
        <style>
            body{
                font-size:26px;
                font-family: 'Open Sans';
            }
            a{
                color:black;
            }
            a:hover{
                color: blue;
            }
            .sButton {
                border: none;
                text-decoration: none;
                background-color: black;
                color: white;
                display: inline-block;
                padding: 15px 60px;
                font-size: 16px;
                text-align: center;
                margin: 12px 2px;
                cursor: pointer;
            }
            .login-form{
                padding: 10px;
                margin: 8px 0px;
            }
        </style>
        <center>
            <h1><center>Customer Login</center></h1>
            <center>Enter your email and password:</center>
            <form action='./scripts/login.php' method='post'>
            <div><input type="email" name="email" id="email-field" class="login-form" placeholder="Email" required></div>
            <div><input type="password" name="password" id="password-field" class="login-form" placeholder="Password" required></div>
            <input type="submit" class="sButton" value="Login" id="login-submit">
            </form>
            <div>
                <center>
                    Don't have an account yet?<a class="link" href="register.php"> Create an account</a>
                    <br>
                    Are you an employee?<a class="link" href="register.php"> Employee Login</a>
                </center>
            </div>
        </center>
    </body>
</html>