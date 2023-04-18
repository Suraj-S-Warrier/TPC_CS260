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
            $sql = "Select rollno,first_name,cpi,spec,passout_year,count(*) from Student natural join Common where webmail='$webmail' and password='$pass';";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            if($row["count(*)"]!=0 && $row["passout_year"]>idate("Y"))
            {
                echo "Havent graduated yet. Login through student portal.";
                exit();
            }
            elseif(($row["count(*)"]==0))
            {
                $sql_1="select rollno,first_name,cpi,spec,passout_year,count(*) from Alumni natural join Common where webmail='$webmail' and password='$pass';";
                $result_1 = $conn->query($sql_1);
                $row_1 = $result_1->fetch_assoc();
                if(($row_1["count(*)"]==0))
                {
                    echo "Invalid credentials.Please try again.";
                    exit();
                }
                else 
                {   
                    $_SESSION["fname"] = $row_1["first_name"];
                    $_SESSION["rollno"] = $row_1["rollno"];
                    $_SESSION["webmail"] = $webmail;
                    $_SESSION["pass"] = $pass;
                    $_SESSION["cpi"] = $row_1["cpi"];
                    $_SESSION["spec"] = $row_1["spec"];

                    echo 'Logged in successfully!1';

                    header("location: alum_dash.php");

                }
            }
            elseif($row["count(*)"]!=0 && $row["passout_year"]<=idate("Y"))
            {
                $roll=$row["rollno"];
                $sql_2="insert into Alumni values('$roll',1);";
                $result_2=$conn->query($sql_2);
                if($result_2)
                {
                    echo "Logged in successfully!2";
                }
                $_SESSION["fname"] = $row["first_name"];
                $_SESSION["rollno"] = $row["rollno"];
                $_SESSION["webmail"] = $webmail;
                $_SESSION["pass"] = $pass;
                $_SESSION["cpi"] = $row["cpi"];
                $_SESSION["spec"] = $row["spec"];

                $sql_3="delete from Student where rollno='$roll';";
                $result_3=$conn->query($sql_3);
                

            }
            
        ?>
        <a href= "alum_dash.php">DashBoard</a>
    </body>
</html>