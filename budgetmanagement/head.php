<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make Your Budget</title>
    <link href="css/headstyle.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <div class="container">
    <?php include_once('connection.php');
          session_start();
    ?>


    <?php     
    include_once('header.php');
    ?>

    
    <?php?>
           

        <div class="content">
            <div class="uppertext">
            
            <div class="text1">
                   
                <?php
                 if(isset($_SESSION['userid'])){?>
            
                <?php require_once("left.php");?>
                <?php require_once("right.php");?>
                <?php
                      }
                 else header("location:loginb.php");
    
        
                ?>
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