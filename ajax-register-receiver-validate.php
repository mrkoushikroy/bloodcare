<?php 
  include "db/config.php";
  if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['location']) && isset($_POST['password']) && isset($_POST['blood_group'])){
      $name =mysqli_real_escape_string($conn, $_POST['name']);
      $email =mysqli_real_escape_string($conn, $_POST['email']);
      $password =mysqli_real_escape_string($conn, $_POST['password']);
      $location =mysqli_real_escape_string($conn, $_POST['location']);
      $blood_group =mysqli_real_escape_string($conn, $_POST['blood_group']);
      $pass = password_hash($password, PASSWORD_BCRYPT);

      $emailquery = "select * from receivers where remail = '$email'";
      $query = mysqli_query($conn, $emailquery);

      $emailcount = mysqli_num_rows($query);
      if($emailcount>0)
        {
           echo "email already registered";
        }
      else
        {
                $insertquery = "insert into receivers(rname, remail, rpassword, blood_id, rlocation) values('$name','$email','$pass','$blood_group','$location')";

                $iquery = mysqli_query($conn,$insertquery);

                if($iquery){
                echo'correct';
                }
                else{
                    echo'Failed to create account';
                }
    }

  
}
?>    