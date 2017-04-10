<link href="css/createfamilystyle.css" rel="stylesheet" type="text/css"/>
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
                    echo '<span style="font-family:batman; font-size:2.5vmin; color: white; position:absolute; right:2vw; top:12vh;"> <p> Welcome!</p>'.$_SESSION['username'].'!</span>';//added this line
                  echo'</div>'; 
                 }?>
            
            </div>
            <div class="navbar">
                <ul>
                    <li><a href="home.php">HOME</a></li>
                    <li class="active"><a href="tempfamily.php">create/join family</a></li>
                    <li><a href="setExpenditure.php">Enter Expenditure</a></li>
                    <li><a href="setbudget.php">MANAGE BUDGET</a></li>
                    <li><a href="viewbudget.php">View Status</a></li>
                </ul>
            </div>
        </div>
