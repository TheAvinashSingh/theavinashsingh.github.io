    <link href="css/signupstyle.css" type="text/css" rel="stylesheet"/>
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
                    <li class="active"><a href="home.php">HOME</a></li>
                    <li><a href="tempfamily.php">CREATE/JOIN FAMILY</a></li>
                    <li><a href="setexpenditure.php">EnteR EXPENDITURE</a></li>
                    <li><a href="setBudget.php">MANAGE BUDGET</a></li>
                    <li><a href="viewbudget.php">VIEW STATUS</a></li>
                </ul>
            </div>
        </div>
