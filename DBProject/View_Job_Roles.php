<?php 
session_start();
if(sizeof($_SESSION)==0)
{
    exit();
}
?>
<html>
<style>
  body {
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f8f9fa;
  font-family: Arial, sans-serif;
}

.card {
  background-color: #343a40;
  padding: 20px;
  border-radius: 10px;
  max-width: 400px;
  width: 100%;
  color: white;
  text-align: center;
  margin-bottom: 20px; /* Add margin-bottom to create space between cards */
}

.card h2 {
  font-size: 24px;
  margin-bottom: 10px;
}

.card p {
  font-size: 18px;
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
}
.b:hover {
  background-color: #3e8e41;
}
#stats {
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

        /* Pagination styles */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 16px;
        }
        .pagination a {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            margin: 0 4px;
            border-radius: 4px;
        }
        .pagination a:hover {
            background-color: #45a049;
        }
        .pagination a:disabled {
            background-color: #ddd;
            color: #777;
            cursor: default;
        }

        .pagination a {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            margin: 0 4px;
            border-radius: 4px;
        }
        .pagination a:hover {
            background-color: #45a049;
        }
        .pagination a:disabled {
            background-color: #ddd;
            color: #777;
            cursor: default;
        }
        a {
  text-decoration: none !important;
  color: white;
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
}
.b:hover {
  background-color: #3e8e41;
}

    /* Heading Primary */
    .heading-primary {
  font-family: "Helvetica Neue", Arial, sans-serif;
  text-transform: uppercase;
  text-align: center;
  font-size: 36px;
  color: black;
  margin-top: 50px;
  transition: color 0.3s ease-in-out; /* Added transition for hover effect */
}

/* Heading Divider */
.heading-divider {
  width: 100px;
  height: 3px;
  background-color: black;
  margin: 10px auto;
}

/* Heading Secondary */
.heading-secondary {
  font-family: "Helvetica Neue", Arial, sans-serif;
  text-align: center;
  font-size: 24px;
  color: #f38181;
  margin-top: 20px;
  transition: color 0.3s ease-in-out; /* Added transition for hover effect */
}

/* Hover Effect */
.heading-primary:hover {
  color: #f38181;
}

.heading-secondary:hover {
  color: #ff6b6b;
}
</style>
</head>
    <body>
    <h1 class="heading-primary"><center>Job Listing</center></h1>
    <div class="heading-divider"></div>
        <?php 
            $conn = new mysqli("localhost:8080","root","1234","DBProj");
            if($conn->connect_error){
                die("connection failed".$conn->connect_error."\n");
                exit();

            }

            $company=$_SESSION["company_name"];
            $cid=$_SESSION["cid"];
            $sql="select * from Job_Roles where company_name='$company' and cid='$cid';";
            $result=$conn->query($sql);
            echo "<table id = stats>";
            echo "<tr><th>Position</th><th>CPI Req</th><th>Marks Req</th><th>Open To</th><th>CTC:</th><th>Batch of:</th><th>Mode</th><th>Medium</th><th>DELETE</th></tr>";
            while($row=$result->fetch_assoc())
            {
                $jid=$row["jid"];
                echo "<tr><td>".$row["position"]."</td><td>".$row["cpi_req"]."</td><td>".$row["marks_req"]."</td><td>".$row["branches_req"]."</td><td>".$row["ctc"]."</td><td>".$row["min_passout_year"]."</td><td>".($row["wr_interview"]?"Written ":"Interview ")."</td><td>".($row["on_off"]?"Online ":"Offline ")."</td><td> <a href='delete_job_confirm.php?jid=$jid'><button class = 'b'>Delete</button></a><br></td></tr>";
            }
        ?>
        <br><a href="Comp_Dashboard.php">Dashboard</a>
    </body>
</html>