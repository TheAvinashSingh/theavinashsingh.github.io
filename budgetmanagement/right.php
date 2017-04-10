<?php
if(!isset($_SESSION['head']))
{?>
	<div class="right">
        <?php
        echo "You Created Your Family";
        echo "<br><br>Click To Update Your Family Info";
        echo "<br><br><a class='rightlink' href='updatefamilyinfo.php'>Update</a> ";
        ?>    
    </div>
<?php
}
else{
?>
<div class="right">
        <?php
        echo "You Already A Member Of A Family";
        echo "<br>Click To View Your Family Budget";
        echo "<br><br><a class='rightlink' href='viewbudget.php'>View Budget</a> ";
        ?>    
    </div>
<?php
}?>