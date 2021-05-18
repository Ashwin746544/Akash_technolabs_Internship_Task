<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>iDiscuss</title>
</head>

<body style="background-color: whitesmoke;">

    <?php  include 'partials/_dbconnect.php';?>
    <?php include 'partials/_header.php';?>
    <?php
    if(isset($_GET['showpassworderror'])&& $_GET['showpassworderror']==true){
     echo '<div class="alert alert-warning alert-dismissible fade show mb-0"  role="alert">
      <strong>Warning!</strong> Password do not match,please try again.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
    }
    if(isset($_GET['showexisterror']) && $_GET['showexisterror']==true){
     echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
      <strong>Error!</strong> Username already exist,please enter valid username.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
    }
    if(isset($_GET['showalert']) && $_GET['showalert']==true){
     echo '<div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
      <strong>Success!</strong> Your account has been created,please login for better experience.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
    }
    if(isset($_GET['login'])&& $_GET['login']==true){
     echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
      <strong>Success!</strong> You have been successfully login.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
    }
    if(isset($_GET['invalid'])&& $_GET['invalid']==true){
     echo '<div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
      <strong>Warning!</strong> Invalid Credentials.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
    }
    if(isset($_GET['logout'])&& $_GET['logout']==true){
     echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
      <strong>Success!</strong> You have been logout successfully.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
    }
    ?>




        <!-- START carousel -->
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active" data-interval="5000">
                    <img src="img/carosul-2.jfif" class="d-block w-100 h-70" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>First slide label</h5>
                        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                    </div>
                </div>
                <div class="carousel-item" data-interval="5000">
                    <img src="img/carosul-1.jfif" class="d-block w-100 h-70" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Second slide label</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
                <div class="carousel-item" data-interval="5000">
                    <img src="img/carosul-3.jfif" class="d-block w-100 h-70" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Third slide label</h5>
                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <div class="container text-center my-2 ">
            <p style="font-size:30px;"><b> Welcome To iDiscuss-Forum</b></p>
        </div>

        <!-- SETTING cards using while loop -->
        <div class="container row" style="margin:auto;">
            <?php
     include'partials/_dbconnect.php';
     $sql="select * from `categories`";
     $result=mysqli_query($conn,$sql);
     while($row=mysqli_fetch_assoc($result)){
        
        echo '<div class="card my-3" style="width: 18rem; margin:auto;">
        <img src="img/card-'.$row['category_id'].'.jfif" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">'.$row['category_name'].'</h5>
          <p class="card-text">'.substr($row['category_desc'],0,100).'...</p>
          <a href="Questionpage.php?catid='.$row['category_id'].'" class="btn btn-primary">Go on '.$row['category_name'].' Questions</a>
        </div>
      </div>';
     }
  ?>
        </div>


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
        </script>


        <?php include 'partials/_footer.php';?>
</body>

</html>