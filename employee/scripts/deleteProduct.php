<?php

     // connect to the database
    require_once '../../scripts/connectToDatabase.php';
        
        // start session
    session_start();


    if ((isset($_SESSION['active']) && $_SESSION['active']) === false) {
        $_SESSION['loggedin'] = false;
        header('Location: ../login.php');

        //closes db connection
        $database->close();
        exit();
    }
        if(isset($_SESSION["active"])){
        if(time()-$_SESSION["login_time_stamp"] > 1800){
            session_unset();
            session_destroy();
            header("Location: ../login.php");
        }
    }
    

  // create short variable names
  $productID=$_POST['name'];

  if (!$productID) {
     $_SESSION['deleteProduct'] = 'missingInput';
        header('Location: ../delete.php');
        $database->close();
	    exit();
  }

  if (!get_magic_quotes_gpc()) {
    $productID = addslashes($productID);
  }

  if (mysqli_connect_errno()) {
     $_SESSION['deleteProduct'] = 'connectionFailed';
        header('Location: ../delete.php');
        $database->close();
	    exit();
  }

  $query = "DELETE FROM PRODUCT WHERE productID = '$productID'";
  $result = $database->query($query);

    if($result){
        $_SESSION['deleteProduct'] = 'success';
        header('Location: ../delete.php');
	    exit();
    } else{
        $_SESSION['deleteProduct'] = 'failed';
        header('Location: ../delete.php');
        $database->close();
	    exit();
    }

  $database->close();
?>