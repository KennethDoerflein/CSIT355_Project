<?php
    // connect to the database
    require_once '../../scripts/connectToDatabase.php';
    
    // start session
    session_start();
    
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        header('Location: ../homepage.php');
        $_SESSION['active'] = true;
        
        //closes db conection
	    $database->close();
        exit();
    }
    
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    if(!$email || !$password){
        $_SESSION['login'] = 'missingInput';
        header('Location: ../login.php');
        $database->close();
        exit();
    }
    
    if(!get_magic_quotes_gpc()) {
        $email = addslashes($email);
        $password = addslashes($password);
    }
    
    $search = "SELECT password, employeeID FROM EMPLOYEE WHERE email = '".$email."'";
    $accountInfo = $database->query($search);
    
    if(mysqli_num_rows($accountInfo) == 0){
        $_SESSION['login'] = 'invalidAccount';
        header('Location: ../login.php');
        $database->close();
        $accountInfo->free();
        exit();
    }
    
    $account = $accountInfo->fetch_assoc();
    
    if(password_verify($password, $account['password'])){
        $_SESSION['active'] = true;
        $_SESSION['account'] = $account['employeeID'];
        $_SESSION["login_time_stamp"] = time();
        
        $_SESSION['loggedin'] = true;
        header('Location: ../homepage.php');
        $accountInfo->free();
        $database->close();
        exit();
    } else{
         $_SESSION['login'] = 'wrongPassword';
        header('Location: ../login.php');
        $accountInfo->free();
        $database->close();
        exit();
    }
    
    $database->close();
?>