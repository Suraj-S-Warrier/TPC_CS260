<?php 
session_start();
if(sizeof($_SESSION)==0)
{
    exit();
}
?>
<html>
    <body>
        <?php
            
        ?>
        Are you sure you want to delete? <br>NOTE: Deleting the job role will remove all the students who had applied for the particular job 

        <form action=<?php echo "'delete_job_role.php?jid=".$_GET["jid"]."'"?> method="post">
            <input type="submit" value="Delete">
        </form>
    </body>
</html>