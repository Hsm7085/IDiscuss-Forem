<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>iDiscuss Forem</title>
    <style>
    #ques {
        min-height: 500px;
    }
    </style>
</head>

<body>
    <?php
  include 'partials/_dbconnect.php';
  include 'partials/_nav.php';

 $id=$_GET['catid'];
  $sql=" SELECT * FROM `category` WHERE `S.no`=$id";
  $result=mysqli_query($conn,$sql);
  while($row=mysqli_fetch_assoc($result)){
    $catname=$row['category_name'];
    $catdesc=$row['category_desc'];

 }
  ?>
    <div class="container my-3">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname; ?> Forem</h1>
            <p class="lead"><?php echo $catdesc;?></p>
            <hr class="my-4">

        </div>
    </div>



    




    <div class="container my-3 " id="ques">
        <h1 class="text-center">Browse Questions </h1>
        <!-- Comments -->
        <?php
         if( isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true ){
             echo '
        <div class="container my-4">
            <form action="'. $_SERVER['REQUEST_URI'].'" method="post">
                <div class="form-group">
                    <label for="prob">Problem</label>
                    <input type="text" class="form-control" id="prob" name="prob" aria-describedby="emailHelp">

                </div>
                <div class="form-group">
                    <label for="eprob">Ellaborate Your Problem.</label>
                    <!-- <input type="text" class="form-control" id="eprob" name="eprob"> -->
                    <textarea name="eprob" id="eprob" cols="30" rows="6" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-success">Comment</button>
            </form>
        </div>';
          }

          else{
             echo '<p class="lead">You are not loggedin. Please login to Post Questions.</p>';
          }
          ?>

        <?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $sno=$_SESSION['sno'];
            $prob=$_POST['prob'];
            $eprob=$_POST['eprob'];
        
        $sql="INSERT INTO `thread` ( `thread_title`, `thread_desc`, `thread_user_id`, `date`, `thread_cat_id`) VALUES ( '$prob', '$eprob', '$sno', current_timestamp(), '$id')";

        $result=mysqli_query($conn,$sql);
        if($result){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your Comment is added Successfully.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        }
    }



    ?>



        <?php
 
    $id=$_GET['catid'];
    $sql="SELECT * FROM `thread` WHERE `thread_cat_id`=$id";
    $result=mysqli_query($conn,$sql);
    $noresult=true;
    while($row=mysqli_fetch_assoc($result)){
        $noresult=false;
        $thread_id=$row['thread_id'];
        $title=$row['thread_title'];
        $desc=$row['thread_desc'];
        $thread_user_id=$row['thread_user_id'];
        $sql2="SELECT user_email FROM `users` WHERE `S.no`=$thread_user_id";
        $result2=mysqli_query($conn,$sql2);
        $row2=mysqli_fetch_assoc($result2);



    echo   ' <div class="media my-5 ">
            <img src="https://www.clipartkey.com/mpngs/m/152-1520367_user-profile-default-image-png-clipart-png-download.png"
                width="54px" class="mr-3" alt="...">
            <div class="media-body">
            
                <h5 class="mt-0"><a class="text-dark" href="thread.php?thread_id='.$thread_id.'">'.$title.'</a></h5>
               '.$desc.'
            </div>
            <p class="font-weight-bold my-0">'.$row2['user_email'].' at '.$row['date'].' </p>
        </div>';
 }

    if($noresult){
      echo  '<div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">No Result Found</h1>
                <p class="lead"><b>Be the first person to comment.</b></p>
            </div>
        </div>';
    }
  ?>


    </div>

    <div class="container-fluid bg-dark text-light">
        <p class="text-center">Copyright</p>
    </div>
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