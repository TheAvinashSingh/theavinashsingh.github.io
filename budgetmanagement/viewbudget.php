<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Budget</title>
    <link href="css/viewbudgetstyle.css" rel="stylesheet" type="text/css"/>
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
            
               <div class="text1">
                
                        <div class="right">
                         
                         <?php
                             if(isset($_SESSION['userid']))
                               {
                               if(isset($_SESSION['familyid']))
                     {
                      $familyidxx=$_SESSION['familyid'];
 
                      $query="SELECT * FROM datetrack WHERE familyid='$familyidxx'";
                      $data=mysqli_query($dbc,$query) or die("error");

 
                       ?>

                     <?php
                     $query2="SELECT * FROM familyinfo WHERE familyid='".$_SESSION['familyid']."'";
                     $data2=mysqli_query($dbc,$query2);
                     $row2=mysqli_fetch_array($data2);
                     $familyname=$row2['familyname'];
                       ?>


                    <div class="userinfo">
                    <?php
                    $path="images/";
                    $query3="SELECT * FROM usersignup WHERE userid='".$_SESSION['userid']."'";
                    $data3=mysqli_query($dbc,$query3);
                    $row3=mysqli_fetch_array($data3);

                   echo'<p><span class="loggedin">You are logged in as '.$row3['firstname'].' '.$row3['lastname'].'</span></p>';
                   echo'<img src="'.$path.$row3['userimage'].'" height="100" width="100">';

                 ?>  

                    </div>

      

                 <div class="familydetails">
                 <h2 class="familydetailhead">Family Details</h2>
                <?php
                   echo'<p>Family Name: '.$row2['familyname'].' </p>';
                   echo'<p>Family Income: '.$row2['income'].' </p>';
                   echo'<p>Family EMI: '.$row2['emi'].' </p>';
                   echo'<p>Family INSURANCE: '.$row2['insurance'].' </p>';
                   echo'<p>Family Rent: '.$row2['rent'].'</p>';
                  ?>
                  </div>

                <div class="table">
                <?php 
                if(mysqli_num_rows($data))
                {  
                    echo'<table>';
                    echo'<tr>';

                    echo'<th>';
                    echo'Date Of budgetset';
                    echo'</th>';    
      
                     echo'<th>';
                     echo'Month/Year';
                     echo'</th>';    
    
                     echo'<th>';
                     echo'See Budget';
                     echo'</th>';   

                     
                     echo'</tr>';    
                    while($row=mysqli_fetch_array($data))
                     {   
                       $date=$row['day'];
                       $time=strtotime($date);
                       $month=date("M",$time);
                       $year=date("Y",$time);
                       $dateid=$row['dateid'];
        
                      echo'<tr>';
        
                      echo'<td>';
                      echo $date;
                      echo'</td>';  
        
                      echo'<td>';
                      echo "$month"."-"."$year";
                      echo'</td>';  
     
        
                      echo'<td>';
                      echo '<a href="viewthisbudget.php?dateidsent='.$dateid.'">See Budget</a>';
                      echo'</td>';

                      echo'</tr>';
           
                      }echo'</table>';
                    }  
 else {
      echo '<p>Sorry Your Budget is not Set..!!</p>';
      echo '<p><a class="submitbutton" href="setBudget.php">Click Here</a> to set your Budget</p>';
      }

      ?></div>

      <?php
    }//else header('location:createfamily.php');
}
else header('location:loginb.php')
?>

                 
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