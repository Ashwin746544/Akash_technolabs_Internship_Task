<?php
if($_GET['str'] == "like"){
    $commentId=$_GET['commentid'];
        if(isset($_SESSION['username'])){ 
            $queryforliked= "SELECT `liked`,`disliked` FROM `likedanddisliked` WHERE `comment_id`='$commentId' AND `username`='$_SESSION['username']'";
            $queryforlikedresult=mysqli_query($conn,$queryforliked);
            $rowforliked=mysqli_fetch_assoc($queryforlikedresult);  
            if($rowforliked["liked"]==true) {
             echo 'img/thumb-up.png';
            }else{
                echo 'img/like-2.png';
            }
        }else {echo 'img/like-2.png';}
    }
if($_GET['str'] == "dislike"){
    $commentId=$_GET['commentid'];
        if(isset($_SESSION['username'])){ 
            $queryfordisliked= "SELECT `liked`,`disliked` FROM `likedanddisliked` WHERE `comment_id`='$commentId' AND `username`='$_SESSION['username']'";
            $queryfordislikedresult=mysqli_query($conn,$queryfordisliked);
            $rowfordisliked=mysqli_fetch_assoc($queryfordislikedresult);  
            if($rowfordisliked["liked"]==true) {
             echo 'img/thumb-down.png';
            }else{
                echo 'img/dislike-2.png';
            }
        }else {echo 'img/dislike-2.png';}
    }
  ?>