<link href="css/logoutthis.css" rel="stylesheet" type="text/css"/>
        <div class="header">
            <div class="topleft">
                <div class="brandlogo">
                    <img class="logo" src="images/myb.png"/>
                </div>
                <div class="branddiv">
                     <div class="brandname">MakeYourBudget</div>
                    <div class="tagline">savings made simple..</div>
                </div>
            </div>
            <div class="topright">
              <?php
               if(empty($_SESSION['userid']))
               {
                echo ' <div class="loginsignup">';    
                echo '<a class="signupdiv" href="signup.php"><div>Sign Up</div></a>';
                echo '<a class="logindiv" href="loginb.php"><div>Log In</div></a>';
                echo'</div>';
               }
               
                else if(isset($_SESSION['userid'])||isset($_SESSION['familyid']))
                { echo '<div id="logout">';
                   include_once('logout.php');
                    echo '<div style="font-family:sans-serif; font-size:1.5vw; color: white; position:absolute; right:2vw; top:12vw;">  Welcome - '.$_SESSION['username'].'</div>';//added this line
                  echo'</div>'; 
                 }?>
            
            </div>
            <div class="navbar">
                <ul>
                    <li class="active"><a href="home.php">HOME</a></li>
                    <li><a href="tempfamily.php">create/join family</a></li>
                    <li><a href="setExpenditure.php">Enter EXPENDITURE</a></li>
                    <li><a href="setbudget.php">MANAGE BUDGET</a></li>
                    <li><a href="viewbudget.php">view status</a></li>
                </ul>
            </div>
        </div>
