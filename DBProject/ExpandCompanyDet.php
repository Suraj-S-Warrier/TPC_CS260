<?php
// Start the session
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
        if(isset($_GET['company'])) {
            $company = $_GET['company'];
        }
        if(isset($_GET['year'])){
            $rec_year=$_GET["year"];
        }
        echo "<h1>".$company."</h1> ";
        echo "<h2>".$rec_year."</h2> ";
        echo"<hr>";
        $conn = new mysqli("localhost:8080","root","1234","DBProj");
        $sql="select company_name,rollno,recruitment_year,CTC,position from Recruitment_History where company_name='$company' and recruitment_year='$rec_year' order by CTC;";
        $result=$conn->query($sql);


        echo"<h3> List of Students Recruited </h3>";
        echo "<table id = stats>";
        echo "<tr><th>Roll No.</th><th>CTC</th><th>Position</th></tr>";
        while($row=$result->fetch_assoc())
        {
            $roll = $row["rollno"];
            $ctc=$row["CTC"];
            $pos=$row["position"];
            //echo "<a href='Alumnus_Profile.php?id=$roll'>".$roll.$ctc.$pos."</a><br>";

            echo "<tr><td><a href='Alumnus_Profile.php?id=$roll'>".$roll."</a></td><td>".$ctc."</td><td>".$pos."</td></tr><br>";
        }

        echo "<br>";
        echo "</table>";
    ?>
    <br><br><br>

    <a href="Stud_Stat.php" class = "boobs"><button class = 'b'>Back</a>
    </body>
</html>