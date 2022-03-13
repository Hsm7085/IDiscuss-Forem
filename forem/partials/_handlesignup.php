<?php
$showalert=false;
$showError=false;
include '_dbconnect.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    $email=$_POST['signupemail'];
    $password=$_POST['signuppassword'];
    $cpassword=$_POST['signupcpassword'];

    $exists="SELECT * FROM `users` WHERE user_email ='$email'";
    $result=mysqli_query($conn,$exists);
    $num_rows=mysqli_num_rows($result);
    if($num_rows>0){
        $showError="Username already exists";
        header("location:/forem/index.php?userexists=true");
        exit();
    }
    else{
        if($password==$cpassword){
        $showalert=true;
       // $hash=password_hash($password,PASSWORD_DEFAULT);
        $sql="INSERT INTO `users` ( `user_email`, `user_password`, `date`) VALUES ( '$email', '$password', current_timestamp());";
            $result=mysqli_query($conn,$sql);
            if($result){
                header("location:/forem/index.php?signupsuccess=true");
               exit();
            }
        }
        else{
            $showalert="Password do not match";
            header("location:/forem/index.php?signupfail=true");
            exit();
        }
    }
}

?>