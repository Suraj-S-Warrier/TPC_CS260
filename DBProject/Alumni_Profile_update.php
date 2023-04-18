<?php 
session_start();
if(sizeof($_SESSION)==0)
{
    exit();
}
?>
<html>
    <body>
        <?php 
        $roll = $_SESSION['rollno'];

        $fname= $_POST["fname"];
        $lname= $_POST["lname"];
        $webmail = $_POST['webmail'];
        $pass = $_POST['pass'];
        $gender = $_POST['gender'];
        $email=$_POST["email"];
        $contact =$_POST["contact"]; 
        $dob = $_POST["dob"];
        $marks10=$_POST["10marks"];
        $marks12 = $_POST["12marks"];
        $spec=$_POST["spec"];
        $cpi = $_POST["cpi"];
        $passout_year=$_POST["passout_year"];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            exit();
        }
        if (!filter_var($webmail, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            exit();
        }
        $email_array = explode("@",$webmail);
        if($email_array[1]!="iitp.ac.in")
        {
            echo "Enter a valid iitp email id";
            exit();
        }
        $conn = new mysqli("localhost:8080","root","1234","DBProj");
        if($conn->connect_error){
            die("connection failed".$conn->connect_error."\n");
            exit();

        }
        $uppercase = preg_match('@[A-Z]@', $pass);
        $lowercase = preg_match('@[a-z]@', $pass);
        $number    = preg_match('@[0-9]@', $pass);
        $specialChars = preg_match('@[^\w]@', $pass);

        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass) < 8) {
            echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
            exit();
        }
        $sql="update Common set first_name='$fname',last_name='$lname',rollno='$roll',contact=$contact,webmail='$webmail',email='$email',password='$pass',dob='$dob',cpi=$cpi,marks10=$marks10,marks12=$marks12,spec='$spec',gender='$gender',passout_year=$passout_year where rollno='$roll';";
        $result=$conn->query($sql);
        if($result)
        {
            echo "Updated Successfully!";
        }
        ?><br><a href="alum_dash.php">Back</a>
    </body>
</html>