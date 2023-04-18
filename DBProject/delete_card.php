<?php
session_start();
if(sizeof($_SESSION)==0)
{
    exit();
}

$_SESSION['Delete'] = '1';
// Connect to the database
$conn = new mysqli("localhost:8080","root","1234","DBProj");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the ID of the card to delete
$id = $_POST['id'];
echo "<script>console.log($id); </script>";
// Delete the card from the database
$sql = "DELETE FROM Past_Companies WHERE pcid='$id'";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Close the database connection
mysqli_close($conn);
?>
