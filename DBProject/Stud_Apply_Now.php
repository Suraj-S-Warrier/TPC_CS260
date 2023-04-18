<?php
// Start the session
session_start();
if(sizeof($_SESSION)==0)
{
    exit();
}

?> 
<html>
    <body>
        <?php
            if(isset($_GET["id"]) && isset($_GET["jid"]))
            {
                $roll=$_GET["id"];
                $jid=$_GET["jid"];
            }
            $conn = new mysqli("localhost:8080","root","1234","DBProj");
            $sql="select count(*) from Job_Applications where jid='$jid' and rollno='$roll';";
            $result=$conn->query($sql);
            $row=$result->fetch_assoc();
            if($row["count(*)"]>0)
            {
                echo "Cant apply for the same job twice!";
                exit();
            }
            $sql="insert into Job_Applications values('$jid','$roll');";
            $result=$conn->query($sql);
            if($result)
            {
                echo "Added Successfully!";
            }
            else
            {
                echo "Cannot apply for the same job twice!";
                exit();
            }
        ?><a href="Stud_View_Opportunities.php">Back</a>
    </body>
</html>