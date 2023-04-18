
<?php
session_start(); 
?>
<html>
    <body>
        <?php 
            $conn = new mysqli("localhost:8080","root","1234","DBProj");
            if($conn->connect_error){
                die("connection failed".$conn->connect_error."\n");
                exit();

            }
            $email=$_POST["email"];
            $pass=$_POST["pass"];
            $sql="select count(*) from Admin where email='$email' and password='$pass';";
            $result=$conn->query($sql);
            $row=$result->fetch_assoc();
            if($row["count(*)"]==0)
            {
                echo "Invalid credentials. Please try again.";
                exit();
            }
            $_SESSION["email"]=$email;
            $_SESSION["pass"]=$pass;
            header("location: Admin_dash.php");


        ?><br><a href="Admin_dash.php">Home</a>
    </body>
</html>