<?php
    session_start();
?>
<html>
    <body>
        <?php
            $conn = new mysqli("localhost:8080","root","1234","DBProj");
            $cid=$_GET["cid"];
            $sql="update Company set approved=1 where cid='$cid';";
            $result=$conn->query($sql);
            if($result)
            {
                header("location: Validate_Comp.php");
            }
        ?>
    </body>
</html>