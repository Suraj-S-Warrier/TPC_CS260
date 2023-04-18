<html>
    <body>
        <?php
            $conn = new mysqli("localhost:8080","root","1234","DBProj");
            $sql="update Company set approved=1;";
            $result=$conn->query($sql);
            if($result)
            {
                header("location: Validate_Comp.php");
            }
        ?>
    </body>
</html>