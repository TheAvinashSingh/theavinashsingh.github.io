
<?php

                                  $querycheck="SELECT * FROM viewid WHERE userid='".$_SESSION['userid']."'";
                                  $datacheck=mysqli_query($dbc,$querycheck);
                                  if(mysqli_num_rows($datacheck))
                                  {
                                    $rowcheck=mysqli_fetch_array($datacheck);
                                    if($rowcheck['roleid']!=1)
                                    {
                                        ?><div class="left">
                                            <p class="para"><a class="leftlink" href="setExpenditure.php">Make Daily Expenditure</a></p><br>
                                            <p class="para"><a class="leftlink" href="viewbudget.php">View Your Family Budget</a></p><br>
                                        </div><?php
                                    }
                                    else{ ?>
                                         <div class="left">
                                            <p class="para"><a class="leftlink" href="addmembers.php">Add Family Members</a></p>
                                            <p class="para"><a class="leftlink" href="createroles.php">Create Roles </a></p>
                                            <p class="para"><a class="leftlink" href="setbudget.php">Set Your Budget</a></p>
                                            <p class="para"><a class="leftlink" href="setExpenditure.php">Daily Expenditure</a></p>
                                            <p class="para"><a class="leftlink" href="viewbudget.php">View Family Budget</a></p>
                                            <p class="para"><a class="leftlink" href="updatefamilyinfo.php">Update Family Info</a></p>
                                        </div>
                                      
                                          <?php
                                                }
                                            }
 ?>

                               
	
	


