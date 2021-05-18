<?php
session_start();
 include '_dbconnect.php';

 if(isset($_GET['action']) && $_GET['action'] == 'like'){
   $commentId = $_GET['commentid'];
   $user=$_SESSION['username'];
   $liked=true;
   $query="select `liked` from `likedanddisliked` where `comment_id`='$commentId' AND `username`='$user'";
   $queryresult=mysqli_query($conn,$query);
   $QRrows=mysqli_fetch_assoc($queryresult);
   $no=mysqli_num_rows($queryresult);
   if($no!=1){
    $insertliked="INSERT INTO `likedanddisliked`(`comment_id`,`username`,`liked`) VALUES('$commentId','$user','$liked')";
    $resultinsertliked=mysqli_query($conn,$insertliked);
    $queryForIncrementLike="UPDATE `comments` SET `total_likes`=`total_likes`+1 where `comment_id`='$commentId'";
    $result=mysqli_query($conn,$queryForIncrementLike);
    $getLikes = "SELECT * from `comments` where `comment_id`='$commentId'";
    $likes = mysqli_query($conn,$getLikes);
    $row=mysqli_fetch_assoc($likes);
    echo $row['total_likes'];
   }
   else{
     if($QRrows['liked']==true){
    $getLikes = "SELECT * from `comments` where `comment_id`='$commentId'";
    $likes = mysqli_query($conn,$getLikes);
    $row=mysqli_fetch_assoc($likes);
    echo $row['total_likes'];
     }
     else{
      //  totallikes increment by 1
      $queryForIncrementLike="UPDATE `comments` SET `total_likes`=`total_likes`+1 where `comment_id`='$commentId'";
      $result=mysqli_query($conn,$queryForIncrementLike);
    //  setting liked = true 
      $queryformakinglikedtrue="UPDATE `likedanddisliked` SET `liked`='$liked' where `comment_id`='$commentId' AND `username`='$user'";
      $queryformakinglikedtrueResult=mysqli_query($conn,$queryformakinglikedtrue);
    //  getting total likes 
      $getLikes = "SELECT * from `comments` where `comment_id`='$commentId'";
      $likes = mysqli_query($conn,$getLikes);
      $row=mysqli_fetch_assoc($likes);
      echo $row['total_likes'];
     }
   } 
 }
 if(isset($_GET['action']) && $_GET['action'] == 'dislike'){
  $commentId = $_GET['commentid'];
  $user=$_SESSION['username'];
  $disliked=true;
  $query="select `disliked` from `likedanddisliked` where `comment_id`='$commentId' AND `username`='$user'";
  $queryresult=mysqli_query($conn,$query);
  $QRrows=mysqli_fetch_assoc($queryresult);
  $no=mysqli_num_rows($queryresult);
  if($no!=1){
   $insertdisliked="INSERT INTO `likedanddisliked`(`comment_id`,`username`,`disliked`) VALUES('$commentId','$user','$disliked')";
   $resultinsertdisliked=mysqli_query($conn,$insertdisliked);
   $queryForDecrementLike="UPDATE `comments` SET `total_likes`=`total_likes`-1 where `comment_id`='$commentId'";
   $result=mysqli_query($conn,$queryForDecrementLike);
   $getLikes = "SELECT * from `comments` where `comment_id`='$commentId'";
   $likes = mysqli_query($conn,$getLikes);
   $row=mysqli_fetch_assoc($likes);
   echo $row['total_likes'];
  }
  else{
    if($QRrows['disliked']==true){
   $getLikes = "SELECT * from `comments` where `comment_id`='$commentId'";
   $likes = mysqli_query($conn,$getLikes);
   $row=mysqli_fetch_assoc($likes);
   echo $row['total_likes'];
    }
    else{
      // decrement like by 1 
     $queryForDecrementLike="UPDATE `comments` SET `total_likes`=`total_likes`-1 where `comment_id`='$commentId'";
     $result=mysqli_query($conn,$queryForDecrementLike);
    // setting disliked = true 
     $queryformakingdislikedtrue="UPDATE `likedanddisliked` SET `disliked`='$disliked' where `comment_id`='$commentId' AND `username`='$user'";
      $queryformakingdislikedtrueResult=mysqli_query($conn,$queryformakingdislikedtrue);
    // getting total likes 
     $getLikes = "SELECT * from `comments` where `comment_id`='$commentId'";
     $likes = mysqli_query($conn,$getLikes);
     $row=mysqli_fetch_assoc($likes);
     echo $row['total_likes'];
    }
  }

  //  $commentId = $_GET['commentid'];
  //  if(!isset($_SESSION['disliked'.$commentId])){
  // $queryForDecrementLike="UPDATE `comments` SET `total_likes`=`total_likes`-1 where `comment_id`='$commentId'";
  // $result=mysqli_query($conn,$queryForDecrementLike);
  // $_SESSION['disliked'.$commentId] = true;
  //  }
  // $getLikes = "SELECT * from `comments` where `comment_id`='$commentId'";
  // $likes = mysqli_query($conn,$getLikes);
  // $row=mysqli_fetch_assoc($likes);
  // echo $row['total_likes'];
 }

?>