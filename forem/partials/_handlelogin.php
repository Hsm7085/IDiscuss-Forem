<?php

if($_SERVER['REQUEST_METHOD']=="POST"){
    
include '_dbconnect.php';
    $email=$_POST['loginemail'];
    $pass=$_POST['loginpassword'];
   

    $sql="SELECT * FROM `users` WHERE `user_email` LIKE '$email' AND `user_password` LIKE '$pass'";
    $result=mysqli_query($conn,$sql);
    $num=mysqli_num_rows($result);
    $row=mysqli_fetch_assoc($result);
    if($num==1){
        session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['username']=$email;
            $_SESSION['sno']=$row['S.no'];
           header("location:/forem/index.php?loginsuccess=true");
          exit();
      
    }
    else{
            header("location:/forem/index.php?loginfail=true");
        exit();
        }
 //   header("location:/forem/index.php?a=1");
//     $hash=$row['user_password'];
    
//  echo $password;
//  echo $hash;
    // if (password_verify($password, $hash)) {
    //     echo 'Password is valid!';
    // }
    // if($password==$row['user_password']){
    //     echo 'yes';
    // }
    // else{
    //     echo 'no';
    // }
    // if($num==1 && $hash==true){
    //     session_start();
    //     $_SESSION['loggedin']=true;
    //     $_SESSION['username']=$email;
    //   header("location:/forem/index.php?loginsuccess=true");
    // }
    // else{
    //     header("location:/forem/index.php?loginfail=true");
    // }
}

?>