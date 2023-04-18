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
            $conn = new mysqli("localhost:8080","root","1234","DBProj");
            if($conn->connect_error){
                die("connection failed".$conn->connect_error."\n");
                exit();

            }
            $jid=$_GET["jid"];
            $sql="delete from Job_Roles where jid='$jid';";
            $result=$conn->query($sql);
            $sql="delete from Job_Applications where jid='$jid';";
            $result=$conn->query($sql);
            if($result)
            {
                echo "deleted job position successfully!";
            }
            
        ?><br><a href="View_Job_Roles.php">Back</a>
    </body>
</html>