<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Family Info</title>
    <link href="css/updatefamilystyle.css" rel="stylesheet" type="text/css"/>
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
            <div class="uppertext" style="min-height:25vw;">
             <div class="img1" style="margin-left:30vw;width:10vw;margin-right:10vw;">
               <img class="family" src="images/family.png"/>'
            </div>
            <div class="text1">
                <div class="txt1">

              


               <?php       
                         if(isset($_SESSION['userid'])){  
                          if(isset($_SESSION['familyid'])){
                         $qry="SELECT userid,roleid FROM viewid WHERE userid='".$_SESSION['userid']."'";
                         $res=mysqli_query($dbc,$qry) or die("Problem in Login");
                         $row1=mysqli_fetch_array($res);
                         if(!mysqli_num_rows($res))
          
                            {   
                               
                                //echo'<a href="createfamily.php">1.Create Family</a><br>';
                               // echo'<a href="joinfamily.php">2.Join Family</a><br>';
                                //echo'<div class="logininside">'; include_once('logout.php'); echo'</div>';  
                                 header('location:createorjoinfamily.php');                        
                            }
                         else {  include_once("left.php"); 
                               }      
                               }else header('location:createorjoinfamily.php');           
                               }else header('location:loginb.php');
                        ?>
                <div class="right">
              <?php  if(isset($_SESSION['userid']))
                         { 
                           if(isset($_SESSION['familyid']))
                             {
                                      $querycheck="SELECT * FROM viewid WHERE userid='".$_SESSION['userid']."'";
                                  $datacheck=mysqli_query($dbc,$querycheck);
                                  if(mysqli_num_rows($datacheck))
                                  {
                                    $rowcheck=mysqli_fetch_array($datacheck);
                                    if($rowcheck['roleid']!=1)
                                    {
                                       echo'<p>You cannot Update Family Because You Are Not Head Of The Family.</p>';
                                       header('refresh: 4; url=viewbudget.php');
                                    }
                                    else{
                                    if(isset($_POST['submit']))
                                        {        if(isset($_POST['monthofsub'])&&isset($_POST['yearofsub']))
                                                          {

                                                             $familyname=$_POST['familyname'];
                                                             $income=$_POST['income'];
                                                             $rent=$_POST['rent'];
                                                             $emi=$_POST['emi'];
                                                             $insurance=$_POST['insurance'];
                                                             $month=$_POST['monthofsub'];
                                                             $year=$_POST['yearofsub'];
                                                             $savenew=$income-($rent+$emi+$insurance);

                                                               if($income<$rent+$emi+$insurance)
                                                                 {
                                                                   echo "Your fixed expenditure exceeds your income";
                                                                  header('refresh: 3; url=updatefamilyinfo.php');
                                                                   }
                                                                     
                                                            else {     $query7="SELECT * FROM familyinfo WHERE familyid='".$_SESSION['familyid']."'";
                                                                       $data7=mysqli_query($dbc,$query7);
                                                                       while($row7=mysqli_fetch_array($data7))
                                                                       {
                                                                        $saveold=$row7['income']-($row7['rent']+$row7['emi']+$row7['insurance']);
                                                                       }

                                                                       //row['Saving']=row['Saving']-$saveold+ $savenew;
                                                                       $query8="SELECT * FROM  familybudget,datetrack WHERE  familybudget.dateid=datetrack.dateid AND MONTH(datetrack.day)='$month' AND YEAR(datetrack.day)='$year' AND familybudget.familyid='".$_SESSION['familyid']."'";
                                                                       $data8=mysqli_query($dbc,$query8);
                                                                       $sum=0;
                                                                       while($row8=mysqli_fetch_array($data8))
                                                                       {
                                                                        if($row8['categoryid']!=10)
                                                                        $sum=$sum+$row8['moneybudget'];
                                                                       }
                                                                       //echo $sum;
                                                                       //echo $savenew;
                                                                       $gross=$savenew-$sum;


                                                                       if($sum<$savenew)
                                                                       {   
                                                                           $query10="SELECT * FROM  familybudget,datetrack WHERE  familybudget.dateid=datetrack.dateid AND MONTH(datetrack.day)='$month' AND YEAR(datetrack.day)='$year' AND familybudget.familyid='".$_SESSION['familyid']."'";
                                                                          $data10=mysqli_query($dbc,$query10);
                                                                          if(mysqli_num_rows($data10))
                                                                          {$row10=mysqli_fetch_array($data10); 
                                                                          $query9="UPDATE familybudget SET moneybudget ='$gross' WHERE categoryid='10' AND  dateid='".$row10['dateid']."' AND familyid='".$_SESSION['familyid']."'";
                                                                           $data9=mysqli_query($dbc,$query9);
                                                                           }
                                                                          

                                                                    
                                                                           $query2="UPDATE `familyinfo` SET `familyname` = '$familyname' WHERE `familyinfo`.`familyid` = '".$_SESSION['familyid']."'";
                                                                           $data2=mysqli_query($dbc,$query2);
                                                                           $query3="UPDATE `familyinfo` SET `emi` = '$emi' WHERE `familyinfo`.`familyid` = '".$_SESSION['familyid']."'";
                                                                           $data3=mysqli_query($dbc,$query3);
                                                                           $query4="UPDATE `familyinfo` SET `rent` = '$rent' WHERE `familyinfo`.`familyid` = '".$_SESSION['familyid']."'";
                                                                           $data4=mysqli_query($dbc,$query4);
                                                                           $query5="UPDATE `familyinfo` SET `income` = '$income' WHERE `familyinfo`.`familyid` = '".$_SESSION['familyid']."'";
                                                                           $data5=mysqli_query($dbc,$query5);
                                                                           $query6="UPDATE `familyinfo` SET `insurance` = '$insurance' WHERE `familyinfo`.`familyid` = '".$_SESSION['familyid']."'";
                                                                           $data6=mysqli_query($dbc,$query6);
                                                                           echo'<p>Info is Set</p>';
                                                                           echo'<p>Your Saving of This month till now have changed.</p>';
                                                                          header('refresh: 3; url=viewbudget.php');
                                                                       }
                                                                       else {
                                                                         echo'<p>Your Expenditure is more than Income....Reset Your Income And Fixed Expenditures.</p>';
                                                                         header('refresh: 3; url=updatefamilyinfo.php');
                                                                         }
                                                                }
                                                         } else { if(isset($_POST['monthofsub'])&&!isset($_POST['yearofsub'])) echo'<p>You did not enter the Year</p>';
                                                                 else if(!isset($_POST['monthofsub'])&&isset($_POST['yearofsub'])) echo'You did not enter the Month</p>';
                                                                  else if(!isset($_POST['monthofsub'])&&!isset($_POST['yearofsub'])) echo'You did not enter the Month and Year</p>';
                                                                    header('refresh: 3; url=updatefamilyinfo.php');

                                                                 }   
                                      }
                                 else{?>
      
                                     <h1 class="headingupdate">Update Family</h1>
                                      <div class="">      
                                      <?php $query="SELECT * FROM familyinfo WHERE familyid='".$_SESSION['familyid']."'";
                                            $data=mysqli_query($dbc,$query);
                                            $row=mysqli_fetch_array($data);
                                      ?>
                                      <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                         <table>
                                             <tr>
                                                  <td>
                                                    Select Month and year
                                                  </td>
                                                  <td>
                                                    <select name='monthofsub' required>
                                          <option value='' disabled selected>Select Month</option>
                                          <option value='01'>Janaury</option>
                                          <option value='02'>February</option>
                                          <option value='03'>March</option>
                                          <option value='04'>April</option>
                                          <option value='05'>May</option>
                                          <option value='06'>June</option>
                                          <option value='07'>July</option>
                                          <option value='08'>August</option>
                                          <option value='09'>September</option>
                                          <option value='10'>October</option>
                                          <option value='11'>November</option>
                                          <option value='12'>December</option>
                                          </select>
                                          <select name='yearofsub' required>
                                          <option value='' selected disabled>Select Year</option>
                                          <option value='2016'>2016</option>
                                          <option value='2017'>2017</option>
                                          <option value='2018'>2018</option>
                                          <option value='2019'>2019</option>
                                          <option value='2020'>2020</option>
                                          <option value='2021'>2021</option>
                                             <option value='2022'>2022</option>
                                          <option value='2023'>2023</option>
                                          <option value='2024'>2024</option>
                                          <option value='2025'>2025</option>
                                          <option value='2026'>2026</option>
                                          <option value='2027'>2027</option>
                                          </select>
                                                  </td>
                                             </tr>
                                              <tr>
                                                  <td>Family Name:</td>
                                                  <td>
                                                      <input required class="box"  placeholder="Family Name" type="text" name="familyname" value="<?php echo $row['familyname'];?>" >
                                                  </td>
                                              </tr>
                                              <tr>
                                                  <td>Family Income:</td>
                                                  <td>
                                                      <input required class="box" placeholder="Family Income" type="number" name="income" value="<?php echo $row['income'];?>">
                                                  </td>
                                              </tr>
                                              <tr>
                                                  <td>Rent</td>
                                                  <td>
                                                      <input class="box" placeholder="Rent" type="number" name="rent" value="<?php echo $row['rent'];?>">
                                                  </td>
                                              </tr>
                                              <tr>
                                                  <td>EMI</td>
                                                  <td>
                                                      <input class="box" placeholder="EMI" type="number" name="emi" value="<?php echo $row['emi'];?>">
                                                  </td>
                                              </tr>
                                              <tr>
                                                  <td>Insurance</td>
                                                  <td>
                                                      <input class="box" placeholder="Insurance" type="number" name="insurance" value="<?php echo $row['insurance'];?>">
                                                  </td>
                                              </tr>
                                              <tr>
                                                  <td colspan="2">
                                                      <input class="submitbutton" type="submit" value="Update" name="submit">
                                                  </td>
                                              </tr>
                                          </table>
                                      </form>
                                      <div>
                                      <div id="logout">
                                        

                                        <?php include_once('logout.php'); ?>

                                      </div>
                                      </body>
                                      <?php
                                      }}}
                              }//else header('location:createfamily.php');
                          }
                          else header('location:loginb.php');
                                  ?></div>

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