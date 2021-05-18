<?php
session_start();
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" >iDiscuss</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/forum/index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/forum/index.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           Top Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
        // $sql="select * from `categories` LIMIT 5";
        // $result=mysqli_query($conn,$sql);
        // echo '<a class="dropdown-item" href="/forum/Questionpage.php?catid='.$row["category_id"].'">'.$row["category_name"].'</a>';
        // echo '<a class="dropdown-item" href="/forum/Questionpage.php?catid='.$row["category_id"].'">'.$row["category_name"].'</a>';
        // echo '<a class="dropdown-item" href="/forum/Questionpage.php?catid='.$row["category_id"].'">'.$row["category_name"].'</a>';
        // echo '<a class="dropdown-item" href="/forum/Questionpage.php?catid='.$row["category_id"].'">'.$row["category_name"].'</a>';
        // echo '<a class="dropdown-item" href="/forum/Questionpage.php?catid='.$row["category_id"].'">'.$row["category_name"].'</a>';

        $Query="select category_id,category_name from `categories`";
        $result=mysqli_query($conn,$Query);
        $array1=array();
        // $array2=array();
        while($row=mysqli_fetch_assoc($result)){
              $catid=$row['category_id'];
              $sql="select * from `questions` where `category_id`=$catid";
              $sqlresult=mysqli_query($conn,$sql);
              $no=mysqli_num_rows($sqlresult);
              $array1[$row['category_name']]=$no;
     
            }
        arsort($array1);
        $keys=array_keys($array1);
        echo "<script>console.log(".json_encode($array1).");</script>";
        function getcatid($cat_name){
                 $sql="select category_id from `categories` where `category_name`='$cat_name'";
                 global $conn;
                 $res=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_assoc($res)){
                            return $row['category_id'];
                    }
              }
        echo '<a class="dropdown-item" href="/forum/Questionpage.php?catid='.getcatid($keys[0]).'">'.$keys[0].'</a>';
        echo '<a class="dropdown-item" href="/forum/Questionpage.php?catid='.getcatid($keys[1]).'">'.$keys[1].'</a>';
        echo '<a class="dropdown-item" href="/forum/Questionpage.php?catid='.getcatid($keys[2]).'">'.$keys[2].'</a>';
        echo '<a class="dropdown-item" href="/forum/Questionpage.php?catid='.getcatid($keys[3]).'">'.$keys[3].'</a>';
        echo '<a class="dropdown-item" href="/forum/Questionpage.php?catid='.getcatid($keys[4]).'">'.$keys[4].'</a>';
      
         
  //  echo '<script>
  //      var TC=document.getElementsByClassName("dropdown-item");
  //     var xhttp=new XMLHttpRequest();
  //     xhttp.onreadystatechange=function(){
  //       if(this.readyState==4 && this.status==200){
  //         var myobj=JSON.parse(this.responseText);
          
        
  //       }
  //     }
  //     xhttp.open("GET","_TopCategory.php",true);
  //     xhttp.send();
  //    </script>';
     
        // <!-- // $n=1;
        // // while($row=mysqli_fetch_assoc($result)){
        // //       echo '<a class="dropdown-item" href="/forum/Questionpage.php?catid='.$row["category_id"].'">'.$row["category_name"].'</a>';
        // //   } -->
       
      
      echo  '</div>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="/forum/contact.php">Contact-Us</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="/forum/search.php" >';

    if(substr($_SERVER['REQUEST_URI'],0,23)=="/forum/Questionpage.php"){
       $cat=$_GET['catid'];
       echo '<input type="hidden" name="catidfrominputhidden" value="'.$cat.'">';
       }
      
     echo '<input class="form-control mr-sm-2" type="search" name="SEARCH" placeholder="Search Question" aria-label="Search">';

      if(substr($_SERVER['REQUEST_URI'],0,23)=="/forum/Questionpage.php"){
      echo '<button class="btn btn-success my-2 my-sm-0" type="submit" >Search</button>';
      }
      else{
        echo '<button class="btn btn-success my-2 my-sm-0" type="submit" disabled>Search</button>';
      }
    echo '</form>';
    if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true){
      echo '<button class="btn btn-outline-success my-2 my-sm-0 mx-2" data-toggle="modal" data-target="#logoutmodal" >Logout</button>';
    }
    else{
   echo '<button class="btn btn-outline-success my-2 my-sm-0 mx-2" data-toggle="modal" data-target="#loginmodal">Login</button>
         <button class="btn btn-outline-success my-2 my-sm-0" data-toggle="modal" data-target="#signupmodal">Signup</button>';
    }
    echo '</div>
    </nav>';
   
include'partials/_signupmodal.php';
include'partials/_loginmodal.php';
include'partials/_logoutmodal.php';
?>