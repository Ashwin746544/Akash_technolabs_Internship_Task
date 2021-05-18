<?php
include 'partials/_dbconnect.php';
include 'partials/_header.php';
if(isset($_POST['submit'])){
     $msg = $_POST['discription'];
     $to = "ahpatel99999@gmail.com";
     $subject = "Contact";
     $fromUser = $_POST['name'];
     $emailfrom = $_POST["email"];
     $headers = "From:".$emailfrom;
    //  mail($to,$subject,$msg,$headers);
     if(mail($to,$subject,$msg,$headers)){
         echo "mail successfully sent!";
     }else{
         echo "mail not sent!";
     }
 }
?>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <title>Contact-Us</title>
        <style>
            #outer {
                width: 800px;
                margin: auto;
                /* background-color: aliceblue; */
            }
            
            form div {
                position: relative;
                text-align: center;
                width: 600px;
                margin: auto;
                margin-top: 10px;
                margin-bottom: 35px;
            }
            
            div form button {
                display: block;
                width: 80;
                margin: auto;
            }
            
            h2 {
                /* display: block;
            margin: auto; */
                text-align: center;
                margin-top: 25px;
                margin-bottom: 25px;
            }
            
            .containerDiv {
                width: 100%;
                height: 100%;
                display: flex;
                justify-content: center;
            }
            
            label {
                color: blue;
                font-size: 21px;
                position: absolute;
                left: 83px;
                top: -9px;
            }
            
            #submit {
                color: white;
                background-color: rgb(22, 119, 22);
                font-size: 21px;
                padding: 3px;
                border-radius: 3px;
            }
            
            #submit:hover {
                box-shadow: 5px 5px rgb(204, 200, 200);
                background-color: rgb(43, 184, 43);
            }
            
            .inputfield:focus {
                border-radius: 11px;
                outline: none;
                border: 2px solid black;
            }
            
            textarea,
            input {
                border-radius: 11px;
                border: 1px solid grey;
                outline: none;
            }
        </style>
    </head>

    <body style="background-color: whitesmoke;">
        <div class="containerDiv">
            <div class="outer">
                <h2>Contact Us by Submitting below Form</h2>
                <div id="inner">
                    <form action="#" method="post">
                        <div>
                            <label for="name">Name</label><br>
                            <input class="inputfield" type="text" name="name" size="55"><br>
                        </div>
                        <div>
                            <label for="Email Address">Email Address</label><br>
                            <input class="inputfield" type="email" name="email" size="55"><br>
                        </div>
                        <div>
                            <label for="Discription">Discription</label><br>
                            <textarea class="inputfield" name="discription" id="" cols="58" rows="8"></textarea> <br>
                        </div>
                        <div>
                            <button id="submit" type="submit" name="submit">submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php include'partials/_footer.php';?>
    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
        < /html>