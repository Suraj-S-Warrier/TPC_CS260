

<!DOCTYPE html>
<html>
<head>
    <title>Job Opportunities</title>
    <style>
    /* Card container */
    .card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 30px;
        margin-top: 30px;
    }

    /* Card */
    .card {
        background-color: #f8f8f8;
        border-radius: 8px;
        padding: 20px;
        width: 300px;
        height: 300px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    /* Card content */
    .card h2 {
        font-size: 24px;
        margin: 0 0 10px;
        font-family: 'Roboto', sans-serif;
        color: #333;
    }

    .card h3 {
        font-size: 18px;
        margin: 0 0 10px;
        font-family: 'Roboto', sans-serif;
        color: #333;
    }

    .card p {
        font-size: 16px;
        margin: 0 0 15px;
        font-family: 'Roboto', sans-serif;
        color: #777;
    }

    .card a {
        display: inline-block;
        padding: 10px 16px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
        transition: 0.3s;
        font-family: 'Roboto', sans-serif;
    }

    .card a:hover {
        background-color: #0056b3;
    }

    /* Back to Dashboard button */
    .back-to-dashboard {
        display: block;
        margin-top: 30px;
        text-align: center;
        display: inline-block;
        padding: 10px 16px;
        background-color: red;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
        transition: 0.3s;
        font-family: 'Roboto', sans-serif;
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
    <?php
        // Start the session
        session_start();
        if (sizeof($_SESSION) == 0) {
            exit();
        }
    ?>
    
    <h1 class="heading-primary">Job Opportunities</h1>
<div class="heading-divider"></div>
<h2 class="heading-secondary">You are eligible for the following offers:</h2>

    <div class="card-container">
        <?php
            // I would need the session variables from the student's profile page for
            // CPI, min year criteria, branch(s) required,
            $c1 = $_SESSION["cpi"];
            $c2 = $_SESSION["passout_year"];
            $c3 = $_SESSION["spec"];
            $c4 = 1;
            $c5 = $_SESSION["rollno"];
            $package = $_SESSION["package"];
            $conn = new mysqli("localhost:8080", "root", "1234", "DBProj");
            if ($conn->connect_error) {
                die("connection failed" . $conn->connect_error . "\n");
                exit();
            }
            $sql = "SELECT jid, cid, company_name, ctc, wr_interview, on_off, branches_req, position FROM Job_Roles NATURAL JOIN Company WHERE cpi_req <= $c1 AND min_passout_year >= $c2 AND hiring = $c4 AND ctc >= $package;";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                $branches = explode(",", $row["branches_req"]);
                $flg = 0;
                foreach ($branches as $check) {
                    if ($c3 == $check) {
                        $flg = 1;
                        break;
                    }
                }
                if ($flg) {
                    $c6 = $row["jid"];
                    $c7 = $row["cid"];
                    echo "<div class='card'>
                    <h2>{$row['company_name']}</h2><br>
                    <h3><b>Position:</b> {$row['position']}</h3>
                    <p><b>CTC:</b> ₹{$row['ctc']} PA</p>
                    <p><b>Interview: </b>" . ($row["wr_interview"]?"Written ":"Interview ") . "</p>
                    <p><b>Online/Offline: </b>" .  ($row["on_off"]?"Online ":"Offline ") . "<br><br></p>
                    <a href='Stud_Apply_Now.php?id=$c5&jid=$c6'>Apply</a>
                </div>";
        }
    }
    $conn->close();
?>
</div>
<center>
<a href="Stud_dashboard.php" class="back-to-dashboard">Back to Dashboard</a>
</body>
</html>

