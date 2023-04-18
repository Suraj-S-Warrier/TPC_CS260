<?php
// Start the session
session_start();
if(sizeof($_SESSION)==0)
{
    exit();
}
//$_SESSION['Update'] = '0';
$_SESSION['Add'] = '0';

//MIGHT ENCOUNTER A TINY GLITCH: WHILE ADDING A CARD IN A NEW SESSION, YOU WILL HAVE TO REFRESH THE PAGE IN-ORDER TO VIEW IT//
?>
<!DOCTYPE html>
<html>
<head>
    <title>Card Manager</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

        
    </style>
</head>
<body>

<h1 class="heading-primary">Work Experience</h1>
<div class="heading-divider"></div>
    <?php
    // Connect to the database
    $conn = new mysqli("localhost:8080","root","1234","DBProj");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $roll = $_SESSION["rollno"];
   
    //echo $roll;
    // Handle form submission for adding or updating a card

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if we're adding a new card or updating an existing one
        //$var = $_SESSION['Update'];
        $var2 = $_POST['add'];

        

        if ($_SESSION['Update'] == '1' && isset($_SESSION['Update'])) {
            // Updating an existing card
            $var = $_SESSION['Update'];
            //echo "<script>console.log($var); </script>";
            $id = $roll;
            $title = $_POST['title'];
            $description = $_POST['description'];
            $date = $_POST['date'];
            $status = $_POST['status'];
            $sy = $_POST['sy'];
            $ey = $_POST['ey'];
            $sexy = $_SESSION['PCID'];
    
            $sql = "UPDATE Past_Companies SET company_name='$title', position='$description', location='$date', ctc='$status', start_year = '$sy', end_year='$ey'  WHERE pcid='$sexy'";
            if (!mysqli_query($conn, $sql)) {
                die("Query failed: " . mysqli_error($conn));
            }
        }
        else if($_SESSION['Delete'] == '1')
        {
            //Boobs
        }
        else if (isset($_POST['add'])) {
            // Adding a new card
            
			$id = $roll;
            $title = $_POST['title'];
            $description = $_POST['description'];
            $date = $_POST['date'];
            $status = $_POST['status'];
			$sy = $_POST['sy'];
			$ey = $_POST['ey'];
            $pcid = uniqid();

            $sql1 = "SELECT pcid FROM past_companies WHERE rollno = '$roll' AND company_name = '$title' AND position = '$description' AND location = '$date' AND ctc = '$status' AND start_year = '$sy' AND end_year = '$ey'";
            $result = mysqli_query($conn, $sql1);
            if ($result->num_rows > 0)
            {
                
            }
            else{
                $sql = "INSERT INTO Past_Companies (pcid, rollno, company_name, position, location, ctc, start_year, end_year) VALUES ('$pcid', '$roll', '$title', '$description', '$date', '$status', '$sy', '$ey')";
                if (!mysqli_query($conn, $sql)) {
                    die("Query failed: " . mysqli_error($conn));
                }
            }
            
        } 

        $_SESSION['Update'] = '0';
        $_SESSION['Delete'] = '0';
        unset($_POST['add']);
        echo "<script>console.log($var2); </script>";

    }

    // Query the database for the cards
    $sql = "SELECT * FROM Past_Companies where rollno='$roll';";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Loop through the results and output a card for each row
    //echo "<script>console.log($var); </script>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='card-container'>";
        echo "<div class='card'>";
        echo "<h2><b>" . $row['company_name'] . "</b></h2>";
        echo "<p>" . $row['position'] . "</p>";
        echo "<p>" . $row['location'] . "</p>";
        echo "<p>" . $row['ctc'] . "</p>";
		echo "<p>" . $row['start_year'] . "</p>";
		echo "<p>" . $row['end_year'] . "</p>";
        echo "<button onclick='editCard(" . json_encode($row['pcid']) . ")'><a>Update</a></button>";
        echo "<button onclick='deleteCard(" . json_encode($row['pcid']) . ")'><a>Delete</a></button>";
        echo "</div>";
        echo "</div>";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <button onclick="showAddForm()" class = "button">Add Card</button>

   
	    <!-- Add Card Form Popup -->
		<div id="addFormPopup" style="display: none;">
        <h3>Add Card</h3>
        <form method="POST">
            <input type="hidden" name="id">
            <label for="title">Company Name:</label><br>
            <input type="text" id="title" name="title" required><br>
            <label for="description">Position:</label><br>
            <textarea id="description" name="description" required></textarea><br>
            <label for="date">Location:</label><br>
            <input type="text" id="date" name="date" required><br>
            <label for="status">CTC:</label><br>
            <input type="text" id="status" name="status" required><br>
			<label for="status">Start Year:</label><br>
            <input type="text" id="sy" name="sy" required><br>
			<label for="status">End Year</label><br>
            <input type="text" id="ey" name="ey" required><br>
            <input type="submit" name="add" value="Add">
            <button onclick="hideAddForm()">Cancel</button>
        </form>
    </div>

    <script>
        // Show the add card form popup
        function showAddForm() {
            document.getElementById('addFormPopup').style.display = 'block';
        }

        // Hide the add card form popup
        function hideAddForm() {
            document.getElementById('addFormPopup').style.display = 'none';
        }

        // Edit a card
        function editCard(id) {
            // Get the card data from the server
            console.log("testing");
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Show the edit card form with the current values as placeholders
                        var data = JSON.parse(xhr.responseText);
                        document.getElementById('addFormPopup').style.display = 'block';
                        document.getElementsByName('id').value = data.rollno;
                        document.getElementById('title').value = data.company_name;
                        document.getElementById('description').value = data.position;
                        document.getElementById('date').value = data.location;
                        document.getElementById('status').value = data.ctc;
						document.getElementById('sy').value = data.start_year;
						document.getElementById('ey').value = data.end_year;
                        document.getElementsByName('add').value = 'Update';
                        console.log(document.getElementsByName('add').value);
                    } else {
                        console.error(xhr.status);
                    }
                }
            }
            xhr.open('GET', 'get_card.php?id=' + id, true);
            xhr.send();
        }

        // Delete a card
        function deleteCard(id) {
            if (confirm("Are you sure you want to delete this card?")) {
                // Send the delete request to the server
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Refresh the page to show the updated card list
                            location.reload();
                        } else {
                            console.error(xhr.status);
                        }
                    }
                }
                xhr.open('POST', 'delete_card.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('id=' + id);
                
            }
        }
    </script>
    <br><br><br><br><br><br>
    <a href="alum_dash.php" class = "b">Back</a>
</body>
</html>
