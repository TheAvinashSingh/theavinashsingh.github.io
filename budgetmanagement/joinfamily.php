<!doctype html>
<html>
<head>
    <link href="css/joinfamilystyle.css" rel="stylesheet" type="text/css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Family</title>
</head>
<body>
    <div class="container">
    <?php include_once('connection.php');
          session_start();
    ?>


    <?php     
    include_once("joinfamilyheader.php");
    ?>

    
    <?php?>
            <div class="content">
            
              <div class="uppertext">
               <div class="img1" style="width:15vw;float:left;margin-left:10vw;margin-top:1vh;" >
                <img class="familypic" src="images/family.png" style="width:70%;height:70%;" />'
               </div>
                  <div class="text1">
                  <h1 class="familyheading">Join Family</h1>

                   <?php

                   if(isset($_SESSION['userid']))
                   {  
                       if(isset($_POST['submit']))
                       {   
                        $usersearch=$_POST['usersearch'];
     
                        $query="SELECT * FROM familyinfo WHERE familyname='$usersearch'";
                        $data=mysqli_query($dbc,$query);
                       if(mysqli_num_rows($data)==1)
                       {  ?>
                          
                          <?php
       
                          echo'<p style="text-decoration:underline;">Search Results:</p>';
                          while($row=mysqli_fetch_array($data))
                          {
        
                            
                           echo '<span class="familyname">'.$row['familyname'].'</span><br><a style="text-decoration:none;color:#fff;" 
                            href="jointhis.php?familyname='.$row['familyname'].'&amp;familyid='.$row['familyid'].'"><br><br><span class="link1">Join</span></a>';
                          } 
                          ?>
                          <?php

                       }
                       else 
                       {
                         echo '<p>No such Family exist</p>';
                       }
    
    
                      }
                      else{?>
                       <p>Want to join a family?</p>
                       <form method="POST" action="<?php $_SERVER['PHP_SELF']?>">
                      <input placeholder="Enter Family Name" title="Enter Family Name" class="box" type="text" name="usersearch" required><br><br>
                       <input class="submitbutton" type="submit" name="submit" value="Submit">
                       </form>
                   <?php
                      }
                   }
                   else header('Location:loginb.php')
                   ?>
               
                  
                </div>
            </div>        
        </div>


    <?php?>





    <?php
    include_once("footer.php");
    ?>







    </div>
</body>
</html>