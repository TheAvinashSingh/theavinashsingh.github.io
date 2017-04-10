<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Expenditure</title>
    <link href="css/expenditurestyle.css" rel="stylesheet" type="text/css"/>
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
                
            </div>
            
               <div class="text1">
                
                  <?php  
                  $g=1;
                         if(isset($_SESSION['userid'])){  
                          if(isset($_SESSION['familyid']))
                          {
                         $qry="SELECT userid,roleid FROM viewid WHERE userid='".$_SESSION['userid']."'";
                         $res=mysqli_query($dbc,$qry) or die("Problem in Login");
                         $row1=mysqli_fetch_array($res);
                         if(!mysqli_num_rows($res))
          
                            {   $g=0;
                               
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
                         
                         




                         

<?php
//session_start();
if(isset($_SESSION['userid']))
{
   if(isset($_SESSION['familyid']))
   {
      $userid=$_SESSION['userid'];
      $qry="SELECT categorytoroles.categoryid,category.category FROM categorytoroles,category,viewid WHERE categorytoroles.familyid=viewid.familyid 
      AND categorytoroles.categoryid=category.categoryid AND categorytoroles.roleid=viewid.roleid AND viewid.userid='$userid'";
      $res=mysqli_query($dbc,$qry) or die("Problem in Selecting");
      if(isset($_POST['Spent']))
      {  
       $id=$_POST['list'];
       $date=$_POST['date'];
       $time=strtotime($date);
       $month=date("m",$time);
       $year=date("Y",$time);
       $spent=(int)$_POST['spent'];
       if(!empty($id)&&!empty($date)&&!empty($spent))
       {
        $qry1="SELECT * FROM dailyexpenditure WHERE userid='$userid' AND categoryid='$id' AND day='$date'";
        $res1=mysqli_query($dbc,$qry1) or die("Problem in Selecting");//Query to Know if The transaction On this day Exist
        if(mysqli_num_rows($res1))
        {
          $qry2="UPDATE dailyexpenditure SET moneyspent=moneyspent+$spent WHERE userid='$userid' AND categoryid='$id' AND day='$date' ";
          mysqli_query($dbc,$qry2) or die("Problem in Update");//Updating transacion if Exist
        }
        else
        {
          $qry2="INSERT INTO dailyexpenditure VALUES('$userid','$id','$spent','$date')";
          mysqli_query($dbc,$qry2) or die("Problem in Inserting");
        }
        $qry3="SELECT * FROM familybudget,viewid,datetrack WHERE familybudget.familyid=viewid.familyid AND viewid.userid='$userid' 
        AND familybudget.categoryid='$id' AND familybudget.dateid=datetrack.dateid AND MONTH(datetrack.day)='$month' AND YEAR(datetrack.day)='$year'";
        $res3=mysqli_query($dbc,$qry3) or die("Problem In Monthly Entry".mysqli_error($dbc));//Making Entry For Monthly Transaction
        $row1=mysqli_fetch_array($res3);
        if($row1)
        {
          $qry4="UPDATE familybudget,viewid,datetrack SET familybudget.moneyspent=familybudget.moneyspent+$spent WHERE familybudget.familyid=viewid.familyid AND 
          viewid.userid='$userid' AND familybudget.categoryid='$id' AND familybudget.dateid=datetrack.dateid AND MONTH(datetrack.day)='$month'
          AND YEAR(datetrack.day)='$year'";
          mysqli_query($dbc,$qry4) or die ("Problem");
          $g=0;       
          $qry5="SELECT category FROM category WHERE categoryid='$id'";
          $res5=mysqli_query($dbc,$qry5);          
          $row2=mysqli_fetch_array($res5);
          $qry7="SELECT * FROM familybudget,viewid,datetrack WHERE familybudget.familyid=viewid.familyid AND viewid.userid='$userid'
           AND familybudget.categoryid='$id' AND familybudget.dateid=datetrack.dateid AND MONTH(datetrack.day)='$month' AND YEAR(datetrack.day)='$year'";
           $res7=mysqli_query($dbc,$qry7) or die("Problem In Monthly Entry".mysql_error());//Making Entry For Monthly Transaction
          $row7=mysqli_fetch_array($res7);
          if($row2)
          {
            echo "".$row2['category'].": Money Budgeted For The Month : Rs.".$row7['moneybudget']."<br>          Money Spent Uptil Now : Rs.".$row7['moneyspent'];
          }
          if($row7['moneyspent']>$row7['moneybudget'])
          {
            $extra=$row7['moneyspent']-$row7['moneybudget'];
            echo "Your Expenditure in ".$row2['category']." Category Has Exceeded The Set Budget By Rs.".$extra ."" ;
            echo "<br> Your Current Saving Is Reduced By Rs.".$extra."";
            $qry6="UPDATE familybudget,viewid,datetrack SET familybudget.moneyspent=familybudget.moneyspent+$spent WHERE familybudget.familyid=viewid.familyid AND
            viewid.userid='$userid' AND familybudget.categoryid=10 AND familybudget.dateid=datetrack.dateid AND MONTH(datetrack.day)='$month' 
            AND YEAR(datetrack.day)='$year'";
            $res6=mysqli_query($dbc,$qry6);
          }
        }
        else
        {
          $qry4="DELETE FROM dailyexpenditure WHERE day ='$date'AND userid='$userid' AND categoryid='$id'";
          mysqli_query($dbc,$qry4);
          echo "Transcation Unsuccessfull Because Budget is Not Set For The Month";
        } 
    
       } 
       else
        {
          if(empty($id))
          $idrror="Please Select A Category";
          if(empty($date))
          $dateerror="Please Select A Date";
          if(empty($spent))
          $spenterror="select Your Expenditure";
    
        }
      }


    if($g)
    {
    
      
      
    


?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <input class="box" type="date" id="date" name="date" required>
<select name="list" required>
<option value="" disabled selected> Select </option>
<?php 
    while($row=mysqli_fetch_array($res)){
  echo "<option value='".$row['categoryid']."'> ".$row['category']." </option>";
}
?>
</select>
  <input class="box" placeholder="Enter Amount" type="number" value="" name="spent" min="0" required><span id="moneyerror"></span><br>
  <input class="submitbutton" type="submit" name="Spent" value="Spent">
  </form>
  <?php
     }
     else
{
  echo "<br><br><br><a style='text-decoration:none;' class='submitbutton' href='setExpenditure.php'>Click Here To Add More Transaction</a>  ";
}

   }
   else header("location:tempfamily.php");


}
else header("loginb.php");
?>
  


                         </div>
            </div>
          </div>      
       </div>             
        


</div>



    <?php
    include_once("footer.php");
    ?>






       
    </div>
</body>
</html>