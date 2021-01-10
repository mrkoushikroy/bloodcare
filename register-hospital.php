<?php
session_start();
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  </head>
  <body >
  <?php 
  include"navbar.php";
  ?>

    <div class="container py-2 mt-2">
    <div class="row">
    <div class="col-lg-6 col-12 second-login">
    </div>
    <div class="col-lg-6 col-12 bg-light">
    <div class="text-center">
    <img src="img/hsp.png" class="border rounded-circle text-center border-dark" height="60" width="60" alt="">
    </div>
                        <h1 class="h3  font-weight-normal text-center">Register as Hospital account</h1>
                        <div class="d-flex justify-content-center" id="msg"  role="alert">
                            <p id="frm_error"></p><p id="load" class=""></p>
                            </div>
                    <form class="d-flex flex-column form-signin"  method="post">

                        <div class="form-signin form-group">
                            <label for="name">Hospital Name</label>
                            <input type="text" class="form-control fields" id="name" onkeyup="ValidateName();" name="name" placeholder="Your name" required>
                            <span id="error_name" class="text-danger text-success error_fields"></span>
                        </div>
                        <div class="form-group">
                            <label for="Email">Email address</label>
                            <input type="email" class="form-control fields" onkeyup="ValidateEmail();" id="email"
                            name="email"required placeholder="Your email">
                            <span id="error_email" class="text-danger text-success error_fields"></span>
                        </div>

                        

                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" onkeyup="ValidatePassword();" class="form-control fields" name="password" id="password" placeholder="Choose password">
                            <span id="error_password" class="text-danger text-success error_fields"></span>
                        </div>
                        
                        <div class="form-signin form-group">
                            <label for="location">Hospital Location</label>
                            <input type="text" class="form-control fields" id="location" name="location" onkeyup="ValidateLocation();" required placeholder="Your location">
                            <span id="error_location" class="text-danger text-success error_fields"></span>
                        </div>
                        <button type="button" name="submit" id="submit" onclick='form_login()' class="btn btn-primary">Create Account</button>
                    </form>

                    
    </div>
    </div>
    </div>

    <script src="js/jquery.js"></script>
    <script>
     function ValidateName() {
        var name = document.getElementById("name").value;
        var lblname = document.getElementById("error_name");
        lblname.innerHTML = "";
        if (name.length <5) {
            lblname.innerHTML = "Name must be more than 5 characters.";
            $('#name').addClass('is-invalid');
            $('#name').removeClass('is-valid');
            $('#error_name').removeClass('text-success');
            $('#error_name').addClass('text-danger');
        }
        else{
            $('#name').addClass('is-valid');
            $('#name').removeClass('is-invalid');
            $('#error_name').removeClass('text-danger');
            $('#error_name').addClass('text-success');
            lblname.innerHTML = "looks good !";

        }
    }
     function ValidateEmail() {
        var email = document.getElementById("email").value;
        var lblError = document.getElementById("error_email");
        lblError.innerHTML = "";
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if (!expr.test(email)) {
            lblError.innerHTML = "Invalid email address.";
            $('#email').addClass('is-invalid');
            $('#email').removeClass('is-valid');
            $('#error_email').removeClass('text-success');
            $('#error_email').addClass('text-danger');
        }
        else{
            $('#email').addClass('is-valid');
            $('#email').removeClass('is-invalid');
            $('#error_email').removeClass('text-danger');
            $('#error_email').addClass('text-success');
            lblError.innerHTML = "looks good !";
        }
    }
     function ValidateLocation() {
        var location = document.getElementById("location").value;
        var lbllocation = document.getElementById("error_location");
        lbllocation.innerHTML = "";
        if (location.length>4) {
            $('#location').addClass('is-valid');
            $('#location').removeClass('is-invalid');
            $('#error_location').removeClass('text-danger');
            $('#error_location').addClass('text-success');
            lbllocation.innerHTML = "looks good !";
        }
        else{
            lbllocation.innerHTML = "location must be more than 4 digits";
            $('#location').addClass('is-invalid');
            $('#location').removeClass('is-valid');
            $('#error_location').removeClass('text-success');
            $('#error_location').addClass('text-danger');
        }
    }
     function ValidatePassword() {
        var password = document.getElementById("password").value;
        var lblErrorp = document.getElementById("error_password");
        lblErrorp.innerHTML = "";
        if (password.length<5) {
            lblErrorp.innerHTML = "Password must be more than 5 characters";
            $('#password').addClass('is-invalid');
            $('#password').removeClass('is-valid');
            $('#error_password').removeClass('text-success');
            $('#error_password').addClass('text-danger');

        }
        else{
            $('#password').addClass('is-valid');
            $('#password').removeClass('is-invalid');
            $('#error_password').removeClass('text-danger');
            $('#error_password').addClass('text-success');
            lblErrorp.innerHTML = "looks good !";
        }
    }
     
    
    function form_login(){
        
            var name = jQuery('#name').val();
            var email = jQuery('#email').val();
            var location = jQuery('#location').val();
            var password = jQuery('#password').val();
            // var frm_error = '';
            var lblname = document.getElementById("error_name");
             lblname.innerHTML = "";
            jQuery('.error_fields').html('');
            if (name.length <5) {
            lblname.innerHTML = "Name must be more than 5 characters.";
            $('#name').addClass('is-invalid');
            $('#name').removeClass('is-valid');
            $('#error_name').removeClass('text-success');
            $('#error_name').addClass('text-danger');
            frm_error='yes';
            }
            if(name.length >5){
                $('#name').addClass('is-valid');
                $('#name').removeClass('is-invalid');
                $('#error_name').removeClass('text-danger');
                $('#error_name').addClass('text-success');
                lblname.innerHTML = "looks good !";
                frm_error='';
            }
            var lbllocation = document.getElementById("error_location");
            lbllocation.innerHTML = "";
            if (location.length>=4) {
                $('#location').addClass('is-valid');
                $('#location').removeClass('is-invalid');
                $('#error_location').removeClass('text-danger');
                $('#error_location').addClass('text-success');
                lbllocation.innerHTML = "looks good !";
                frm_error='';
            }
            if (location.length<=3){
                lbllocation.innerHTML = "location must be more than 4 characters";
                $('#location').addClass('is-invalid');
                $('#location').removeClass('is-valid');
                $('#error_location').removeClass('text-success');
                $('#error_location').addClass('text-danger');
                frm_error='yes';
            }
    
           
            if(email.length<=5){
                jQuery('#email').addClass('is-invalid');
                jQuery('#error_email').html('Email must be more than 5 character');
                frm_error='yes';
            }
            if(email.length>=6){
                jQuery('#email').removeClass('is-invalid');
                jQuery('#email').addClass('is-valid');
                frm_error='';
            }
            if(password.length <=4){
                jQuery('#password').addClass('is-invalid');
                jQuery('#error_password').html('Password must be more than 4 character');
                frm_error='yes';
            }
            if(password.length >=5){
                jQuery('#password').addClass('is-valid');
                jQuery('#password').removeClass('is-invalid');
                frm_error='';
            }

            if(frm_error==''){
            $('#submit').html('connecting..');
            $.ajax ({
          url: "ajax-register-hospital-validate.php",
          type: "POST",
          data: 'name='+name+'&email='+email+'&location='+location+'&password='+password,
          success: function(data){
                // alert(data);
              if(data == 'correct    '){
                // alert(data);
                jQuery('#msg').removeClass('alert alert-danger');
                jQuery('#msg').addClass('alert alert-success');
                jQuery('#frm_error').html('Successful, redirecting to login page......');
                jQuery('#load').addClass('loader5');
                setTimeout(function() {
                    window.location.replace("login.php");
                }, 3000  ); 
              }
              else{  
            $('#submit').html('submit');
            jQuery('#frm_error').html(data);
            jQuery('#msg').addClass('alert alert-danger');
              }
          }
        });
        
        }
        
    }
    </script>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>