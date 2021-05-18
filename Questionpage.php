
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body style="background-color: whitesmoke;">
    <?php 
    include 'partials/_dbconnect.php';
    include 'partials/_header.php';

    // $_SESSION['catidforsearch']=$_GET['catid'];
    
    // <!-- STORE A POSTED QUESTION IN DATABASE -->
  
  // when user click on postnow button
  $showalert=false;
  if($_SERVER['REQUEST_METHOD']=='POST' && empty($_POST["Title"])!=true && empty($_POST["Discription"])!=true){ 
    $c_id=$_GET['catid'];

//    here we used string replacement in 'question title' and 'question description' for '<' and '>'.if we do not replacement then when user will put any html or javascript tag in question and comments then it will be executed.this attack called as XSS Attack,EXAMPLE if we post question as <script>alert("script executed")</script> then there is shown alert box in our website. 
    $q_title=$_POST['Title'];
    $replacelt_q_title=str_replace("<","&lt",$q_title);   
    $replace_q_title=str_replace(">","&gt",$replacelt_q_title);  

    $q_desc=$_POST['Discription'];
    $replacelt_q_desc=str_replace("<","&lt",$q_desc);
    $replace_q_desc=str_replace(">","&gt",$replacelt_q_desc);

    $user_name=$_SESSION['username'];
    $_POST["Title"]="";
    $_POST["Discription"]="";

    $sql="insert into `questions` (`question_title`,`question_desc`,`category_id`,`user_name`) values ('$replace_q_title','$replace_q_desc','$c_id','$user_name')";
    $result=mysqli_query($conn,$sql);
    if($result){
      $showalert=true;
      echo "<script>console.log('fghfdhfdhdfhjdf');</script>";
    }
    else{
        echo "<script>console.log('query error occur');</script>";
        echo 'error-->'.mysqli_error($conn);
    }
  }
   if($showalert){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>success!</strong> Your Question has been post.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';
    }
    
  // save data in jumbotron from database
    $c_id=$_GET['catid'];
    $sql="select * from `categories` where `category_id`=$c_id";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);

    // start jumbotron
    echo '<div class="jumbotron col-8 my-2" style="margin:auto; padding:10px;">
        <h1 class="display-4 text-center" style="font-size:2.5rem">Let\'s Get a Solution of '.$row['category_name'].' Questions </h1>
        <p class="lead">'.$row['category_desc'].'</p>
        <hr class="my-4">
        <p class="text-center"><b style="margin-right: 444px;">Rules:<br></b>No Spam / Advertising / Self-promote in the
            forums. ...<br>
            Do not post copyright-infringing material. ...<br>
            Do not post “offensive” posts, links or images. ...<br>
            Do not cross post questions. ...<br>
            Do not PM users asking for help. ...<br>
            Remain respectful of other members at all times.</p>
      </div>';
    ?>


    <!-- // Post questions -----Here!we uses function $_SERVER['REQUEST_URI'].Because if we use post request on current page with catid then, there will be truncet the url(Because of Crash two url) so for this purpose(give post request with same catid on current page) we use this function. -->
    <p style="margin-left:252px;font-size:2rem;"><b>Post your Question</b></p>
    <div class="container col-8">
        <?php   
    // here we restricted user to post a question, who has not login.
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo '<form name="postquestion" action="'. $_SERVER['REQUEST_URI'].'" method="post"> 
        <div class="form-group">
            <label for="Title">Problem-Title</label>
            <input type="text" class="form-control" id="Title" name="Title" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="Discription">Problem-Description</label>
            <textarea class="form-control" id="Description" name="Discription" rows="3"></textarea>
        </div>


        <button type="submit" class="btn btn-success">Post Now</button>
        </form>';
        }
        else{
        echo '<div class="alert alert-warning" role="alert">
            oops!You have not logged in,please Login to post your questions.
        </div>';

        }
        ?>
    </div>
    <div  style="min-height: 400px; width:100%">
        <p class="my-1" style="margin-left:252px;font-size:2rem;"><b> Asked Questions:</b></p>


        <!-- // start media object -->
        <?php
           $noresultfound=true;
           $sql="select * from `questions` where `category_id`='$c_id'";
           $result=mysqli_query($conn,$sql);
          // $row=mysqli_fetch_assoc($result);
          while($row=mysqli_fetch_assoc($result)){
                $noresultfound=false;
                echo '<div class="media col-8 my-3" style="margin:auto; background-color: #eef8f8; border: 2px solid lightblue;
                border-radius: 5px; position: relative;">
                      <img src="img/userimage.png" width="40px" height="40" class="mr-3" alt="...">
                      <div class="media-body">
                      <h5 class="mt-0 mb-0"><p class="mb-2">'.$row['user_name'].' at '.$row['question_date'].' <span style="position: absolute;top: 2px; right: 36px;">'.$row['total_comment'].' Comments</span></p><a  href="Commentpage.php?question_id='.$row["question_id"].'"  style="color: blue;">'.$row['question_title'].'</a></h5>
                      '.$row['question_desc'].'
                       </div>
                </div>';
    }
    if($noresultfound){
        echo '<div class="jumbotron col-8 my-2" style="margin:auto; padding:10px;">
        <h1 class="display-4 text-center" style="font-size:2rem">No Result Found  </h1>
        <hr class="my-3">
        <p class="text-center" style="margin-bottom:0rem;">Be a first person to post a Question</p>
      </div>';
    }
    
    ?>
    </div>
    <!-- // SET footer -->
    <?php include'partials/_footer.php';?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</body>
</html>