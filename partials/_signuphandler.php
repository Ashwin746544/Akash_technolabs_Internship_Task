<?php
$showexisterror=false;
$showpassworderror=false;
$showalert=false;
 if($_SERVER['REQUEST_METHOD']=='POST'){
    include '_dbconnect.php';
    $username=$_POST['Username'];
    $password=$_POST['Password'];
    $cPassword=$_POST['cPassword'];

    $sql="select * from `users` where `username`='$username'";
    $result=mysqli_query($conn,$sql);
    $no=mysqli_num_rows($result);
    if($no==1){
        $showexisterror=true;
    }
    else{
        if($password==$cPassword){
        $hash=password_hash($password,PASSWORD_DEFAULT);
        $sql="insert into `users` (`username`,`password`) values ('$username','$hash')";
        $result=mysqli_query($conn,$sql);
        $showalert=true;
        }
        else{
            $showpassworderror=true;
        }
    }
    header("location:/forum/index.php?showpassworderror=$showpassworderror&showexisterror=$showexisterror&showalert=$showalert");
    

 }
 ?>