<?php
session_start();
require_once"db/config.php";
if(isset($_SESSION['hid'])){
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
    <?php include"navbar.php"; ?>

    <div class="container-fluid mt-3">

        <div class="row">
            <div class="col-lg-6 col-12 tabody p-4">
                <h5 class="text-center">Add Blood stock</h5>
                <table class="table">
                    <thead>
                        <tr>

                            <div class="alert alert-success alert-success d-none" id="pmsg" role="alert">
                            </div>
                        </tr>
                    </thead>
                    <tbody>
                        <tr scope="col" width="11%">
                            <label for="hid" class="my-2">hospital id</label>
                            <input type="text" class="form-control fieldadd my-2" id="hid"
                                value="<?php echo $_SESSION['hid']; ?>" hidden>
                        </tr>
                        <tr scope="col" width="11%">
                            <label for="psupplier" class="my-2">Blood Group</label>
                            <select class="form-select required my-2" id="blood_group">
                                <option value="">Select blood group</option>
                                <?php 
                                $sql = "SELECT * FROM blood_group";
                                $result = mysqli_query($conn, $sql);
                                $num_row = mysqli_num_rows($result);
                                if($num_row > 0)
                                {
                                    while( $row = mysqli_fetch_assoc($result)){
                                echo '<option value="'.$row['blood_id'].'">'.$row['blood'].'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </tr>
                        <tr scope="col" width="11%">
                            <label for="description" class="my-2">Volume (in ml)</label>
                            <input type="number" class="form-control fieldadd my-2" id="volume"
                                placeholder="Blood volume in ml">
                        </tr>

                        <tr scope="col" width="11%" class="my-2">
                            <button class="btn btn-success my-2" type="button" id="add"
                                onclick="addblood()">Add</button>
                        </tr>

                        </tr>
                    </tbody>
                </table><br>

            </div>
            <div class="col-lg-6 col-12 mt-4 ">
                <h5 class="text-center">
                    your added Stocks
                </h5>
                <div class="row p-4">
                    <?php
                require_once"db/config.php";
                $hid = $_SESSION['hid'];
                $sql="SELECT bs.volume, bs.ason, bg.blood FROM blood_stock bs INNER JOIN blood_group bg ON bs.blood_id = bg.blood_id where hid = '$hid'";

                $result = mysqli_query($conn, $sql);
                $no=mysqli_num_rows($result);
                if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                  echo'<div class="col-lg-4 col-6 p-2">
                  <div class="text-center border border-dark rounded p-1">
                    <img src="img/blood.png" alt="" height="50" width="50">
                    <p>Group: <b class="text-danger">'.$row['blood'].'</b></p>
                    <p>Volume: <b>'.$row['volume'].' ml</b></p>
                    <p>Stock as on: <span class="badge bg-primary">'.$row['ason'].'</span></p>
                  </div>

              </div>';
                }
                mysqli_close($conn);
                }
                else{
                    echo '<div class="alert alert-danger text-center h4" role="alert">No Stock found!</div>';
                }
                
                ?>


                </div>
            </div>
        </div>


    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Send offer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success alert-danger d-none" role="alert" id="frm_error"></div>
                    <form method="post">
                        <div class="form-group">
                            <div class="alert alert-success text-center d-none" id="alert_accept" role="alert">

                            </div>
                            <!-- <label for="user_id">offer_id</label> -->
                            <input type="text" class="form-control" id="offer_id" hidden>
                            <input type="text" class="form-control" id="w_id" hidden>
                        </div>
                        <label for="">Are you sure want to accept ? </label>
                        <button type="button" class="btn btn-success" id="accept" onclick="Accept()">Accept</button>

                        <hr>
                        <div class="form-group">
                            <input type="text" class="form-control" id="from_user_id" name="from_user_id"
                                placeholder="from user i.e. seesion user" value="<?php echo $_SESSION['id']; ?>" hidden>
                            <input type="text" class="form-control" id="to_user_id" name="to_user_id"
                                placeholder="Enter message" hidden>
                            <input type="text" class="form-control" id="offerid" name="offerid"
                                placeholder="Enter message" hidden>
                            <label for="message">Your Message</label>
                            <input type="text" class="form-control my-1" id="text" name="text "
                                placeholder="Enter message">
                        </div>
                        <button type="button" class="btn btn-primary mt-2" id="textbtn"
                            onclick="Message()">Send</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script src="js/jquery.js"></script>
    <script type="text/javascript">
    function addblood() {
        var hid = jQuery('#hid').val();
        var blood_group = jQuery('#blood_group').val();
        var volume = jQuery('#volume').val();
        $.ajax({
            url: "ajax-blood-add.php",
            type: "POST",
            data: 'hid=' + hid + '&blood_group=' + blood_group + '&volume=' + volume,
            success: function(data) {
                // alert(data);
                if (data == 'correct') {
                    $('#pmsg').html('Blood added to stock');
                    $('#add').html('Added');
                    $('#pmsg').removeClass('d-none');
                    $('#pmsg').removeClass('alert-danger');
                    window.setTimeout(function () {
                    window.location.reload();
                    }, 2000);
                } else {
                    $('#pmsg').html(data);
                    $('#add').html('Add');
                    $('#pmsg').removeClass('d-none');
                    $('#pmsg').removeClass('alert-danger');
                }
            }
        });
        $('.fieldadd').html('');

    }

    </script>

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