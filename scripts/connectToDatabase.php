<?php
    //create a new database object
    @ $database = new mysqli('localhost', 'doerflk1_OSE_user', 'OfficeSupplyPass$$', 'doerflk1_OfficeSupplyEmporium');
    
    //checks if the connection to database was successful
    if (mysqli_connect_errno()) {
        echo 'Error: connection to the database failed. Try again later.';
        exit();
    }


?>