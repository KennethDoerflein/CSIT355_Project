<?php
    // connect to the database
    require_once '../../scripts/connectToDatabase.php';
    
    // start session
    session_start();
    
    
    $accountNumber = mt_rand(30000000,40000000);
    date_default_timezone_set("America/New_York");
    $date = date("Y/m/d H:i:s");
    // Take input from registration form
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);
    $firstname = trim($_POST['Fname']);
    $lastName = trim($_POST['Lname']);
    $phoneNumber = trim($_POST['phoneNum']);
    $address = trim($_POST['address']);
    $city = trim($_POST['city']);
    $state = trim($_POST['state']);
    $zipcode = trim($_POST['zip']);
    $salary = mt_rand(30000,40000);
    
    if (!$email || !$password || !$confirmPassword || !$firstname || !$lastName|| !$phoneNumber || !$address || !$city || !$state || !$zipcode){
        $_SESSION['registration'] = 'MissingInput';
	    header('Location: ../register.php');
	    
	    // closes connection to database
        $database->close();
        // Exits script
        exit();
    } else if ($password != $confirmPassword){
        $_SESSION['registration'] = 'passwordsDontMatch';
	    header('Location: ../register.php');
	    
	    // closes connection to database
        $database->close();
        // Exits script
        exit();
    }
    $fullAddress = $address . ' ' . $city . ' ' . $state . ' ' . $zipcode;
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    $query = "SELECT accountNumber, email, phoneNumber FROM EMPLOYEE";
    $accountInfo = $database->query($query);
    
    for($i = 0; $i < mysqli_num_rows($accountInfo); $i++){
        $info = $accountInfo->fetch_assoc();
        if($email == $info['email']){
            $_SESSION['registration'] = 'emailTaken';
    	    header('Location: ../register.php');
    	    
    	    $accountInfo->free();
    	    // closes connection to database
            $database->close();
            // Exits script
            exit();
        }
        if($accountNumber == $info['accountNumber']){
            $accountNumber = mt_rand(30000000,40000000);
            $i = 0;
        }
        
        if($phoneNumber == $info['phoneNumber']){
            $_SESSION['registration'] = 'phoneNumberTaken';
    	    header('Location: ../register.php');
    	    
    	    $accountInfo->free();
    	    // closes connection to database
            $database->close();
            // Exits script
            exit();
        }
        
    }
    $accountNumber = strval($accountNumber);
    
    if(!get_magic_quotes_gpc()) {
        $email = addslashes($email);
        $password = addslashes($password);
        $firstname = addslashes($firstname);
        $lastName = addslashes($lastName);
        $phoneNumber = addslashes($phoneNumber);
        $fullAddress = addslashes($fullAddress);
    }
    
    $inputAcct = "INSERT INTO EMPLOYEE VALUES ('".$accountNumber."', '".$email."', '".$firstname."', '".$lastName."' , '".$password."', '".$fullAddress."', '".$phoneNumber."' , '".$salary."', '".$date."')";
    
    $insert = $database->query($inputAcct);
    
    if($insert){
        $_SESSION['registration'] = 'success';
        $_SESSION['active'] = true;
        $_SESSION['account'] = $accountNumber;
        
        $_SESSION['loggedin'] = true;
	    header('Location: ../homepage.php');
	    exit();
    }else{
        $_SESSION['registration'] = 'failed';
	    header('Location: ../registration.php');
	    exit();
    }
    
    // closes connection to database
    $database->close();
?>