<?php
// Start the session
session_start();
if(sizeof($_SESSION)==0)
{
    exit();
}

?> 
<!DOCTYPE html>
<html>
<head>
  <title>Alumni Information</title>
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
</style>
</head>
<body>
  <?php
    if(isset($_GET['id'])) {
      $id = $_GET['id'];
    }
    $conn = new mysqli("localhost:8080","root","1234","DBProj");
    echo "<center><div class='card'>";
    echo "<h2>Alumni Information</h2>";
    $sql="select * from Common natural join Alumni where rollno='$id';";
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();
    $fname=$row["first_name"];
    $lname=$row["last_name"];
    $gender=$row["gender"];
    $passout=$row["passout_year"];
    if($gender=="M")
    {
        $gender="Male";
    }
    else if($gender=="F")
    {
        $gender="Female";
    }
    else
    {
        $gender="I'd Rather Not Say";
    }
    echo "Roll No: $id<br>"; 
    echo "First Name: $fname<br>"; 
    echo "Last Name: $lname<br>"; 
    echo "Gender: $gender<br>";
    echo "Passout Year: $passout<br><br>";
    echo "</div><br>";

        
        echo "<h2>PROFESSIONAL CAREER:</h2>";
        echo "</center>";
        $sql="select * from Past_Companies natural join Alumni where rollno='$id' order by start_year;";
        echo "<table id = stats>";
        echo "<tr><th>Company</th><th>Position</th><th>Start of Tenure</th><th>End of Tenure</th><th>Location</th><th>CTC</th></tr>";
        $result=$conn->query($sql);
        while($row=$result->fetch_assoc())
        {
            $ctc = $row["ctc"];
            $start_year=$row["start_year"];
            $end_year = $row["end_year"];
            $company=$row["company_name"];
            $position = $row["position"];
            $location = $row["location"];
            echo "<tr><td>".$company."</td><td>".$position."</td><td>".$start_year."</td><td>".$end_year."</td><td>".$location."</td><td>".$ctc."</td></tr><br>";
        }
        
        echo "<br>";
        echo "</table>";

    ?>
    <a href="Stud_Stat.php" text-decoration:none ><button class = "b">Stat Page</a>
    </body>
</html>
