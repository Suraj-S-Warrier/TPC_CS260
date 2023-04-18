<?php 
session_start();
if(sizeof($_SESSION)==0)
{
    exit();
}
?>
<html>
    <body>
        <?php
            $conn = new mysqli("localhost:8080","root","1234","DBProj");
            if($conn->connect_error){
                die("connection failed".$conn->connect_error."\n");
                exit();

            }
            $company=$_SESSION["company_name"];
            $cid=$_SESSION["cid"];
            $jid=uniqid();
            $position = $_POST["position"];
            $cpi_req=$_POST["cpi_req"];
            $min_passout_year=$_POST["min_passout_year"];
            $branches_req=$_POST["branches_req"];
            foreach($branches_req as $bq)
            {
                if($bq=="ALL")
                {
                    $branches_req=array("CS","AI","MNC","EE","PH","CB","CE");
                }
            }
            $marks_req = $_POST["marks_req"];
            $wr_interview=$_POST["wr_interview"];
            $on_off=$_POST["on_off"];
            $package_offered=$_POST["package_offered"];
            $branches="";
            foreach($branches_req as $bq)
            {
                if($bq!=$branches_req[0]){
                    $branches.=(",".$bq);
                }
                else
                {
                    $branches.=$bq;
                }
                
            }
            $sql="insert into Job_Roles values('$jid','$cid','$company','$position',$cpi_req,$marks_req,'$branches',$package_offered,$min_passout_year,$wr_interview,$on_off);";
            $result=$conn->query($sql);
            if($result)
            {
                echo "Position added successfully!";
            } 
        ?>
        <br><a href="Comp_Dashboard.php">Dashboard</a>
    </body>
</html>
