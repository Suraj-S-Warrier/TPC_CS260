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

            // I would need the session variables form the students profile page for 
            // CPI, min year criteria, branch(s) required, 
            $c1 = $_SESSION["cpi"];
            $c2 = $_SESSION["passout_year"];
            $c3 = $_SESSION["spec"];
            $c4 = 1;
            $c5=$_SESSION["rollno"];
            $package=$_SESSION["package"];
            echo "You are eligible for the following companies: <br>";
            $conn = new mysqli("localhost:8080","root","1234","DBProj");
            if($conn->connect_error){
                die("connection failed".$conn->connect_error."\n");
                exit();

            }
            
            $sql = "select jid,cid,company_name, ctc, wr_interview,on_off,branches_req,position from Job_Roles natural join Company where cpi_req <= $c1 AND min_passout_year >= $c2 AND hiring = $c4 and ctc>=$package;";

            $result = $conn->query($sql);

                while($row=$result->fetch_assoc())
                {
                    $branches=explode(",",$row["branches_req"]);
                    $flg=0;
                    
                    foreach($branches as $check)
                    {
                        if($c3==$check)
                        {
                            $flg=1;
                            break;
                        }
                    }
                    if($flg){
                        $c6=$row["jid"];
                        $c7=$row["cid"];
                        echo $row["company_name"] . " " .$row["position"]." ". $row["ctc"] . " " . ($row["wr_interview"]?"Written ":"Interview ").($row["on_off"]?"Online ":"Offline "). " &nbsp; <a href='Stud_Apply_Now.php?id=$c5&jid=$c6'>Apply Now</a><br>";
                    }
                    

                    
                }
        ?><br>
        <a href="Stud_dashboard.php">DashBoard</a>
    </body>
</html>

