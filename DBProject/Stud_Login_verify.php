<?php
// Start the session
session_start();
?>
<html>
    <body>
        <?php 
            $webmail=$_POST["webmail"];
            $pass = $_POST["pass"];
            $conn = new mysqli("localhost:8080","root","1234","DBProj");
            if($conn->connect_error){
                die("connection failed".$conn->connect_error."\n");
                exit();

            }
            $sql = "Select count(*) from Student natural join Common where webmail='$webmail' and password='$pass';";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            if($row["count(*)"]==0)
            {
                echo 'Invalid user info. Please try again.';
                exit();
            }
            $sql="select rollno,first_name,cpi,spec,passout_year,package from Student natural join Common where webmail='$webmail' and password='$pass';";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $_SESSION["fname"] =$row["first_name"];
            $_SESSION["rollno"] =$row["rollno"];
            $_SESSION["webmail"] =  $webmail;
            $_SESSION["pass"]=$pass;
            $_SESSION["cpi"]=$row["cpi"];
            $_SESSION["spec"]=$row["spec"];
            $_SESSION["passout_year"]=$row["passout_year"];
            $_SESSION["package"]=$row["package"];


            echo 'Logged in successfully!';
            header("location: Stud_dashboard.php");
        ?><br>
        <a href= "Stud_dashboard.php">DashBoard</a>
    </body>
</html>