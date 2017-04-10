<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Roles</title>
    <link href="css/createrolesstyle.css" rel="stylesheet" type="text/css"/>
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

        <div class="content">


       

            
            <div class="uppertext">
            
            
               <div class="text1" style="margin-left:auto;margin-right:auto;">
                
                 <?php

   $userid=$_SESSION['userid'];

if(isset($_SESSION['userid']))
{ 

      $querycheck="SELECT * FROM viewid WHERE userid='".$_SESSION['userid']."'";
      $datacheck=mysqli_query($dbc,$querycheck);
      if(mysqli_num_rows($datacheck))
      {
        $rowcheck=mysqli_fetch_array($datacheck);
        if($rowcheck['roleid']!=1)
        {
           echo'<p>You cannot CREATE ROLES Because You Are Not Head Of The Family.</p>';
           header('refresh: 4; url=viewbudget.php');
        }
        else{
                        
  $query1="SELECT * FROM category";
  $res1=mysqli_query($dbc,$query1) or die("Problem");
  if(isset($_POST['submit']))
  {    if(isset($_POST['check'])&&isset($_POST['role']))//changes   
          { 
           $roleid=$_POST['role'];  
          
           $checkbox=$_POST['check'];
           $query3="SELECT categorytoroles.roleid FROM viewid,categorytoroles WHERE categorytoroles.familyid=viewid.familyid AND viewid.userid='$userid' AND categorytoroles.roleid='$roleid'";
           $res3=mysqli_query($dbc,$query3) or die(mysqli_error());
           if($row3=mysqli_fetch_array($res3))
        {   echo "Category is already alloted to this role.";
          echo 'Want to create other Roles ?<br><br><br><a style="text-decoration:none;" class="submitbutton" href="createroles.php">Click Here</a>';
        }
           else
           {$qry="SELECT familyid FROM viewid WHERE viewid.userid='$userid'";
             $result=mysqli_query($dbc,$qry) or die("Problem");
             $rowre=mysqli_fetch_array($result);

            foreach ($checkbox as $value) 
            {  
                $query4="INSERT INTO categorytoroles VALUES('$rowre[familyid]','$roleid','$value')"; 
                $data4=mysqli_query($dbc,$query4) or die(mysqli_error($dbc));
              
            }  echo 'Want to create other Roles ?<br><br><br><a style="text-decoration:none;" class="submitbutton" href="createroles.php">Click Here</a>';
              
           }   
            }else {if(empty($_POST['check'])) {echo'<p>Please Select Atleast One Category for the role.</p>';/////changes
                                           
                                            header('refresh: 2; url=createroles.php');
                                            
                                            }
                  else if(empty($_POST['role'])) {echo'<p>Please Select Atleast One Role.</p>';/////changes
                                       
                                            header('refresh: 2; url=createroles.php');
                                            }
                  else if(empty($_POST['role'])&&empty($_POST['role'])) {echo'<p>Please Select Atleast One Role And Atleat one Category.</p>';/////changes
                                       
                                            header('refresh: 2; url=createroles.php');
                                             
                                             }
    
                }       
                 
          
     }
  

else if($g){
  ?>
     <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
       <select name ="role" required>
        <option value="1" disabled selected> Select </option>
        <option value="2">Sub Head1</option>
        <option value="3">Sub Head2</option>
        <option value="4">Child</option>
          </select><br>
       <?php 
       while(($row1=mysqli_fetch_array($res1)))
       { if($row1['categoryid']!=10)
       {
        echo'<br><input class="checkbox" type="checkbox" name="check[]" value="'.$row1['categoryid'].'"> '.$row1['category'].' ';
       }
         }
?>
     <br><input class="submitbutton" type="submit" value="Save" name="submit">
     </form>
<?php
}
}}}
else
header("location:login.php");
?>
                 
               </div>
            </div>
          </div>      
       </div>             
        
    <?php?>

</div>



    <?php
    include_once("footer.php");
    ?>






       
    </div>
</body>
</html>