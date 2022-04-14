<?php
    //gets db connection info
    require_once './scripts/connectToDatabase.php';
    //gets session info
    session_start();
    if($_SESSION['registration'] == 'emailTaken'){
        $notice = 'Email is already in use. Please try again.';
            
        $_SESSION['registration'] = '';
    } else if ($_SESSION['registration'] == 'MissingInput'){
                $notice = 'Please try again.';
                    
                $_SESSION['registration'] = '';
    } else if ($_SESSION['registration'] == 'passwordsDontMatch'){
                $notice = 'Passwords did not match. Please try again.';
                    
                $_SESSION['registration'] = '';
    } else if ($_SESSION['registration'] == 'phoneNumberTaken'){
                $notice = 'Phone number is in use. Please try again.';
                    
                $_SESSION['registration'] = '';
    } else if ($_SESSION['registration'] == 'failed'){
                $notice = 'Please try again.';
                    
                $_SESSION['registration'] = '';
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
                padding: 15px 70px;
                font-size: 16px;
                text-align: center;
                margin: 10px 0px;
                cursor: pointer;
            }
            input{
                padding: 10px;
                width: 40%;
                margin: 8px 0px;
            }
        </style>
        <center>
            <h1><center>Register</center></h1>
            <center><div style='color: red;'><?php echo $notice; ?></div></center>
            <center>Fill in your information below:</center>
            <form action='./scripts/registerAcct.php' method='post'>
                <div class="login-form" id="login-form">
                    <div><input type="email" name="email" id="email-field" placeholder="Email" required></div>
                    <div><input type="password" name="password" placeholder="Password" required></div>
                    <div><input type="password" name="confirmPassword" placeholder="Reenter Password" required></div>
                    <div><input type="text" name="Fname" placeholder="First Name" required></div>
                    <div><input type="text" name="Lname" placeholder="Last Name" required></div>
                    <div><input type="tel" name="phoneNum" placeholder="Phone number Ex: 999-999-9999" required pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"></div>
                    <div><input type="text" name="address" placeholder="Address" required></div>
                    <div><input type="text" name="city" placeholder="City" required></div>
                    <div><input type="text" name="state" placeholder="State" required></div>
                    <div><input type="text" name="zip" placeholder="Zip code" required></div>
                    <input name="submit" type="submit" class="sButton" value="Create Account" id="login-submit">
                </div>
            </form>
            Already have an account? <a class="link" href="index.php"> Login </a>
        </center>
    </body>
</html>