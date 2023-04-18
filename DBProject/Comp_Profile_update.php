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
            $company_name=$_POST["company_name"];
            $hiring=(($_POST["hiring"]=="yes")?1:0);
            $email=$_POST["email"];
            $contact=$_POST["contact"];
            $pass=$_POST["pass"];

            $conn = new mysqli("localhost:8080","root","1234","DBProj");
            if($conn->connect_error){
                die("connection failed".$conn->connect_error."\n");
                exit();

            }
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
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
            $cid=$_SESSION["cid"];
            $sql="update Company set company_name='$company_name',hiring=$hiring,email='$email',contact=$contact,password='$pass' where cid='$cid';";
            $result=$conn->query($sql);
            if($result)
            {
                echo "Updated Successfully!";
            }
        ?><br><a href="Comp_Dashboard.php">Back</a>
    </body>
</html>