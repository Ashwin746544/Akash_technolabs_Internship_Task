
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
//     // <!-- STORE A POSTED COMMENT IN DATABASE -->
  
//   // when user click on postNow button
  $showalert=false;
  if($_SERVER['REQUEST_METHOD']=='POST' && empty($_POST["Discription"])!=true){ 
    $q_id=$_GET['question_id']; 
    // here we increment total_comment by 1 for this question  
    $queryforincrementtotal_comment="UPDATE `questions` SET `total_comment`=`total_comment`+1 where `question_id`='$q_id'";
    $result=mysqli_query($conn,$queryforincrementtotal_comment);
    

    //  here we used string replacement in 'question title' and 'question description' for '<' and '>'.if we do not replacement then when user will put any html or javascript tag in question and comments then it will be executed.this attack called as XSS Attack,EXAMPLE if we post question as <script>alert("script executed")</script> then there is shown alert box in our website.

    $comment_content=$_POST['Discription'];
    $replacelt_comment_content=str_replace("<","&lt",$comment_content);
    $replace_comment_content=str_replace(">","&gt",$replacelt_comment_content);

    $user_name=$_SESSION['username'];
    $_POST["Discription"]="";
    echo $_POST["Discription"];

    $sql="insert into `comments` (`comment_content`,`user_name`,`question_id`) values ('$replace_comment_content','$user_name','$q_id')";
    $result=mysqli_query($conn,$sql);
    if($result){
      $showalert=true;
    }
    else{
      echo 'error-->'.mysqli_error($conn);
    }
  }
   if($showalert){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>success!</strong> Your Comment has been added.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';
    }
    
  // save data in jumbotron from database
    $q_id=$_GET['question_id'];
    $sql="select * from `questions` where `question_id`=$q_id";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);

    // start jumbotron
    echo '<div class="jumbotron col-8 my-2" style="margin:auto; padding:10px;">
        <h1 class="display-4 text-center" style="font-size:2.5rem"> '.$row['question_title'].' </h1>
        <hr class="my-4">
        <p class="text-center">'.$row['question_desc'].'</p>
         Post by:<b>'.$row['user_name'].'</b>
      </div>';
    ?>


    <!-- // Post questions -->
    <p style="margin-left:252px;font-size:2rem;"><b>Add Your Comment</b></p>
    <div class="container col-8">
        <?php 
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        echo '<form action="'. $_SERVER['REQUEST_URI'].'" method="post">
            <div class="form-group">
                <label for="Discription">Description</label>
                <textarea class="form-control" id="Description" name="Discription" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Add Comment</button>
        </form>';
    }
    else{
      echo '<div class="alert alert-warning" role="alert">
            Hey!please Login to post your comments.
        </div>';
    }
    ?>
    </div>
    <div style="min-height: 400px; width:100%;">
        <p class="my-1" style="margin-left:252px;font-size:2rem;"><b>All Comments</b></p>

        <!-- // start media object -->
        <?php
        $queryForImgSource=
        //    $like = 'like';
        //    $dislike = 'dislike';
           $noresultfound=true;
           $q_id=$_GET['question_id'];
           $sql="select * from `comments` where `question_id`='$q_id'";
           $result=mysqli_query($conn,$sql);
          // $row=mysqli_fetch_assoc($result);
          while($row=mysqli_fetch_assoc($result)){
              $noresultfound=false;
                echo '<div class="media col-8 my-3" style="margin:auto; background-color: lightcyan; border: 2px solid lightblue;
                border-radius: 5px; width:100%;">
                      <img src="img/userimage.png" width="40px" height="40" class="mr-3" alt="...">
                      <div class="media-body" style="display:inline-block">
                      <h5 class="mt-0 ">'.$row['user_name'].' at '.$row['comment_date'].'</h5>
                      '.$row['comment_content'].'
                       </div>
                 <div>
                      <div style="display:inline-block; margin-right: 20px; margin-top: 7px;"><img id="like'.$row['comment_id'].'"';
    // here when user login again then we check whether user already liked or disliked specific comment and if user already liked or disliked then we set src of image=thumb-up.png or thumb-down.png(which means user already liked or disliked) and if user not liked or disliked then we set src of img=like-2.png or dislike-2.png                  
                      if(isset($_SESSION['username'])){ 
                        $queryforliked= "SELECT `liked`,`disliked` FROM `likedanddisliked` WHERE `comment_id`='{$row['comment_id']}' AND `username`='{$_SESSION['username']}'";
                        $queryforlikedresult=mysqli_query($conn,$queryforliked);
                        $rowforliked=mysqli_fetch_assoc($queryforlikedresult);
                        $noOfRows=mysqli_num_rows($queryforlikedresult);  
                        if($noOfRows==1 && $rowforliked["liked"]==true) {
                        echo 'src="img/thumb-up.png"';}else{echo 'src="img/like-2.png"';}}else {echo 'src="img/like-2.png"';}
                      echo 'name="like" onclick="getTotalLikes(this.name,'.$row['comment_id'].')" style="height: 40px;"></img></div>
                      <div style="display: inline-block; margin-right: 20px;font-size: 18px;"><p id="p'.$row['comment_id'].'">'.$row['total_likes'].'</p></div>
                       <div style="display:inline-block; margin-top: 7px;"><img id="dislike'.$row['comment_id'].'"';
                       if(isset($_SESSION['username'])){ 
                        $queryfordisliked= "SELECT `liked`,`disliked` FROM `likedanddisliked` WHERE `comment_id`='{$row['comment_id']}' AND `username`='{$_SESSION['username']}'";
                        // here above in query $queryforliked and $queryfordisliked  we have to use
                        // `comment_id`='{$row['comment_id']}' and `username`='{$_SESSION['username']' instead of `comment_id`='$row['comment_id']' and `username`='$_SESSION['username']'(otherwise it gives Error)                        
                       $queryfordislikedresult=mysqli_query($conn,$queryfordisliked);
                       $rowfordisliked=mysqli_fetch_assoc($queryfordislikedresult);  
                       if($noOfRows==1 && $rowfordisliked["disliked"]==true) {
                      echo 'src="img/thumb-down.png"';}else{echo 'src="img/dislike-2.png"';}}else{echo 'src="img/dislike-2.png"';}
                       echo 'src="img/dislike-2.png" name="dislike" onclick="getTotalLikes(this.name,'.$row['comment_id'].')" style="height: 40px;"></img></div>
                 </div>
                </div>';
    }
    if($noresultfound){
        echo '<div class="jumbotron col-8 my-2" style="margin:auto; padding:10px;">
        <h1 class="display-4 text-center" style="font-size:2rem">No Result Found  </h1>
        <hr class="my-3">
        <p class="text-center" style="margin-bottom:0rem;">Be a first person to post a comment</p>
      </div>';
    }
    
    ?>
    </div>
    <!--  SET footer -->
    <?php include'partials/_footer.php';?>
    <!-- function for increment like in database by AJAX -->
    <?php echo '<script>
    function getTotalLikes(str, commentId) {
        console.log("inside gettotallikes");';
        if(isset($_SESSION["loggedin"])){
            echo 'var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if(str=="like"){
                    document.getElementById("like" + commentId).src="img/thumb-up.png";
                    document.getElementById("like" + commentId).setAttribute("title","You already liked!");
                    }
                    if(str=="dislike"){
                    document.getElementById("dislike" + commentId).src="img/thumb-down.png";
                    document.getElementById("dislike" + commentId).setAttribute("title","You already disliked!");
                    }

                    document.getElementById("p" + commentId).innerHTML = this.responseText;
                    console.log("after set responseText");
                }
            }
            xhttp.open("GET", "partials/_NoOfLikes.php?action=" + str + "&commentid=" + commentId, true);
            xhttp.send();';
        } else {
          echo 'alert("You have to login for this action");';
        }
    echo '}
    </script>';
    ?>


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