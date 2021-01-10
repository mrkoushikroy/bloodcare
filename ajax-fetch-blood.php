<?php
session_start();
include"db/config.php";
$sql="SELECT bs.volume, bs.hid, bs.blood_id,  bg.blood, bs.ason, h.hname FROM blood_stock bs INNER JOIN blood_group bg ON bs.blood_id=bg.blood_id INNER JOIN hospital h ON bs.hid= h.hid ORDER BY ason DESC";
$result = mysqli_query($conn, $sql);
$no=mysqli_num_rows($result);
$output = "";
$output = "<div class='h4'>Total blood category: <span class='badge bg-success'>$no </span></div>";
if(mysqli_num_rows($result)>0){
 $output.='<br>';
while($row = mysqli_fetch_assoc($result)){
  $output.='<div class="col-lg-3 mt-2  border border-dark rounded p-3">
  <img class="bd-placeholder-img rounded-circle d-flex m-auto" width="50" height="50" src="img/logo.png"
      alt="img1"><hr>
  <h4 class="text-center">'.$row['blood'].'</h4>
  <p >Hospital:<b> '.$row['hname'].'</b></p>
  <p >Vloume: '.$row['volume'].' ml</p>
  <p ><small>As on: <span class="badge bg-primary">'.$row['ason'].'</span></small></p>';
  $output.='<button type="button" class="btn btn-secondary edit-btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-hid="'.$row['hid'].'" data-bid="'.$row['blood_id'].'">
  Send request
</button>
</div>';
}
$output.= '<br>';
mysqli_close($conn);
echo $output;
}
else{
  echo '<div class="alert alert-danger text-center h4" role="alert">No stock found!</div>';
}

?>




