<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Family</title>
    <link href="css/jointhisstyle.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <div class="container">
    <?php include_once('connection.php');
          session_start();
    ?>


    <?php     
    include_once("header.php");
    ?>

    
    <?php?>
            <div class="content">
            
              <div class="uppertext">
               <div class="img1">
                <img class="familypic" src="images/family.png"/>'
               </div>
                  <div class="text1">
                  <h1 class="familyheading">Join Family</h1>
                  
                  <?php
                    
                    $dbc=mysqli_connect('localhost','root','','budget');
                    if (isset($_GET['familyname']) && isset($_GET['familyid'])) 
                    {
    
  
                      $familyid = $_GET['familyid'];
                      $familyname = $_GET['familyname'];
    
    
                    }
                    else if (isset($_POST['familyid'])) 
                    {
        
                      $familyid = $_POST['familyid'];
                      $familyname=$_POST['familyname'];
   
   
                    }
  






                    if (isset($_POST['submit'])) 
                    {
                      if ($_POST['confirm'] == 'Yes') 
                        {if($_POST['selectrole']=="male")
                           {$userchoice=2;}
                         else if($_POST['selectrole']=="female")
                           {$userchoice=3;}
                         else if($_POST['selectrole']=="child")
                           {$userchoice=4;}
                          $_SESSION['familyid']=$familyid;
                          $query="INSERT INTO `viewid` (`userid`, `familyid`, `roleid`) VALUES ('".$_SESSION['userid']."', '".$_SESSION['familyid']."', '$userchoice')";
                          $data=mysqli_query($dbc,$query);
                          mysqli_close($dbc); 

                          echo '<p>You were successfully added to Family<br><br><span style="font-size:2vw;">'.$familyname.'</span><br><br>';
                          //echo'<a class="link1" href="home.php">Go Back</a>';
                          header('refresh: 4; url=viewbudget.php');
                      }
                      else 
                      {
                        echo '<p class="error">You were not added.</p>';
                        echo'<p>Want to go back <br><br><a class="link1" href="home.php">Click Here</a></p>';
                      }

                    }
                  else
                      { 
    
                      
                      echo '<p class="familyname">Family Name: ' . $familyname . '<br />';
                      echo '<p>Are you sure you want to join this family?</p>';
    
                      echo '<form method="POST" action="jointhis.php">';
                      echo '<input type="radio" name="confirm" value="Yes"/> Yes<br> ';
                      echo '<input type="radio" name="confirm" value="No" checked="checked" /> No <br><br>';
    
    
                      echo '<label>Select Role:</label>';
                      echo '<br><input type="radio" name="selectrole" value="male"> Subhead 1<br>';
                      echo '<input type="radio" name="selectrole" value="female" checked="checked" /> Subhead 2 <br />';
                      echo '<input type="radio" name="selectrole" value="child" /> Child <br><br>';
    
                      echo '<input class="submitbutton" type="submit" value="Submit" name="submit" />';
    
                      echo '<input type="hidden" name="familyid" value="'.$familyid. '" />';
                      echo '<input type="hidden" name="familyname" value="'.$familyname. '" />';
    
                      echo '</form>';
  
                      }
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