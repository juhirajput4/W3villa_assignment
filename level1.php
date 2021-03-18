<?php
   session_start();

   // Connection to Database 
   $con = mysqli_connect('localhost','root');
   mysqli_select_db($con,'quizdb');
   
   ?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Level 1 Quiz</title>

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
         .quizsetting{
          height: 1400px;
        }
        .cl-tab{
          border-color:black;
          border-radius: 4px;  
        }
        .timer {
          width: 100px;
          font-size: 2.5em;
          text-align: center;
      }
      </style>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <div class="navbar-brand navbar-brand-centered" style="margin-left: 500px">Quiz Application</div>
                </div>  
            </div>
        </nav>
      <div>
       
      <div class="container"><br>
         <div class="container " style="margin-top: 25px">
            <br>
            <br>
            <div class=" col-lg-12 text-center animateuse">
               <h3>Welcome to Quiz </h3>
            </div>
            <br>
            <div class="col-lg-12 d-block m-auto bg-light quizsetting ">
               <div class="card" style="background-color: black; color: white;">
                  <p class="card-header text-center">You have to select only one out of 4. Best of Luck</p>
               </div>
               <div class="timer">
            <time id="countdown">0:30</time>
        </div>
               <br>
               <form name="myForm" id="myForm" action="check_level1.php" method="post">
                  <?php
                     for($i=1;$i<6;$i++){
                     $l = 1;
                  
                     $ansid = $i;

                     $sql1 = "SELECT * FROM `questions` WHERE `q_id` = $i ";
                        $result1 = mysqli_query($con, $sql1);
                            if (mysqli_num_rows($result1) > 0) {
                                            while($row1 = mysqli_fetch_assoc($result1)) {
                        ?>              
                  <br>
                  <div class="card">
                     <br>
                     <p class="card-header cl-tab">  <?php echo $i ." : ". $row1['question']; ?> </p>
                    
                     <?php
                        $sql = "SELECT * FROM `answers` WHERE `ans_id` = $i ";
                            $result = mysqli_query($con, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                                while($row = mysqli_fetch_assoc($result)) {
                            ?>  
                           
                     <div class="card-block">
                        <input type="radio" name="quizcheck[<?php echo $ansid; ?>]" id="<?php echo $ansid; ?>" value="<?php echo $row['a_id']; ?>" > <?php echo $row['answer']; ?> 
                        <br>
                     </div>
                     <?php
                        
                        } } 
                        $ansid = $ansid + $l;
                        } }}
                        
                     ?>
                  </div>

                  <br>
                  <input type="submit" id="submit" name="submit" Value="Submit" class="btn btn-success m-auto d-block" /> <br>
               </form>
               
            </div>
            <br>
         </div>
         <br>
      </div>
      
        </ul>
      </div>
      <script type="text/javascript">
      var seconds = 30;
      function secondPassed() {
          var minutes = Math.round((seconds - 30)/60),
              remainingSeconds = seconds % 60;

          if (remainingSeconds < 10) {
              remainingSeconds = "0" + remainingSeconds;
          }

          document.getElementById('countdown').innerHTML = minutes + ":" + remainingSeconds;
          if (seconds == 0) {
            document.getElementById("submit").click();
          } else {
              seconds--;
          }
      }
      setInterval('secondPassed()', 1000);
      </script>


   </body>
</html>

