<?php

session_start();

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/forem/index.php">iDiscuss</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/forem/index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Top Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
        $sql="select * from `category` Limit 4";
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
         echo '<a class="dropdown-item" href="threadlist.php?catid='.$row['S.no'].'">'.$row['category_name'].'</a>';
        }
        echo '</div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>';
      if( isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true ){
        echo ' <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
        <p class="text-light my-0 mx-2"> Welcome '.$_SESSION['username'].'</p>
        <a href="/forem/partials/_logout.php"><button class="btn btn-outline-success ml-2" type="button" >Logout</button></a>
        </form>
        </div>
      </nav>';
      }
      else{

       echo ' <form class="form-inline my-2 my-lg-0">
       <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
       <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
       <button class="btn btn-outline-success ml-2" type="button" data-toggle="modal" data-target="#loginmodal">Login</button>
        <button class="btn btn-outline-success mx-2" type="button" data-toggle="modal" data-target="#signupmodal"  >Signup</button>
        </form>
        </div>
      </nav>';
        
      }
 
?>

<?php
include 'partials/_loginmodal.php';
include 'partials/_signupmodal.php';

?>

<?php

if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']==true){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success!</strong> Your account is created Successfullly.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
if(isset($_GET['signupfail']) && $_GET['signupfail']==true){
  echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>Error!</strong> Password do not match,Please try again.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
if(isset($_GET['userexists']) && $_GET['userexists']==true){
  echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>Error!</strong> Email is already Exists, Please try another one.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']==true){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success!</strong> Your are logged in Successfullly.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

if(isset($_GET['loginfail']) && $_GET['loginfail']==true){
  echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>Error!</strong> Invalid Credentials.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

?>