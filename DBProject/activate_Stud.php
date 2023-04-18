<html>
    <body>
        <?php
            $conn = new mysqli("localhost:8080","root","1234","DBProj");
            $id=$_GET["id"];
            $sql="update Alumni set active=1 where rollno='$id';";
            $result=$conn->query($sql);
            if($result)
            {
                header("location: Validate_Stud.php");
            }
        ?>
    </body>
</html>
