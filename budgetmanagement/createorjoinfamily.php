<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create or Join Family</title>
    <link href="css/createorjoinfamilystyle.css" rel="stylesheet" type="text/css"/>
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
                <div class="text">

                   <p>You Do Not Have A Family</p>
                    <a class="link" href="createfamily.php">Create Family</a><br><br>
                    <a class="link" href="joinfamily.php">Join Family</a><br>

        
               
                </div>       

       </div>
      
    <?php?>





    <?php
    include_once("footer.php");
    ?>







    </div>
</body>
</html>