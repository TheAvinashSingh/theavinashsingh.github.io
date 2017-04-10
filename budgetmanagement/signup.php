<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="css/signupstyle.css" rel="stylesheet" type="text/css"/>
    <script src="validate.js" ></script>
</head>
<body>
    <div class="container">
    <?php include_once('connection.php');
          session_start();
    ?>


    <?php     
    include_once("signupheader.php");
    ?>
    <?php if(isset($_SESSION['userid'])) header('location:home.php') ?>
    
    <?php?>
    <!-- --------------------------------------------------------------------------------------------------------------------------- -->
            <div class="content">
            <div class="uppertext">
            <div class="img1">
               <img class="man" src="images/man.png"/>'
            </div>
            <div class="text1">
                
             <?php

                $fname=$lname=$user=$password=$confpass=$contact=$conferror=$email=$errfname=$errlname=$erruser=$errpass=$errcon=$erremail=$captchaerr=$pictureerr="";
                $picture="";
                $fname="";
                $lname="";
                $user="";
                $email="";
                $password="";
                $confpass="";
                $contact="";
                $usercaptcha="";
                $errconfpass1="";
                $errconfpass2="";
                $g=1;//added
                if(isset($_POST['submit']))
                { 
                    $f=0;
                $picture=$_FILES['picture']['name'];
                $fname=$_POST['firstname'];
                $lname=$_POST['lastname'];
                $user=$_POST['username'];
                $email=$_POST['email'];
                $password=$_POST['pass'];
                $confpass=$_POST['confpass'];
                $contact=$_POST['contact'];
                $usercaptcha= $_POST['captcha'];

                if(!empty($user))
                 {
                   $qry1="SELECT * FROM usersignup WHERE username='$user' " or die('error');
                   $res1=mysqli_query($dbc,$qry1);
                   if($row=mysqli_num_rows($res1))
                    {
                      $user="";
                      $f=1;
                     }
                  }
                if(!empty($fname)&&!empty($lname)&&!empty($user)&&!empty($password)&&!empty($confpass)&&!empty($email)&&!empty($contact)&&!empty($usercaptcha)&&!empty($password)&&!empty($confpass)&&!empty($usercaptcha)&&!empty($picture))
                {  
                    $conferror=$errfname=$errlname=$erruser=$errpass=$errcon=$erremail=$pictureerr="";
                    if(($password==$confpass)&&($usercaptcha==$_COOKIE['captcha']))
                    {   setcookie("captcha",'',time()-3600);
                        //echo $_COOKIE['captcha'];
                        $path='images/';
                            $target= $path.$_FILES['picture']['name'];
                            move_uploaded_file($_FILES['picture']['tmp_name'], $target);
                       
                             $query="INSERT INTO `usersignup` (`userid`, `firstname`, `lastname`, `email`, `password`, `contact`, `userimage`,`username`) VALUES (NULL, '$fname', '$lname', '$email', SHA('$password'), '$contact','$picture','$user')";
                             $data=mysqli_query($dbc,$query);
                             $g=0;//added
                            $que="SELECT userid,username FROM usersignup WHERE username='$user'";
                             $result=mysqli_query($dbc,$que) or die("Problem");
                             if($rowres=mysqli_fetch_array($result))
                             {
                                 $_SESSION['userid']=$rowres['userid'];
                                 $_SESSION['username']=$rowres['username'];
                                 header("location:home.php");
                             }
                             mysqli_close($dbc);
                ?>

                <div id="message">

                <?php   
                        echo'<p>Your Username is: '.$user.'.';
                        echo'<p> <a href="loginb.php">Click here</a> to sign in...</p>';
            
                ?>

                </div>
                <?php           
                    }
                    else{
                        if($password!=$confpass)
                        {   $errcon=" * The password don't match";

                        }
                        if($usercaptcha!=$_COOKIE['captcha'])
                            {
                                $captchaerr=" * The captcha is incorrect";
                            }

        
                    }
                }
                else
                {
                if(empty($fname))
                $errfname="* This Field is Required";
                if(empty($lname))
                $errlname="* This Field is Required";
                if(empty($user)&&$f==1)
                $erruser="Username Already Exists";
                else
                $erruser="* This Field is Required ";
                if(empty($email))
                    $erremail=" * This Field is Required";
                if(empty($password))
                    $errpass=" * This Field is Required";
                if($password!=$confpass)
                {$errconfpass1=" * Password Doesn't Match";
                    $errconfpass2=" * Password Doesn't Match";}
                if(empty($confpass))
                    $conferror=" * This Field is Required";
                if(empty($contact))
                    $errcon=" * This Field is Required";
                if(empty($picture))
                    $pictureerr=" * This Field is Required";

                    }

                }

                ?>
                <?php if($g)
                {
                ?><div class="data">
                    <h1 class="signupheading">Set up your account. It's free.</h1>
                     <form class="form" enctype=multipart/form-data action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                      <table class="table" style="color:black;">
                        <tr>
                                <td>
                                   First Name:     
                                </td>
                              <td>
                                  <input class="box" placeholder="First Name" type="text" name="firstname" value="<?php echo $fname;?>" id="fname" onblur="text(this.id)" required><br>
                                  <span id="error" style="color:red; font-family: sans-serif; font-size:2vmin;"><?php echo $errfname; ?></span>
                              </td>
                          </tr>
                          <tr> 
                              <td>
                                 Last Name:    
                                </td>
                              <td>
                                  <input class="box" placeholder="Last Name" type="text" name="lastname" value="<?php echo $lname;?>" id="lname" onblur="text(this.id)" required><br>
                                  <span id="error2" style="color:red; font-family: sans-serif; font-size:2vmin;"><?php echo $errlname; ?></span>
                            </td>
                        </tr>
                          <tr>
                              <td>
                                   Username:     
                                </td>
                              <td>
                               <input class="box" placeholder="Username" type="text" name="username" value="<?php echo $user;?>" id="user" onblur="usern(this.id)" required><br>
                                <span id="usererror" style="color:red; font-family: sans-serif; font-size:2vmin;"><?php echo $erruser; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                   E-mail:     
                                </td>
                              <td>
                                <input class="box"  placeholder="E-mail" type="email" name="email" required id="mail" onblur="mailn(this.id)" value="<?php echo $email; ?>" ><br>
                                <span id="mailerror" style="color:red; font-family: sans-serif; font-size:2vmin;"><?php echo $erremail; ?></span>
                              </td>
                          </tr> 
                          <tr>
                              <td>
                                   Password:    
                                </td>
                              <td>
                                <input class="box" id="pass" onblur="passn(this.id)" placeholder="Password" required type="password" name="pass" value="<?php echo $password;?>"><br>
                                <span id="passerror" style="color:red; font-family: sans-serif; font-size:2vmin;"><?php echo $errpass; ?></span>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                   Confirm Password:    
                                </td>
                              <td>
                               <input class="box" id="confirm" onblur="confpassn(this.id)" placeholder="Confirm Password" required type="password" name="confpass" value="<?php echo $confpass; ?>" required ><br>
                                <span id="conferror" style="color:red; font-family: sans-serif; font-size:2vmin;"><?php echo $conferror; ?></span>
                              </td>
                          </tr>
                            <tr>
                                <td>
                                   Phone No.:    
                                </td>
                              <td>
                                <input class="box" id="no" onblur="phone(this.id)" placeholder="Contact No." type="text" name="contact"  required value="<?php echo $contact; ?>" ><br>
                                <span id="phoneerror" style="color:red; font-family: sans-serif; font-size:2vmin;"><?php echo $errcon; ?></span>
                              </td>
                          </tr>
                          <tr>
                              <td>    
                                </td>
                              <td>
                               <img src="captcha2.php"><br>

                              </td>
                          </tr> 
                          <tr>
                              <td>Captcha:</td>
                            <td>
                                 <input class="box" placeholder="Captcha" type="text" name="captcha" value="" required>
                               <span style="color:red; font-family: sans-serif; font-size:2vmin;"><?php echo $captchaerr;?></span> 
                              </td>
                          </tr>
                          <tr>
                            <td>
                                <label for="picture">Upload Your Picture</label>

                            </td>
                              <td>
                              <input class="uploadfile" type="file" name="picture" style="outline:none;" required><br><br>
                              <span style="color:red; font-family: sans-serif; font-size:2vmin;"><?php echo $pictureerr;?></span>

                              </td>
                          </tr> 
                          <tr>
                              <td></td>
                            <td>
                                <input class="submitbutton" type="submit" value="Signup" name="submit">
                              </td>
                          </tr>
                      </table>
                      </form>
                      </div>
                  <?php } ?>
                </div>
            </div>        
        </div>

    <!-- --------------------------------------------------------------------------------------------------------------------------- -->
    <?php?>





    <?php
    include_once("footer.php");
    ?>
    </div>

</body>
</html>