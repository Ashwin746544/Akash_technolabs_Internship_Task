<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body style="background-color: whitesmoke;">
<?php
    include 'partials/_dbconnect.php';
    include 'partials/_header.php';

    $search_str=$_GET['SEARCH'];
    $catid=$_GET['catidfrominputhidden'];
    $noresultfound=true;
    echo '<p class="text-center my-3" style="font-size:3rem;">search result for "<em>'.$search_str.'</em>"</p>';
    $sql="select * from `questions` where match (`question_title`,`question_desc`) against ('$search_str') AND `category_id`='$catid'";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        $noresultfound=false;
        echo '<div class="media col-8 my-3" style="margin:auto;">
               <img src="img/userimage.png" width="40px" height="40" class="mr-3" alt="...">
               <div class="media-body">
               <h5 class="mt-0 mb-0"><p class="mb-2">'.$row['user_name'].' at '.$row['question_date'].' </p><a href="Commentpage.php?question_id='.$row["question_id"].'" class="text-dark">'.$row['question_title'].'</a><h5>'.$row['question_desc'].'
               </div>
            </div>';

       }
       if($noresultfound){
             echo '<div class="jumbotron col-8 my-2" style="margin:auto; padding:10px;">
                    <h1 class="display-4 text-center" style="font-size:2rem">No Result Found  </h1>
                    <hr class="my-3">
                   <p class="text-center" style="margin-bottom:0rem;">Your search -"'.$search_str.'"  - did not match any documents.</p>
                   <div class="mt-2" style="margin-left:63px;">
                   <p>Suggestions:</p>
                   <ul>
                   <li>Make sure that all words are spelled correctly.</li>
                   <li>Try different keywords.</li>
                   <li>Try more general keywords.</li>
                   </ul>
                   </div>
                 </div>';
              }
?>

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