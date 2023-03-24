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
    </style>
</head>

<body>
    <?php include 'partials/db_connect.php';?>
    <?php include 'partials/_header.php';?>
   
    <?php
    $id = $_GET['catid'];
     $sql = "SELECT * FROM `categories` WHERE category_id = $id;";
     $result = mysqli_query($conn,$sql);
     while($row = mysqli_fetch_assoc($result)){
            $catname = $row['category_name'];
            $catdesc = $row['category_discription'];
     }
    ?>

    <?php
            $showAlert = false;
            $method = $_SERVER['REQUEST_METHOD'];
            if($method=='POST'){
            // insert into  thread db
            $th_title = $_POST['title'];
            $th_desc = $_POST['desc'];
            
            $sql = "INSERT INTO `threads` ( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$_SESSION[sno]', current_timestamp())";
            $result = mysqli_query($conn,$sql);
            $showAlert = true;
            if($showAlert){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> your thread has been added.! please wait for community respond
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }

            
           };
      ?>

    <!-- Category container starts here -->
    <div class="container my-4 ">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $catname;?></h1>
            <p class="lead"> <?php echo $catdesc;?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do not
                post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post
                questions. Remain respectful of other members at all times.</p>
            <button class="btn btn-success"> Learn more</button>
        </div>
    </div>

    <div class="container">
    <h1 class="py-3">Ask a questions</h1>
    <!--  -->
    <form action="<?php  echo $_SERVER['REQUEST_URI']?>" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Problem title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                <div id="titlehelp" class="form-text">Keep your title as short and crisp as possible</div>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Elaborate your Concern</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>


            <button type="submit" class="btn btn-success">Submit</button>
        </form>

    </div>

    <!-- thread start -->

    <div class="container" id="ques">

       
        <?php
            $id = $_GET['catid'];
            $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
            $result = mysqli_query($conn,$sql);
            $noResult = true;
            while($row = mysqli_fetch_assoc($result)){
                $noResult = false;
            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_time = $row['timestamp'];
            $thread_user_id = $row['thread_user_id'];
            $sql2 = "SELECT user_email from `users` where sno ='$thread_user_id'";
            $result2 = mysqli_query($conn,$sql2);
            $row2 = mysqli_fetch_assoc($result2);
           


            
    
             echo '<div class="media my-3">
               <img src="img/defalut.png" width="54px" class="my-3" alt="...">
                
               <div class="media-body">
                <strong class="my-2 "> Asked By - ' . $row2['user_email'] . 'at' . $thread_time . '</strong>

               <h5 class="mt-0  py-2 "><a href="thread.php?threadid='. $id .'">'. $title .'</a></h5>
               '.$desc.'

                
                </div>
             
          </div>';
        }
        // echo var_dump($noResult);
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