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

button{
    border: none;
}

#addFormPopup {
    display: none;
    max-width: 40%; /* Set max-width to limit form width to 40% of page width */
    margin: 0 auto; /* Center the form horizontally */
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 10px;
    font-family: Arial, sans-serif;
}

#addFormPopup h3 {
    margin-top: 0;
}

#addFormPopup form {
    margin-top: 20px;
}

#addFormPopup label {
    display: block;
    margin-bottom: 5px;
}

#addFormPopup input[type="text"],
#addFormPopup textarea {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

#addFormPopup input[type="submit"],
#addFormPopup button {
    padding: 10px;
    border-radius: 5px;
    border: none;
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
    font-size: 16px;
}

#addFormPopup input[type="submit"]:hover,
#addFormPopup button:hover {
    background-color: #3e8e41;
}

#addFormPopup button {
    margin-left: 10px;
    background-color: #ccc;
    color: #000;
}

/* Button styles */
.button {
    display: inline-block;
    padding: 12px 20px;
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    text-decoration: none;
    background-color: #4CAF50;
    color: white;
    border-radius: 5px;
    cursor: pointer;
}

.button:hover {
    background-color: #3e8e41;
}

.button:active {
    background-color: #36732b;
}

.button:focus {
    outline: none;
}

/* Optional: If you want to center the button */
.button-container {
    text-align: center;
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
        
    </style>
    </head>
    <body>
    <?php 
        $conn = new mysqli("localhost:8080","root","1234","DBProj");
        if($conn->connect_error){
            die("connection failed".$conn->connect_error."\n");
            exit();
        }
        $cid=$_SESSION["cid"];
        $sql="select * from Job_Roles natural join Company where cid='$cid';";
        $result=$conn->query($sql);
        // Fetch all results from the outer query into an array
        $rows = array();
        while($row=$result->fetch_assoc()) {
            $rows[] = $row;
        }

        // Loop through the array to fetch results from the inner query
        foreach ($rows as $row) {
            $jid=$row["jid"];
            echo "<h2 class = 'heading-secondary'>".$row["position"]."</h3><br>";
            $sql_1 = "select * from Job_Applications join Student on Job_Applications.rollno=Student.rollno join Common on Student.rollno = Common.rollno where Job_Applications.jid='$jid';";
            $result_1=$conn->query($sql_1);
            echo "<table id = stats>";
            echo "<tr><th>Roll No</th><th>First Name</th><th>Last Name</th><th>Gender</th></tr>";
            while($row_1=$result_1->fetch_assoc()) {
                $roll=$row_1["rollno"];
                echo "<tr><td><a href='Applicant_Profile.php?id=$roll'>".$row_1["rollno"]."</a></td><td>".$row_1["first_name"]."</td><td>".$row_1["last_name"]."</td><td>".$row_1["gender"]."</td><br>";
            }
            $result_1->data_seek(0);
            echo "</table>";
        }

$conn->close();
?>

    </body>
</html>