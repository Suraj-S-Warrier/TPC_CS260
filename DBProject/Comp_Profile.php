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
    <meta charset="utf-8">
    <title>jquery-multi-select</title>
    <link rel="stylesheet" href="reg.css">
    <link rel="stylesheet" type="text/css" href="example-styles.css">
    <link rel="stylesheet" type="text/css" href="demo-styles.css">
    <script type="text/javascript" src="jquery-2.2.4.min.js"></script>
    <script type="text/javascript" src="jquery.multi-select.js"></script>

    <style>.b{
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
a{
    color: white;
    text-decoration: none;
}
</style>
</head>
    <body>
        
        <?php 
            $conn = new mysqli("localhost:8080","root","1234","DBProj");
            $cid=$_SESSION["cid"];
            $sql="select * from Company where cid='$cid';";
            $result=$conn->query($sql);
            $row=$result->fetch_assoc();
        ?>
        <div class = "container">
        <h2><font size = "10">Company Profile</font></h2><br><br>
        <form action="Comp_Profile_update.php" method="post">
            Company Name: <input type="text" name="company_name" value=<?php echo $row["company_name"] ?>><br>
            <label>Hiring:</label> <select name="hiring">
                <option value="yes" <?php echo (($row["hiring"]=='1')?"Selected ":" ") ?>>YES</option>
                <option value="no" <?php echo (($row["hiring"]=='0')?"Selected ":" ") ?>>NO</option>
            </select><br>
            Email: <input type="email" name="email" value=<?php echo $row["email"] ?>><br>
            Contact No:<input type="text" name="contact" value=<?php echo $row["contact"] ?>><br>
            Password:<input type="password" name="pass" value=<?php echo $row["password"] ?>><br>
            
            
        <input type="submit" value="Update">
        </form><br>
        <center><button class = "b"><a href="Comp_Dashboard.php">Back</a>

    </body>
</html>