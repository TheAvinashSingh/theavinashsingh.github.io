<!DOCTYPE html>
<html>
<head>
	<title>View Expenditure</title>
</head>
<body>
<?php
if(isset($_SESSION['userid']))
{ 
	if(isset($_SESSION['familyid']))
	{
session_start();
 $dbc= mysqli_connect('localhost','root','','budget');
 $query="SELECT * FROM datetrack WHERE familyid='".$_SESSION['familyid']."'";
 $data=mysqli_query($dbc,$query);
 if(mysqli_num_rows($data))
 {  
 	echo'<table>';
    echo'<tr>';

      echo'<th>';
      echo'BUDGET SET date';
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
        $month=date("m",$time);
        $year=date("Y",$time);
        $dateid=$row['dateid'];
        
        echo'<tr>';
    	
        echo'<td>';
        echo $dateid;
        echo'</td>';  
        
        echo'<td>';
        echo $month-$year;
        echo'</td>';  
     
        
        echo'<td>';
        echo '<a href="viewthisbudget.php?dateidsent='.$dateid.'">See Budget</a>';
        echo'</td>';  

        echo'</tr>';

    }echo'</table>';
 }
 else {
 	  echo '<p>Sorry Your Budget is not Set..!!</p>';
      echo '<p><a href="setBudget.php">Click here</a> to set your Budget</p>';
      }
    }else header('location:createfamily.php');
}
else header('location:loginb.php')
?>



</body>
</html>