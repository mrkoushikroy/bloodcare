<?php
session_start();
require_once"db/config.php";
if(isset($_POST["blood_id"]) && isset($_POST["rec_id"]) && isset($_POST["hid"])  && isset($_POST["volume"]))
{
    $blood_id =mysqli_real_escape_string($conn, $_POST['blood_id']);
    $rec_id =mysqli_real_escape_string($conn, $_POST['rec_id']);
    $hid =mysqli_real_escape_string($conn, $_POST['hid']);
    $volume =mysqli_real_escape_string($conn, $_POST['volume']);

    if(empty($blood_id) && empty($rec_id) && empty($hid)  && empty($volume)){
        echo 'Enter all fields';
    }
    else {
        $check = "SELECT * FROM request where ( blood_id= '$blood_id' AND user_id='$rec_id' AND hospital_id='$hid' AND volume= '$volume')";
        $con_check = mysqli_query($conn, $check);
        if(mysqli_num_rows($con_check)>0){
            echo 'Same Request already made on this hospital, Wair for contact';
        }
        else{
        $offerup = "insert into request(user_id, hospital_id, blood_id, volume) values('$rec_id','$hid','$blood_id', '$volume')";
        $con_update= mysqli_query($conn, $offerup);
        if($con_update){
            echo 'correct';
        }
        else{
            echo 'incorrect';
            
        }
    }

    }

    }
          ?>