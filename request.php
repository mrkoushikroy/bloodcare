<?php
session_start();
require_once"db/config.php";
if(isset($_SESSION['hid'])){
    $hid = $_SESSION['hid'];
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
    <?php include"navbar.php"; ?>
    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-12 col-12 p-4 ">
                <h2 class="text-center mb-2">Requests</h2>
                <?php 

                $sql="SELECT r.date, re.rname, re.remail, re.rlocation, bg.blood, h.hname, r.volume FROM request r
                    INNER JOIN receivers re on  r.user_id = re.rid
                    INNER JOIN hospital h on r.hospital_id = h.hid
                    INNER JOIN blood_group bg on r.blood_id  = bg.blood_id
                    Where hospital_id = '$hid'
                    ORDER BY date DESC ";
                $result = mysqli_query($conn, $sql);
                $no=mysqli_num_rows($result);
                if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                echo '<div class="row d-flex border border-dark p-2 mb-2">
                        <div class="col-lg-2 col-2 mb-1 comment">
                            <img class="p-2 rounded-circle border border-dark" src="img/avatar.png" alt="">
                            <p><b class="text-primary"> '.$row['rname'].'</b></p>
                        </div>
                        <div class="col-lg-10  col-10  ">
                       <p> <b>From: </b><b class="text-primary"> '.$row['rname'].'</b> <small><span class="badge bg-dark ">'.$row['date'].'</span></small></p>
                            <div>
                                <p> Blood group needed: <b>'.$row['blood'].'</b> from hospital: <b>'.$row['hname'].'</b> Blood volume needed: <b>'.$row['volume'].' ml</b> </p>
                                <p> Location: <b>'.$row['rlocation'].'</b> </p>
                                <p> Contact me: <i class="fa fa-envelope" aria-hidden="true"></i> <b>'.$row['remail'].'</b> </p>
                            </div>
                            </div>
                    </div>';
                    
                }
                }
                else{
                    echo'<div class="alert alert-danger" role="alert">
                    Request empty wait for someone to request
                  </div>';
                }
                ?>



            </div>
        </div>
    </div>



    <script src="js/jquery.js"></script>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
</body>

</html>
<?php
}
else{
  header('location:login.php');
}
?>