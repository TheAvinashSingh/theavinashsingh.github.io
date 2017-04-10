<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link href="css/logoutthis.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    

    <div class="container">
        <div class="container">
    <?php include_once('connection.php');
          session_start();
    ?>


    <?php     
    include_once("loginheader.php");
    ?>

    
    <?php?>
            <div class="content">
            
            <div class="uppertext">
            <div class="text1" style="margin-right:auto;margin-left:auto;">
                    <?php

                    if(isset($_SESSION['userid']))
                      {if(isset($_POST['submit']))
                            {
                            if($_POST['confirm']=='Yes')
                              {
           
                                $_SESSION[]=array();
                                    session_destroy();
                                    session_unset();

                                    echo'<p>You have logged out successfully</p>';
                                      $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/home.php';
                                      header('Location: ' . $home_url);
                
                                }else{echo 'redirecting to home page';
                                      $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/home.php';//use time delay
                                      header('Location: ' . $home_url);
                                     }
                          }   
    
                       }else{echo'<p class="txt1">You are not logged in..!!<p>';
                          echo '<a class="link1" href="loginb.php">Go to Login</a>';}



                      if(isset($_SESSION['userid'])&&isset($_SESSION['familyid']))
                        {
                        $userid=$_SESSION['userid'];
                        $familyid=$_SESSION['familyid'];
                        if (isset($_GET['firstname']) && isset($_GET['lastname'])) 
                        {
                          $firstname = $_GET['firstname'];
                          $lastname = $_GET['lastname'];
                        }
                    echo'<h2 style="font-family:verdana;font-size:2vw;"> Logout</h2>';
                    echo'<p>'.$firstname.' '.$lastname.'</p>';
                    
                    echo'<p> Do you want to logout??</p>';


                      }

                     else if(isset($_SESSION['userid'])&&!(isset($_SESSION['familyid'])))
                        {
                        $userid=$_SESSION['userid'];
                        //$familyid=$_SESSION['familyid'];
                        if (isset($_GET['firstname']) && isset($_GET['lastname'])) 
                        {
                          $firstname = $_GET['firstname'];
                          $lastname = $_GET['lastname'];
                        }
                       ?>
                    <div class="logoutheading">
                        <h1 style="font-family:verdana";>Logout</h1></div>
                        <?php
                    echo'<p> '.$firstname.' ' .$lastname.  '</p>';


                    echo'<p> Do you want to logout?</p>';
                    }
    
                    ?>
                    <?php if(!isset($_POST['submit'])&&isset($_SESSION['userid'])){?>
                    <div id="logoutform">

                    <form action="logoutthis.php" method="POST">   
                        Yes<input type="radio" name="confirm" value="Yes"><br><br>

                        No<input type="radio" name="confirm" value="No"><br><br>

                        <input class="logoutsubmit" type="submit" name="submit" id="submit" value="SUBMIT">
                    </form>
                    </div>
                    <?php
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
   
    
    </div>
   
</body>
</html>