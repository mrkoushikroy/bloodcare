<?php
session_start();
include_once"db/config.php";
if(isset($_POST["email"]) && isset($_POST["password"]))
{
 $email = mysqli_real_escape_string($conn, $_POST["email"]);
 $password =(mysqli_real_escape_string($conn, $_POST["password"]));
//  echo $password;
 $sql = "SELECT * FROM receivers WHERE remail = '$email' ";
 
 $result = mysqli_query($conn, $sql);
 $num_row = mysqli_num_rows($result);
 if($num_row > 0)
 {
  $email_pass = mysqli_fetch_assoc($result);
  $db_pass=$email_pass['rpassword'];
  $_SESSION['rname']=$email_pass['rname'];
  // echo $_SESSION['name'];
  $_SESSION['rid']=$email_pass['rid'];
  $_SESSION['remail']=$email_pass['remail'];
  $passv = password_verify($password, $db_pass);
  // echo $pass_decode;
  if($passv){
  echo 'correct';
  }
    else{
    echo 'incorrect';
    } 
}
else{
  
}
}
?>