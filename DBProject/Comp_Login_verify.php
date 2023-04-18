<?php
// Start the session
session_start();
?>
<html>
    <body>
        <?php 
            $email=$_POST["email"];
            $pass = $_POST["pass"];
            $conn = new mysqli("localhost:8080","root","1234","DBProj");
            if($conn->connect_error){
                die("connection failed".$conn->connect_error."\n");
                exit();

            }
            $sql = "Select count(*) from Company where email='$email' and password='$pass';";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            if($row["count(*)"]==0)
            {
                echo 'Invalid user info. Please try again.';
                exit();
            }
            else
            {
                $sql="Select count(*) from Company where email='$email' and password='$pass' and approved=1;";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                if($row["count(*)"]==0)
                {
                    echo "Company has not yet been approved. Contact admin.";
                    exit();
                }
                $sql="select cid,company_name from Company where email='$email' and password='$pass';";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $_SESSION["cid"] =$row["cid"];
                $_SESSION["company_name"] =$row["company_name"];
                $_SESSION["email"] =  $email;
                $_SESSION["pass"]=$pass;


                echo 'Logged in successfully!';
                header("location: Comp_dashboard.php");
                
            }
            
        ?>
        <a href= "Comp_dashboard.php">DashBoard</a>
    </body>
</html>