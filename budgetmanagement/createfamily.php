<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Family</title>
    <link href="createfamilystyle.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <div class="container">
    <?php include_once('connection.php');
          session_start();
    ?>


    <?php     
    include_once("createfamilyheader.php");
    ?>

    
    <?php?>
          <div class="content">

            <div class="uppertext">
            <div class="img1">
               <img class="family" src="images/family.png"/>'
            </div>
            <div class="text1">
                <div class="txt1">
              <?php  if(isset($_SESSION['userid']))
                        { 

                          $qrry="SELECT userid,roleid FROM viewid WHERE userid='".$_SESSION['userid']."'";
                          $ress=mysqli_query($dbc,$qrry) or die("Problem in Login");
                          $row1=mysqli_fetch_array($ress);
                          if(mysqli_num_rows($ress))
          
                            { //echo '<p>You Already Belong to a family</p>';  
                              //header('location:createorjoinfamily.php');
                              header("location:alreadybelong.php");                          
                            }
                         else {  
  
                          if(isset($_POST['submit']))
                              {

                               $familyname=$_POST['familyname'];
                               $income=(int)$_POST['income'];
                               $rent=(int)$_POST['rent'];
                               $emi=(int)$_POST['emi'];
                               $insurance=(int)$_POST['insurance'];

                               if(!empty($familyname)&&!empty($income))
                                       { 
                                          $query="SELECT * FROM familyinfo WHERE familyname='$familyname'";
                                          $data=mysqli_query($dbc,$query) or die("Problem");

                                          if(mysqli_num_rows($data)==1)
                                             {
                                                "<p>the Familyname is already in use....choose a different one...!!</p>";
                                                

                                            }
                                             else
                                             {     if($income<$rent+$emi+$insurance)
                                                  {
                                                   echo "Your fixed expenditure exceeds your income";
                                                   echo "<br><a href='createfamily.php'>Go Back</a>";}
                                              else{
                                                   
                                                   $query2="INSERT INTO `familyinfo` (`familyid`, `familyname`, `income`, `emi`, `rent`, `insurance`) VALUES (NULL, '$familyname', '$income', '$rent', '$emi', '$insurance');";
                                                   $data2=mysqli_query($dbc,$query2)  or die("Problem");

                                                   $query3="SELECT * FROM `familyinfo` WHERE familyname='$familyname'";
                                                   $data3=mysqli_query($dbc,$query3);
                                                   
                                                   if(mysqli_num_rows($data3)==1)
                                                     {$row=mysqli_fetch_array($data3);

                                                      
                                                      $query5="SELECT * FROM `viewid` WHERE userid='".$_SESSION['userid']."'";
                                                      $data5=mysqli_query($dbc,$query5);
                                                      if(mysqli_num_rows($data5)==1)
                                                      {
                                                        echo '<p>You already belong to a Family.....You cannot create a family..!!</p>';
                                                        //echo'<p>Want to login as a different Person..??<a href="loginb.php">Click here</a></p>';
                                                      }
                                                      else
                                                      {
                                                      $_SESSION['familyid']=$row['familyid'];
                                                      $query4= "INSERT INTO `viewid` (`userid`, `familyid`, `roleid`) VALUES (".$_SESSION['userid'].",".$_SESSION['familyid']." , '1')";
                                                      $data4=mysqli_query($dbc,$query4);
                                                      for ($i=1; $i <=9; $i++) 
                                                        { 
                                                            $query5="INSERT INTO categorytoroles(familyid,roleid,categoryid) VALUES('".$_SESSION['familyid']."','1','".$i."')"; 
                                                            $data5=mysqli_query($dbc,$query5) or die("error".mysql_error());
                                                         }
                                             
                                                      mysqli_close($dbc);
                                                      echo'<p>You are Head of the family so your role is already alloted all the categories of expense..!!';
                                                      echo'<h2>Now Create Other Roles</h2>';
                                                      //echo'<a href="createroles.php">Step1: Create Roles</a>';
                                                      ?>
                                                       
                                                       
                                                                <div class="newleft">
                                                                <?php include_once('left.php');
                                                                ?>
                                                                </div>

                                                            
                    
                    
                                                       
                    
                    <?php
                                                    }
                                               }
                                             }

                                           }
                                    }
                                  else echo'You left fields empty';    
                                    }
                                    else{?>
     
      <body>
          <h1 class="mainheading">Create Family</h1>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <table>
        <tr>
            <td>Family Name:</td>
            <td>
                <input class="box" placeholder="Family Name" type="text" name="familyname" required>
            </td>
        </tr>
        <tr>
            <td>Family Income:</td>
            <td>
                <input class="box" placeholder="Family Income" type="number" name="income" min="0" required>
            </td>
        </tr>
        <tr>
            <td>Rent:</td>
            <td>
                <input class="box" placeholder="Rent" type="number" name="rent" min="0" >

            </td>
        </tr>
        <tr>
            <td>EMI:</td>
            <td>
                <input class="box" placeholder="EMI" type="number" name="emi" min="0">
            </td>
        </tr>
        <tr>
            <td>Insurance</td>
            <td>
                <input class="box" placeholder="Insurance" type="number" name="insurance" min="0">            
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input class="submitbutton" type="submit" name="submit">
            </td>
        </tr>   
    </table>
</form>
<div id="logout">
  

  <?php include_once('logout.php'); ?>



</div>
</body>
<?php
}
}}
else header('location:loginb.php');

   ?>               </div>
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