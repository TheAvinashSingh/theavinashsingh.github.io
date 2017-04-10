<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Budget</title>
    <link href="css/setbudgetstyle.css" rel="stylesheet" type="text/css"/>
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
            <div class="uppertext" style="min-height:20vw;">
            <div class="img1"></div>
            
               <div class="text1">
                
                  <?php       
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

                    
                         
<?php
//require_once("connection.php");

//session_start();
 $querycheck="SELECT * FROM viewid WHERE userid='".$_SESSION['userid']."'";
          $datacheck=mysqli_query($dbc,$querycheck);
          if(mysqli_num_rows($datacheck))
          {
            $rowcheck=mysqli_fetch_array($datacheck);
            if($rowcheck['roleid']!=1)
            {
               echo'<p>You cannot Set Budget Because You Are Not Head Of The Family.</p>';
               header('refresh: 4; url=viewbudget.php');
            }
            else{
          
if(isset($_SESSION['userid']))
{
    if(isset($_SESSION['familyid']))
    {
$g=1;
$saving=0;

$userid=$_SESSION['userid'];
$save;
$qry1="SELECT * FROM familyinfo,viewid  WHERE viewid.userid='$userid' AND viewid.familyid=familyinfo.familyid ";
$res1=mysqli_query($dbc,$qry1) or die ("Problem In Query");
if($row=mysqli_fetch_array($res1))
{   $save=$row['income']-($row['emi']+$row['rent']+$row['insurance']);
  ?>
    <div class="fixed">
        <h1 class="budgetheading">Budget For <?php echo $row['familyname']; ?></h1>
        <h2 style="color:dimgrey;font-size:2vw;">Fixed Expenditure:</h2>
    
      <span> Family's Income: </span><span><?php echo $row['income'].'.00'; ?></span><br>
      <span> Family's Monthly EMI: </span><span><?php echo $row['emi'].'.00'; ?></span><br>
      <span> Monthly Rent: </span><span><?php echo $row['rent'].'.00'; ?></span><br>
      <span> Monthly Insurance: </span><span><?php echo $row['insurance'].'.00'; ?></span><br>
      <span> Money Left: </span><span><?php echo $save.'.00'; ?></span>
  </div>
  <?php 
}

$error=$montherr=$yearerr="";
if(isset($_SESSION['userid'])){
if(isset($_POST['submit']))
  {    $error="";
       $month=$_POST['month'];
       $year=$_POST['year'];
  if(!empty($month)&&!empty($year)){
    $date="$year"."-"."$month"."-1";

        $qry2="SELECT dateid FROM datetrack WHERE familyid=".$_SESSION['familyid']." AND day='$date'";
        $res2=mysqli_query($dbc,$qry2) or die("Problem");
        if(mysqli_num_rows($res2))
        echo'<p style="color:red;font-size:1.5vw;">Budget for the specified month already exists.</p>';
        else{
        $qry3="INSERT INTO datetrack VALUES(NULL ,'".$_SESSION['familyid']."','$date') ";//changes made here
        mysqli_query($dbc,$qry3) or die("Problem in Query");
        $qry4="SELECT dateid FROM datetrack WHERE day='$date' AND familyid='".$_SESSION['familyid']."'" ;
        $res4=mysqli_query($dbc,$qry4)or die("Problem in Selection of Month");
        if($row1=mysqli_fetch_array($res4))
        {
    $trans=(int)$_POST["trans"];
        $grocery=(int)$_POST["grocery"];
        $utility=(int)$_POST["utility"];
        $bill=(int)$_POST["bill"];
        $cloth=(int)$_POST["cloth"];
        $edu=(int)$_POST["edu"];
        $med=(int)$_POST["med"];
        $fun=(int)$_POST["fun"];
        $other=(int)$_POST["other"];
        $val=$trans+$grocery+$utility+$bill+$edu+$fun+$other+$cloth+$med;
        if($save < $val)
          {   
              
            $error="Your Budget Exceeds Your Income";
                echo $val;

          }
          else{
              $saving=$save-$val;//savings added
            $category=array($trans,$grocery,$utility,$bill,$cloth,$edu,$med,$fun,$other,$saving);
               $i=1;$g=0;
               foreach($category as $value)
              {  
            $qry="INSERT INTO familybudget VALUES('".$_SESSION['familyid']."','$i','$value','".$row1['dateid']."','0')";
            mysqli_query($dbc,$qry) or die("Problem In Budget Query");
            $i++;
              }echo'Budget Has Been Set For The Month You Mentioned ';
          }
      }
  }
}
   else{
       if(empty($month))
           $montherr="Please Select The Month";
       if(empty($year))
           $yearerr="Pleaes Select Your Year";
   }
   
   
}
}}else header('location:tempfamily.php');
} else
{
   header("location:loginb.php");
}
                             if($g){?>
<form action="<?php echo $_SERVER['PHP_SELF'] ;?>" method="post">
  <div class="main">
  <br>
     <select name='month' required>
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
    <select name='year' required>
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
    <br>
    <input class="box" placeholder="Transport" type="number"  name="trans" min="0"required>
    <input class="box" placeholder="Groceries" type="number"  name="grocery" min="0" required><br>
    <input class="box" placeholder="Basic Utilities" type="number" name="utility" min="0" required>
    <input class="box" placeholder="House Bills" type="number"  name="bill" min="0" required><br>
    <input class="box" placeholder="Clothing" type="number" name="cloth" min="0" required>
    <input class="box" placeholder="Education" type="number" name="edu" min="0" required><br>
    <input class="box" placeholder="Medication" type="number" name="med" min="0"required>
    <input class="box" placeholder="Leisure" type="number"  name="fun" min="0"required><br>
    <input class="box" placeholder="Others" type="number" name="other" min="0"required><span class="error"><br><?php echo $error;?></span>
    <input class="submitbutton" type="submit" value="Set Budget" name="submit">
    </div>
</form>
<?php } else{
                                 echo'<br>You Are Saving Rs.'.$saving.'.00 <br>';
                                 echo'Your Budget Is Set<br>';
                                 echo'Click Here To See The Budget<br><br>';
                                 echo'<a style="text-decoration:none;" class="submitbutton" href="viewbudget.php">View Budget</a><br>';
                             }
     
     }
  }                       
?>

            
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