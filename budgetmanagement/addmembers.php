<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Members</title>
    <link href="css/addmemberstyle.css" rel="stylesheet" type="text/css"/>
    <script src="validate.js"></script>
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
                  <div class="img">
                   <img class="image" src="images/addmember.png"/>
                  </div>
                <div class="text1">

                  <?php       
                         $g=1;
                         $qry="SELECT userid,roleid FROM viewid WHERE userid='".$_SESSION['userid']."'";
                         $res=mysqli_query($dbc,$qry) or die("Problem in Login");
                         $row1=mysqli_fetch_array($res);
                         if(!mysqli_num_rows($res))
          
                            {   $g=0;
                                echo'<p>Sorry, You do not have a Family.<p>'; 
                                echo'<a href="createfamily.php">1.Create Family</a><br>';
                                echo'<a href="joinfamily.php">2.Join Family</a><br>';
                                echo'<div class="logininside">'; include_once('logout.php'); echo'</div>';                          
                            }
                         else {  include_once("left.php"); 
                               }                 
                              
                             
            
                   ?>

                
                               <div class="right">
                

                              
                              <?php

         
                               if(isset($_SESSION['userid']))
                               {

                                    $querycheck="SELECT * FROM viewid WHERE userid='".$_SESSION['userid']."'";
                                  $datacheck=mysqli_query($dbc,$querycheck);
                                  if(mysqli_num_rows($datacheck))
                                  {
                                    $rowcheck=mysqli_fetch_array($datacheck);
                                    if($rowcheck['roleid']!=1)
                                    {
                                       echo'<p>You cannot Add Members Because You Are Not Head Of The Family.</p>';
                                       header('refresh: 4; url=viewbudget.php');
                                    }
                                    else{
                         
                                if(isset($_POST['submit']))
                                {   
                                  $usersearch=$_POST['usersearch'];
                                  $roleid=$_POST['role'];
                                  $dbc= mysqli_connect('localhost','root','','budget');
                                  $query="SELECT * FROM usersignup WHERE username='$usersearch'";
                                  $data=mysqli_query($dbc,$query);
                                  if(mysqli_num_rows($data)==1)
                                {  ?>
                                   <table>
                                   <?php
       
                                   $path="images/";
                                   while($row=mysqli_fetch_array($data))
                                 {$query2="SELECT * FROM viewid,usersignup WHERE usersignup.username='$usersearch' AND usersignup.userid=viewid.userid";
                                 $data2= mysqli_query($dbc,$query2);
                                 if($row2=mysqli_num_rows($data2)==1)
                                 {
                                  echo'<tr>';
                                  echo'<td>';
                                  echo $row['username'];
                                  echo'</td>';
                                  echo'<td>';
                                  echo'<img src="'.$path.$row['userimage'].'" height="100" width="100">';
                                  echo'</td>';
                                  echo'<td>';
                                  echo'<p>This member already belongs to a family...He cannot be added....!!</p>';
                                 echo'</td>';
                                 echo'</tr>';
                                 echo'<p>Want to add other members??<a href="addmembers.php">Click here</a></p>'; 
        
                                }
                               else{
                                   $query3="SELECT * FROM viewid,usersignup WHERE usersignup.username='$usersearch' AND viewid.userid='".$_SESSION['userid']."'";     
                                   $res3=mysqli_query($dbc,$query3);
                                   if($row3=mysqli_fetch_array($res3))
                                  {
                                    $query5="INSERT INTO `viewid` (`userid`, `familyid`, `roleid`) VALUES ('".$row3['userid']."', '".$_SESSION['familyid']."', '$roleid')";
                                    $data5=mysqli_query($dbc,$query5);
                                    echo '<p>The User <strong>"'.$row3['username'].'"</strong> was successfully added to your family.';
                                    echo'<p><a href="addmembers.php">Add More Members</a></p>';
                                   
                                   } 


                                  } }
                                 ?>
                       </table>
                       <?php

                             }
                    else 
                    {
                      echo '<p>No such user exist</p>';
                    }
    
    
                   }
                   else{
                    if($g)
                    {?>
                    <h1>Add Members</h1>
                    <form method="POST" action="<?php $_SERVER['PHP_SELF']?>">
                    <input title="Enter Username" class="box" placeholder="Username" type="text" id="user" onblur="usern(this.id)" name="usersearch" required><br>
                    <span id="usererror"></span><input title="Enter First Name" class="box" id="name" onblur="text(this.id)" placeholder="First Name" type="text" name="firstname" required><br><span id="error"></span>
                    <p>Select Role</p>
                    <div class="selecttag"><select class="selectoption" name="role" required>
                    <option value='1' selected disabled>Select Role</option>
                    <option value='2'>Subhead1</option>
                    <option value='3'>Subhead2</option>
                    <option value='4'>Child</option>
                    </select></div><br>
                    <input class="submitbutton" type="submit" name="submit" value="Submit">
                    </form>
                <?php
                   }}
                }}}
                else header('location:loginb.php');
                ?>
             
                </div>
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