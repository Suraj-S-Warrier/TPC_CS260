<?php
    session_start();
    if(sizeof($_SESSION)==0)
    {
        exit();
        
    }
?>
<html>
    <head>
    <style>
  body {
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f8f9fa;
  font-family: Arial, sans-serif;
}


.b{
    margin-top: 20px;
  padding: 10px;
  border-radius: 5px;
  border: none;
  background-color: #4CAF50;
  color: white;
  cursor: pointer;
  font-size: 16px;
  color: white;
}
.b:hover {
  background-color: #3e8e41;
}
#stats {    
        margin-top: -50; /* Set margin-top to 0 */
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
        }
        #stats th {
            background-color: #f2f2f2;
            color: #333;
            font-weight: bold;
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        #stats td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        #stats tr:hover {
            background-color: #f9f9f9;
        }
         .boobs {
  text-decoration: none !important;
  color: white;
} 
</style>
    </head>
    <body>
        <?php
            $conn = new mysqli("localhost:8080","root","1234","DBProj");
            if($conn->connect_error){
                die("connection failed".$conn->connect_error."\n");
                exit();

            }
            
            $sql="select * from Company where approved=0;";
            $result=$conn->query($sql);
            $ct=0;
            echo"<h3> List of Companies: </h3><br><br>";
            echo "<table id = stats>";
            echo "<tr><th>Company ID </th><th>Company Name</th><th>Email</th><th>Contact</th><th>Activate</tr>";
            while($row=$result->fetch_assoc()) 
            {
                $ct++;
                $cid=$row["cid"];
                echo "<tr><td>".$row["cid"]."</td><td> ".$row["company_name"]."</td><td> ".$row["email"]."</td><td> ".$row["contact"]."</td><td> "."<a href='activate_Comp.php?cid=$cid'>ACTIVATE</a></td></tr><br>";
            } 
            echo "</table>";
            if($ct>1){
                echo "<br><br><br><br><button class ='b'><a href='Activate_All_Comp.php'  class = 'boobs'>Activate All</a></button>";
            }
            else if($ct==0)
            {
                echo "<h3> No more companies to approve. </h3>";
            }
        ?>
        <br><button class ='b'><a href="Admin_dash.php" class = "boobs">Back</a></button>
    </body>
</html>