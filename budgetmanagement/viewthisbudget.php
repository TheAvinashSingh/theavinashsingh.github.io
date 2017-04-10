<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Budget</title>
    <link href="css/viewthisbudgetstyle.css" rel="stylesheet" type="text/css"/>
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
            
               <div class="text1">
                
                  <?php       
                         if(isset($_SESSION['userid'])){  
                          if(isset($_SESSION['familyid'])){
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
                     
                <div class="familydetails">
                <?php
                        $query2="SELECT * FROM familyinfo WHERE familyid='".$_SESSION['familyid']."'";
                     $data2=mysqli_query($dbc,$query2);
                     $row2=mysqli_fetch_array($data2);
                     ?>
                 <h2 class="familydetailhead">Fixed Expenditures</h2>
                <?php
                    echo'<p style="text-decoration:underline;">Family Income: '.$row2['income'].' </p>';
                   echo'<p>Family EMI: '.$row2['emi'].' </p>';
                   echo'<p>Family INSURANCE: '.$row2['insurance'].' </p>';
                   echo'<p>Family Rent: '.$row2['rent'].'</p>';
                  ?>
                  </div>

                         
                        <?php
//session_start();
$dbc=mysqli_connect('localhost','root','','budget');
if(isset($_GET['dateidsent']))
{
    $dateid=$_GET['dateidsent'];
    $_SESSION['dateid']=$dateid;

    $query="SELECT * FROM category,familybudget WHERE category.categoryid=familybudget.categoryid AND familybudget.dateid='$dateid' AND familybudget.familyid=".$_SESSION['familyid']."";
    $data=mysqli_query($dbc,$query);

    
    echo'<table>';
    echo'<caption >Other Expenditures</caption>';
    echo'<tr>';
/*
      echo'<th>';
      echo'Category Id';
      echo'</th>';    
  */    
      
      echo'<th>';
      echo'Name';
      echo'</th>';    
    
      echo'<th>';
      echo'Money Budgeted';
      echo'</th>';    
    
      echo'<th>';
      echo'Money Spent';
      echo'</th>';    
    

    echo'</tr>';    
    while($row=mysqli_fetch_array($data))
    {  if($row['categoryid']!=10)
        { 
        
        echo'<tr>';
        
        echo'<td>';
        echo $row['category'];
        echo'</td>';  
     
        
        echo'<td>';
        echo $row['moneybudget'];
        echo'</td>';  
        

        echo'<td>';
        echo $row['moneyspent'];
        echo'</td>';  

        echo'</tr>';

    }else if($row['categoryid']==10)
             {
              $expsave=$row['moneybudget'];
              $actsave=$row['moneybudget']-$row['moneyspent'];
             }
     }echo'</table>';
    echo "<br><p id='para1'> Expected Savings :  ".$expsave." </p>";//////total doubt
    echo  "<p id='para1'>Current Savings : ".$actsave."</p>";
     echo '<br><br><a style="text-decoration:none;" class="graphbutton" href="minis.php">View Graphically</a>';  //instead of this here i want next line to come...
     //echo '<a href="minis.php?dateidsent='.$dateid.'">View Graphically</a>';
}
include_once('logout.php');


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