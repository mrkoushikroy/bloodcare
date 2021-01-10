
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>BLOODCARE.com official!</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-info">
  <div class="container-fluid">
  <a href="/" class="navbar-brand">
                    <img class="rounded-circle" width="50" height="50" src="img/logo.png"
                        alt=""></a>
    <a class="navbar-brand" href="/">BLOODCARE.com</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>Menu
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <?php
      if(!isset($_SESSION['rid']) && !isset($_SESSION['hid'])){ ?>
        
        <li class="nav-item">
          <a class="nav-link active" href="index.php">Home</a>
        </li>

        <?php
      }
      ?>
                            <?php
                            if(isset($_SESSION['rid'])){ ?>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <?php
                            }
                            ?>
      <?php
                            if(isset($_SESSION['hid'])){ ?>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="portal.php">Portal</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="request.php">Requests</a>
        </li>
        <?php
                            }
                            ?>
      </ul>
      <form class="d-flex">
      <?php
                            if(isset($_SESSION['rid'])){
                                echo '<a type="button" class="btn btn-danger mr-2 text-light"><i class="fa fa-user-circle" aria-hidden="true"></i> Welcome ' .$_SESSION["rname"]. '</a>&nbsp;
                                <a href="logout.php" type="button" class="btn mr-2 btn-sm btn-danger"><i class="fa fa-power-off" aria-hidden="true"></i></a>';
                               
                         }
                            if(isset($_SESSION['hid'])){
                                echo '<a type="button" class="btn btn-danger mr-2 text-light"><i class="fa fa-user-circle" aria-hidden="true"></i> Welcome ' .$_SESSION["hname"]. '</a>&nbsp;
                                <a href="logout.php" type="button" class="btn mr-2 btn-sm btn-danger"><i class="fa fa-power-off" aria-hidden="true"></i></a>';
                               
                         }
                         if(!isset($_SESSION['rid']) && !isset($_SESSION['hid'])){
                            echo'<a href="login.php" type="button" class="btn mr-2  btn-danger">Login</a>&nbsp;
                            <div class="btn-group">
  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Signup
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="register-receiver.php">For Receiver</a>
    <a class="dropdown-item" href="register-hospital.php">For Hosptal</a>
  </div>
</div>';

                        }
                        ?>
      </form>
    </div>
  </div>
</nav>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity = "sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
    crossorigin = "anonymous" >
    </script>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

    
  </body>
</html>

