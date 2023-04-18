<?php
session_start();
if(sizeof($_SESSION)==0)
{
    exit();
}
// Connect to the database
$conn = new mysqli("localhost:8080","root","1234","DBProj");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



$_SESSION['Update'] = '1';

// Get the ID of the card to edit
$id = $_GET['id'];
$_SESSION['PCID'] = $id;

// Query the database for the card data
$sql = "SELECT * FROM Past_Companies WHERE pcid='$id'";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Query failed: " . mysqli_error($conn));

}

// Get the card data as an associative array
$data = mysqli_fetch_assoc($result);

// Close the database connection
mysqli_close($conn);

// Return the card data as JSON
echo json_encode($data);
?>


