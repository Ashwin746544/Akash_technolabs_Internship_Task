<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php 
  echo '<h1 class="heading" >This is h1</h1>';
  echo '<button onclick="gamete()">click</button>';
 
?>

<script>
 function gamete(){
    console.log("in function");
      var xhttp=new XMLHttpRequest();
      xhttp.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
          
          document.getElementsByClassName("heading")[0].innerHTML=this.responseText.split(",")[2];
        
        }
      }
      xhttp.open("GET","_TopCategory.php",true);
      xhttp.send();
 }

</script>

  
</body>
</html>
