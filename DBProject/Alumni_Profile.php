<?php
// Start the session
session_start();
if(sizeof($_SESSION)==0)
{
    exit();
}

?> 
<html>
<head><link rel="stylesheet" href="reg.css"></head>
    <body>
    
        <?php 
            $conn = new mysqli("localhost:8080","root","1234","DBProj");
            $roll=$_SESSION["rollno"];
            
            $sql="select * from Common where rollno='$roll';";
            $result=$conn->query($sql);
            $row=$result->fetch_assoc();
        ?>
        <div class = "container">
        <form action="Alumni_Profile_update.php" method="post">
        <h2>Alumni Profile page</h2><br>
            First Name: <input type="text" name="fname" value=<?php echo '"'.$row["first_name"].'"' ?> ><br>
            Last Name: <input type="text" name="lname" value=<?php echo $row["last_name"] ?>><br>
            Roll No. : <?php echo $row["rollno"] ?><br>
            Gender: <select name="gender">
                <option value="Male" <?php (($row["gender"]=="M")?"Selected ":" ") ?> >Male</option>
                <option value="Female" <?php (($row["gender"]=="F")?"Selected ":" ") ?>>Female</option>
                <option value="NA" <?php (($row["gender"]=="NA")?"Selected ":" ") ?> >I'd rather not say</option>
            </select><br>
            IITP  Webmail: <input type="email" name="webmail" value=<?php echo $row["webmail"] ?>><br>
            Alternate email: <input type="email" name="email" value=<?php echo $row["email"] ?>><br>
            Phone No. : <input type="tel" name="contact" value=<?php echo $row["contact"] ?>><br>
            DOB: <input type="date" name="dob" value=<?php echo $row["dob"] ?>><br>


            <label>Specialisation:</label> <select name="spec">
                <option value="CS" <?php echo (($row["spec"]=="CS")?"selected":" ")?>>CS</option>
                <option value="AI"  <?php echo (($row["spec"]=="AI")?"selected":" ")?>>AI & DS</option>
                <option value="MNC"  <?php echo (($row["spec"]=="MNC")?"selected":" ")?>>MNC</option>
                <option value="EE"  <?php echo (($row["spec"]=="EE")?"selected":" ")?>>EE</option>
                <option value="CB"  <?php echo (($row["spec"]=="CB")?"selected":" ")?>>CB</option>
                <option value="PH"  <?php echo (($row["spec"]=="PH")?"selected":" ")?>>PH</option>
                <option value="CE"  <?php echo (($row["spec"]=="CE")?"selected":" ")?>>CE</option>
                <option value="ME"  <?php echo (($row["spec"]=="ME")?"selected":" ")?>>ME</option>
            </select><br>

            10th marks: <input type="number" min="0.0" max="500.0" step="0.01" name="10marks" value=<?php echo $row["marks10"] ?>><br>
            12th marks: <input type="number" min="0.0" max="500.0" step="0.01" name="12marks" value=<?php echo $row["marks12"] ?>><br>

            Password: <input type="password" name="pass" value=<?php echo $row["password"] ?>><br>
            Graduating Year: <input type="number" min="2008" name="passout_year" value=<?php echo $row["passout_year"] ?>><br><br>
            CPI: <input type="number" min="0.00" max="10.00" step="0.01"  name="cpi" value=<?php echo $row["cpi"] ?>><br>
            <input type="submit" value="Update">&nbsp;&nbsp;&nbsp;<a href="alum_dash.php">Cancel</a>
        </form>
    </body>
</html>