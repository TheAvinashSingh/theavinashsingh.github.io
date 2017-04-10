<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="css/loginstyle.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <div class="container">
    <?php include_once('connection.php');
          session_start();
    ?>


    <?php     
    include_once('loginheader.php');
    ?>

    
    <?php?>
           

        <div class="content">
            <div class="uppertext">
            
            <div class="text1">
                   
                <?php
               
             

                $errusername=$errpass="";

      
                if(!isset($_SESSION['userid']))
                {
                  if(isset($_POST['submit']))
                   { 
                   $username=$_POST['username'];
                  
                   $password=$_POST['password'];

                   if(!empty($password)&&!empty($username))
                   {    
                       $erruserid=$erremail=$errpass="";
                       $query="SELECT * FROM usersignup WHERE username='$username' AND password=SHA('$password')";
                       $data=mysqli_query($dbc,$query) or die("Problem");
                       if($row= mysqli_fetch_array($data))
                       {
                         $_SESSION['userid']= $row['userid'];
                         $_SESSION['username']=$row['username'];
                         $_SESSION['password']= $row['password'];
                         $qry="SELECT * FROM viewid WHERE userid='$row[userid]'";
                         $res=mysqli_query($dbc,$qry) or die("Problem in Login");
                         $row1=mysqli_fetch_array($res);
                         if(!mysqli_num_rows($res))
          
                            {
                               header('location:createorjoinfamily.php');                          
                              }
                                else 
                             { 
                               $_SESSION['familyid']=$row1['familyid'];
                               header("location:head.php");

                              }
                          }


                        else
                        {
                            echo'The User You requested does not exist or the password is incorrect';
                         } 
                        
                       
                      }else
                       {
                        if(!empty($username)&&empty($password)){$errusername="You Left Username";}
                        if(empty($username)&&!empty($password)){$errpass="You Left Password";}

                       }
                    }   
                 }else header('location:home.php');

                ?>
                

              
                

                
                
                <?php
                if(!isset($_SESSION['userid']))
                {
                  echo"<div class='loginform'>";  
                ?>
                 <h1 class="loginheading">Login</h1>
                <form enctype="multipart/form-data" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
                <table>
                    <tr>    
                        <td>
                            <input required title="Enter Username" class="box" type="text" name="username" placeholder="Username">
                            <span><?php echo $errusername; ?></span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <input required title="Enter Password" class="box" type="password" name="password" placeholder="Password">
                            <span><?php echo $errpass; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input class="submitbutton" type="submit" value="Login" name="submit">
                        </td>
                    </tr>
                </table>
                </form>
                <p class="bottomtext">Not registered? <a class="notregistered" href="signup.php">Sign Up</a></p>
                </div>
                <div id="message2">
                <?php
                }
                
               
                ?></div>
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