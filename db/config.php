<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'bloodbank');


// Try connecting to DB
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

//check connection
if($conn == false){
    die('error: cannot connect to DB');
}
else{
    // echo"connection success";
}

?>