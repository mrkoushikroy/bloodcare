<?php
session_start();
require_once"db/config.php";
if(isset($_SESSION['rid'])){
    $rid = $_SESSION['rid'];
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
    <?php include"navbar.php"; ?>

    <div class="container mt-3">
        <h2 class="text-center">Available Bloods</h2>
        <div class="row" id="table-data">

        </div>

    </div>


    <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Send blood request</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="alert alert-success alert-danger d-none alert-dismissible" role="alert" id="frm_error">
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
        <form method="post">
            <div class="form-group">
                <!-- <label for="user_id">user_id</label> -->
                <input type="text" class="form-control" id="rec_id" name="rec_id"  value="<?php echo $rid; ?>" hidden>
            </div>
            <div class="form-group">
                <!-- <label for="offer">watch_id</label> -->
                <input type="text" class="form-control" id="hid" name="hid" hidden>
            </div>
            <div class="form-group">
                <!-- <label for="offer">watch_id</label> -->
                <input type="text" class="form-control" id="blood_id" name="watch_id" hidden>
            </div>
            <div class="form-group my-4">
                <label for="offer mb-2">Enter Volume (ml)</label>
                <input type="number" class="form-control" id="volume" name="volume" placeholder="Enter volume">
            </div>
            <button type="button" class="btn btn-primary" id="send_offer" onclick="modalsubmit()">Submit</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- ---------------start footer------------------ -->
<?php include"footer.php"; ?>
<!-- ---------------end footer------------------ -->


    <script src="js/jquery.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        function loadtable() {
            $.ajax({
                url: "ajax-fetch-blood.php",
                type: "POST",
                success: function(data) {
                    $("#table-data").html(data);
                }
            });
        }
        loadtable();

        $(document).on("click", ".edit-btn", function() {
            var bloodid = $(this).data('bid');
            var hospid = $(this).data('hid');
            // alert(prodid);
            $('#hid').val(hospid);
            $('#blood_id').val(bloodid);

        });
    });

    function modalsubmit() {
        var hid = jQuery('#hid').val();
        var rec_id = jQuery('#rec_id').val();
        var blood_id = jQuery('#blood_id').val();
        var volume = jQuery('#volume').val();
        $.ajax({
                url: "ajax-request-send.php",
                type: "POST",
                data: 'hid='+hid+'&rec_id='+rec_id+'&blood_id='+blood_id+'&volume='+volume,
          success: function(data){
              // alert(data);
              if(data == "correct"){
                jQuery('#frm_error').removeClass('d-none');
                jQuery('#frm_error').removeClass('alert-danger');
                jQuery('#frm_error').addClass('alert-success');
                jQuery('#frm_error').html('Request send successfully');
                jQuery('#send_offer').html('sent');
                window.setTimeout(function () {
                    window.location.reload();
                    }, 2000);
                
              }
              else{
                jQuery('#frm_error').removeClass('d-none');
                jQuery('#frm_error').removeClass('alert-success');
                jQuery('#frm_error').html(data);
                window.setTimeout(function () {
                    window.location.reload();
                    }, 2000);
              }

            }

            });
        }

    </script>

        <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity = "sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
    crossorigin = "anonymous" >
    </script>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>

</html>
<?php
}
else{
  header('location:login.php');
}
?>