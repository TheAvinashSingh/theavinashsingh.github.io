<link href="css/mystyle.css" rel="stylesheet" type="text/css"/>
<?php
 
if(isset($_SESSION['userid'])||isset($_SESSION['familyid']))
{ $useridd=$_SESSION['userid'];
  
  $query="SELECT * FROM `usersignup` WHERE userid= '$useridd'";

  $data= mysqli_query($dbc,$query);
  if(mysqli_num_rows($data)==1)
  { $row= mysqli_fetch_array($data);
    
        echo'<a class= "logindiv" href="logoutthis.php?firstname='.$row['firstname'].'&amp;lastname='.$row['lastname'].'"><div>Logout</div></a>';  
         
  }

}


?>