<?php
$login=false;
$invalid=false;
if($_SERVER['REQUEST_METHOD']=='POST'){
    include '_dbconnect.php';
    $username=$_POST['username'];
    $password=$_POST['password'];

    

     $sql="SELECT * FROM `users` WHERE `username`='$username'";
     $result=mysqli_query($conn,$sql);
     if(!$result){
         echo mysqli_error($conn);
     }
     $no=mysqli_num_rows($result);
     
     if($no==1){
           $row=mysqli_fetch_assoc($result);
           if(password_verify($password,$row['password'])){
             
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['username']=$username;
             $login=true;
         }
     
    
     else{
        $invalid=true;
     }
    

     }
    else{
        $invalid=true;
    }
     header("location:/forum/index.php?login=$login&invalid=$invalid");

}


?>