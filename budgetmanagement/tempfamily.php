<?php
                        include_once('connection.php');

                         session_start();
                         if(isset($_SESSION['userid']))
                         {
                         $qrry="SELECT userid,roleid FROM viewid WHERE userid='".$_SESSION['userid']."'";
                         $ress=mysqli_query($dbc,$qrry) or die("Problem in Login");
                         $row1=mysqli_fetch_array($ress);
                         if(!mysqli_num_rows($ress))
          
                            {   header('location:createorjoinfamily.php');                          
                            }
                         else {  header("location:alreadybelong.php"); 
                               }                 
                              
                          }
                          else header('location:loginb.php');   
            
                   

?>