<?php
    //gets db connection info
    require_once '../scripts/connectToDatabase.php';
    
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
        <link rel="stylesheet" href="../style.css">
    </head>
    
    <body>

        <center>
            <h1><center>Employee Login</center></h1>
            <center><div style='color: red;'><?php echo $notice; ?></div></center>
            <center>Enter your email and password:</center>
            <form action='./scripts/login.php' method='post'>
            <div><input type="email" name="email" id="email-field" class="login-form" placeholder="Email" required></div>
            <div><input type="password" name="password" id="password-field" class="login-form" placeholder="Password" required></div>
            <input type="submit" class="sButton" value="Login" id="login-submit">
            </form>
            <div class="login">
                <center>
                    Don't have an account yet? <a class="link" href="register.php">Create an account</a>
                    <br>
                    Not an employee? <a class="link" href="../index.php">Customer Login</a>
                </center>
            </div>
        </center>
    </body>
</html>