    <!doctype html>
<html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Highcharts Pie Chart</title>
    <style>
        .button:hover {
            box-shadow: 2px 2px 5px #000;
        }
    </style>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
      var options = {
        chart: {
                  renderTo: 'container',
                  plotBackgroundColor: null,
                  plotBorderWidth: null,
                  plotShadow: false
              },
              title: {
                  text: 'Your Budget'
              },
              tooltip: {
                  formatter: function() {
                      return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                  }
              },
              plotOptions: {
                  pie: {
                      allowPointSelect: true,
                      cursor: 'pointer',
                      dataLabels: {
                          enabled: true,
                          color: '#000000',
                          connectorColor: '#000000',
                          formatter: function() {
                              return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                          }
                      }
                  }
              },
              series: [{
                  type: 'pie',
                  name: 'Browser share',
                  data: []
              }]
          }
          
          $.getJSON("data.php", function(json) {//instead of data2.php i want data2y.php....see in the parent directory
        options.series[0].data = json;
            chart = new Highcharts.Chart(options);
          });
          
          
          
        });
$(document).ready(function() {
      var options = {
        chart: {
                  renderTo: 'container1',
                  plotBackgroundColor: null,
                  plotBorderWidth: null,
                  plotShadow: false
              },
              title: {
                  text: 'Your Expenditure'
              },
              tooltip: {
                  formatter: function() {
                      return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                  }
              },
              plotOptions: {
                  pie: {
                      allowPointSelect: true,
                      cursor: 'pointer',
                      dataLabels: {
                          enabled: true,
                          color: '#000000',
                          connectorColor: '#000000',
                          formatter: function() {
                              return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                          }
                      }
                  }
              },
              series: [{
                  type: 'pie',
                  name: 'Browser share',
                  data: []
              }]
          }
          
          $.getJSON("data2.php", function(json) {//instead of data2.php i want data2y.php....see in the parent directory
        options.series[0].data = json;
            chart = new Highcharts.Chart(options);
          });
          
          
          
        });

    </script>
    <script src="http://code.highcharts.com/highcharts.js"></script>
        <script src="http://code.highcharts.com/modules/exporting.js"></script>
    <link href="css/viewthisbudgetstyle.css" rel="stylesheet" type="text/css"/>
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
            
               <div class="text1">
                
                   <?php       
                         if(isset($_SESSION['userid'])){  
                          if(isset($_SESSION['familyid']))
                          {
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
                               }else { echo'<p>You Need To Login</p>';
                                        echo'<a class="button" style="padding:1vw; text-decoration:none;background-color:#3b70f9;color:#fff;border-radius:2vw;" href="loginb.php">Login</a>';

                                      }
                        ?>


                 
                   
                         <div class="right">
                         
                       <div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
                       <div id="container1" style="min-width: 400px; height: 400px; margin: 0 auto"></div><br><br>
                       <a class="button" style="padding:1vw; text-decoration:none;background-color:#3b70f9;color:#fff;border-radius:2vw;" href="viewbudget.php">Go Back</a>


                         </div>
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