<?php
session_start();
require_once"db/config.php";
if(!isset($_SESSION['rid']) && !isset($_SESSION['hid'])){
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>

<?php include"navbar.php"; ?>

<div class="container mt-3">
<div class="text-center">
<img src="img/blood.png" alt="logo" width="80" height="80">
  <h2 class="jumbotron-heading"><span id="typed"></span></h2>
</div>
    <h3 class="text-center">Blood stock</h3>
    <div class="row" id="table-data">

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
  <div class="alert alert-success alert-danger d-none alert-dismissible" role="alert" id="frm_error">
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
    <form method="post">
        <div class="form-group">
          <div class="alert alert-danger" role="alert">
            Please login to send request
          </div>
          <a href="login.php" type="button" class="btn mr-2  btn-danger">Login</a>

            <!-- <label for="user_id">user_id</label> -->
            <input type="text" class="form-control" id="user_id" name="user_id"  value="<?php echo $id; ?>" hidden>
        </div>
        <div class="form-group">
            <!-- <label for="offer">watch_id</label> -->
            <input type="text" class="form-control" id="watch_id" name="watch_id" hidden>
        </div>
        <div class="form-group my-4">
            <label for="offer mb-2">Enter Volume</label>
            <textarea type="text" class="form-control" id="offer" name="offer" placeholder="Enter offer"></textarea>
        </div>
        <button type="button" class="btn btn-primary" id="send_offer" onclick="">Submit</button>
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
        var prodid = $(this).data('eid');
        // alert(prodid);
        $('#watch_id').val(prodid);

    });
});

function modalsubmit() {
    var watch_id = jQuery('#watch_id').val();
    var user_id = jQuery('#user_id').val();
    var offer = jQuery('#offer').val();
    $.ajax({
            url: "ajax-offer-send.php",
            type: "POST",
            data: 'watch_id='+watch_id+'&user_id='+user_id+'&offer='+offer,
      success: function(data){
          // alert(data);
          if(data == "correct"){
            jQuery('#frm_error').removeClass('d-none');
            jQuery('#frm_error').removeClass('alert-danger');
            jQuery('#frm_error').addClass('alert-success');
            jQuery('#frm_error').html('offer send successfully');
            jQuery('#send_offer').html('sent');
            
          }
          else{
            jQuery('#frm_error').removeClass('d-none');
            jQuery('#frm_error').removeClass('alert-success');
            jQuery('#frm_error').html(data);
          }

        }

        });
    }

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.9/typed.min.js" async defer></script>
<script>
    window.onload = function () {
        console.log("loaded")
        var typed = new Typed('#typed', {
            strings: ["There is no greater joy than saving a soul", "Blood gives life and joy", "Your blood can save a soul", "Be a blood donor, be a hero – a real one", "Your blood is precious: Donate, save a life & make it divine", "You are somebody's type; please donate"],
            backSpeed: 15,
            smartBackspace: true,
            backDelay: 1200,
            startDelay: 1000,
            typeSpeed: 25,
            loop: true,
        });
    };
</script>

    <!-- <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script> -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>
<?php
}
else{
  header('location:login.php');
}
?>