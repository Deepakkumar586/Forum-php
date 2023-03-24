<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>iDiscuss coading Forum</title>
    <style>
    #ques {
        min-height: 433px;
    }
    .flex-container {
           display: flex;
           padding: 16px;
           
        }
    </style>
</head>

<body>

    

    <?php include 'partials/db_connect.php';?>
    <?php include 'partials/_header.php';?>
    
    <?php
    $id = $_GET['threadid'];
     $sql = "SELECT * FROM `threads` WHERE thread_id = $id";
     $result = mysqli_query($conn,$sql);
     while($row = mysqli_fetch_assoc($result)){
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_user_id = $row['thread_user_id'];

            //Query the users table to find out the name of op
            $sql2  = "SELECT user_email FROM `users` WHERE sno = '$thread_user_id'";
            $result2 = mysqli_query($conn,$sql2);
            $row2 = mysqli_fetch_assoc($result2);
            


     }
    ?>

        <?php
            $showAlert = false;
            $method = $_SERVER['REQUEST_METHOD'];
            if($method=='POST'){
            // insert into  comment db
            $comment= $_POST['comment'];
            
          
           
            $sql = "INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$_SESSION[sno]', current_timestamp())";
            $result = mysqli_query($conn,$sql);
            $showAlert = true;
            if($showAlert){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> your comment has been added.!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }

            
           };
        ?>

    <!-- Category container starts here -->
    <div class="container my-4 ">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title;?></h1>
            <p class="lead"> <?php echo $desc;?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do not
                post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post
                questions. Remain respectful of other members at all times.</p>
            <button class="btn btn-success"> Learn more</button>
        </div>
    </div>
   

    <div class="container">
        <h1 class="py-3">Post a comment</h1>
        <!--  -->
        <form action="<?php  echo $_SERVER['REQUEST_URI']?>" method="post">
            
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Type your comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                <input type="hidden" name="sno" value=" ' . $_SESSION['sno'] .' ">
            </div>


            <button type="submit" class="btn btn-success">Post comment</button>
        </form>

    </div>

    <!-- thread start -->

    <div class="container" id="ques">

        <h1 class="py-3">Discussion</h1>
        <?php
            $id = $_GET['threadid'];
            $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
            $result = mysqli_query($conn,$sql);
            $noResult = true;
            while($row = mysqli_fetch_assoc($result)){
                $noResult = false;
            $id = $row['comment_id'];
            $content = $row['comment_content'];
            $comment_time = $row['comment_time'];
            $thread_user_id = $row['comment_by'];
            $sql2 = "SELECT user_email from `users` where sno ='$thread_user_id'";
            $result2 = mysqli_query($conn,$sql2);
            $row2 = mysqli_fetch_assoc($result2);
            
            
    
             echo '<div class="media my-3">
               <img src="img/defalut.png" width="54px" class="mr-3" alt="...">
                
               <div class="media-body py-3" >
             
               <strong class="py-0"> ' . $row2['user_email'] .'  ' . $comment_time . '</strong>
               <br>
               
               '.$content.'

                
                </div>
             
          </div>';
        }
        if($noResult){
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
            <p class="display-4">No Thread found</p>
            <p class="lead">Be the first person to ask a question </p>
            </div>
            </div>';
          }

        ?>
    </div>





    <?php   include 'partials/_footer.php';?>




    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>