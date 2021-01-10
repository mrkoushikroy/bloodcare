<?php 
  include "db/config.php";
  if(isset($_POST['hid']) && isset($_POST['blood_group']) && isset($_POST['volume']) ){
      
        $hid = $_POST['hid'];
        $blood_id = $_POST['blood_group'];
        $volume = $_POST['volume'];

        $sql = "SELECT * FROM blood_stock WHERE (hid='$hid' && blood_id = '$blood_id')";
        $sql_check = mysqli_query($conn, $sql);
        if(mysqli_num_rows($sql_check)>0){
            $res = mysqli_fetch_assoc($sql_check);
            $sid = $res['sid'];
            $volume1 = $res['volume'];
            $upvol = $volume1 + $volume;

            $upquery = "UPDATE blood_stock SET volume = '$upvol' where sid = '$sid'";
            $iquery1 = mysqli_query($conn,$upquery);
            if($iquery1){
            echo'correct';
            }
            else{
                echo'incorrect';
            }
        }
        else{

                $insertquery = "insert into blood_stock(blood_id, hid, volume) values('$blood_id','$hid', '$volume')";

                $iquery = mysqli_query($conn,$insertquery);
                if($iquery){
                echo'correct';
                }
                else{
                    echo'incorrect';
                }
                
            }
        }
            else{
                echo "error ";
}
?>