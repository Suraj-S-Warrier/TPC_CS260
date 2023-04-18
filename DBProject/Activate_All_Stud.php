<html>
    <body>
        <?php
            $conn = new mysqli("localhost:8080","root","1234","DBProj");
            $sql="update Alumni set active=1;";
            $result=$conn->query($sql);
            if($result)
            {
                header("location: Validate_Stud.php");
            }
        ?>
    </body>
</html>