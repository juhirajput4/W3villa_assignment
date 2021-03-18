<?php
session_start();

   $con = mysqli_connect('localhost','root');
   	// if($con){
   	// 	echo"connection";
   	// }
   	mysqli_select_db($con,'quizdb');
?>
<!DOCTYPE html>
<html>
   <head>
      <title></title>
      <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<style type="text/css">
  .animateuse{
      animation: leelaanimate 0.5s infinite;
    }

@keyframes leelaanimate{
      0% { color: red },
      10% { color: yellow },
      20%{ color: blue }
      40% {color: green },
      50% { color: pink }
      60% { color: orange },
      80% {  color: black },
      100% {  color: brown }
    }
</style>
</head>
<body>
     <div class="container text-center" >
      <br><br>
      <h1 class="text-center text-success text-uppercase animateuse" > Quiz Application</h1>
      <br><br><br><br>
      <table class="table text-center table-bordered table-hover">
        <tr>
          <th colspan="2" class="bg-dark"> <h1 class="text-white"> Results </h1></th>
          
        </tr>
         <tr>
          <td colspan="2"> Level Medium </td>
          
        </tr>
        <tr>
            <td>
              Questions Attempted
            </td>
            <?php
              $counter = 0;
              $Resultans = 0;
              if(isset($_POST['submit'])){
              if(!empty($_POST['quizcheck'])) {
          
              $checked_count = count($_POST['quizcheck']); ?>
            
              <td><?php echo "Out of 5, You have attempt ".$checked_count." option."; ?> </td>
          </tr>

              <?php 
              $selected = $_POST['quizcheck'];
            
              $q1= " select * from questionsm ";
              $ansresults = mysqli_query($con,$q1);
              $i = 1;
              while($rows = mysqli_fetch_array($ansresults)) {
                // print_r($rows);
                $flag = $rows['a_id'] == $selected[$i];
              
                  if($flag){
                      
                    $counter++;
                    $Resultans++;
                    
                  }else{
                    $counter++;
                  }         
                $i++;   
              }
              ?>
              <tr>
                <td>Your Score:</td>
              <td><?php echo $Resultans ;?></td>
            </tr>
            <tr>
              <td>Report:</td>
              <td><?php 
                  if($Resultans==5)
                    {echo "Very Strong General Knowledge";}
                  if($Resultans==4)
                    {echo "Strong General Knowledge";}
                  if($Resultans==3)
                    {echo "Good General Knowledge";}
                  if($Resultans==2)
                    {echo "Bad General Knowledge";}
                  if($Resultans==1)
                    {echo "Poor General Knowledge";}

              ?></td>
            </tr>
            <?php
          }
        }
      ?>
    </table>
</div>
</body>
</html>
