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
    
    if(!isset($_FILES['transcript']))
    {
        echo "Upload transcript file";
        exit();
    }

    $trans_name = $_FILES['transcript']['name'];
    $trans_size = $_FILES['transcript']['size'];
    $tmp_name_trans = $_FILES['transcript']['tmp_name'];
    $error1 = $_FILES['transcript']['error'];

    if(!isset($_FILES['resume']))
    {
        echo "Upload resume file";
        exit();
    }

    $resume_name = $_FILES['resume']['name'];
    $resume_size = $_FILES['resume']['size'];
    $tmp_name_resume = $_FILES['resume']['tmp_name'];
    $error2= $_FILES['resume']['error'];

    $roll = $_SESSION['rollno'];
 


        //Common Table
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
        //Student Table
        $spi1 = $_POST["spi1"];
        $spi2 = $_POST["spi2"];
        $spi3 = $_POST["spi3"];
        $spi4 = $_POST["spi4"];
        $spi5 = $_POST["spi5"];
        $spi6 = $_POST["spi6"];
        $spi7 = $_POST["spi7"];
        $spi8 = $_POST["spi8"];
        $package = $_POST["package"];


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
        if($error1 == 0 && $error2 ==0){
            
    
            // adding files part
            $trans_ex = pathinfo($trans_name, PATHINFO_EXTENSION);
            $trans_ex_lc = strtolower($trans_ex);
    
            $resume_ex = pathinfo($resume_name, PATHINFO_EXTENSION);
            $resume_ex_lc = strtolower($resume_ex);
    
            $allowed_exs = array("pdf"); 
    
            if (!in_array($trans_ex_lc, $allowed_exs))
            {   
                echo $trans_ex_lc;
                echo "Invalid File Format Detected! Please upload pdfs only";
                exit();
            }
    
            if (!in_array($resume_ex_lc, $allowed_exs))
            {   
                echo $trans_ex_lc;
                echo "Invalid File Format Detected! Please upload pdfs only";
                exit();
            }
    
            $new_trans_name = $roll.'0.'.$trans_ex_lc;
            $trans_upload_path = 'transcripts/'.$new_trans_name;
            move_uploaded_file($tmp_name_trans, $trans_upload_path);
    
            $new_resume_name = $roll.'1.'.$resume_ex_lc;
            $resume_upload_path = 'resumes/'.$new_resume_name;
            move_uploaded_file($tmp_name_resume, $resume_upload_path);
        }

        $uppercase = preg_match('@[A-Z]@', $pass);
        $lowercase = preg_match('@[a-z]@', $pass);
        $number    = preg_match('@[0-9]@', $pass);
        $specialChars = preg_match('@[^\w]@', $pass);

        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass) < 8) {
            echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
            exit();
        }
        $roll=$_SESSION["rollno"];
        $sql="update Student set spi1=$spi1,spi2=$spi2,spi3=$spi3,spi4=$spi4,spi5=$spi5,spi6=$spi6,spi7=$spi7,spi8=$spi8,package=$package where rollno='$roll';";
        $result=$conn->query($sql);
        if($result)
        {
            echo "Updated Successfully!";
        }
        $sql="update Common set first_name='$fname',last_name='$lname',rollno='$roll',contact=$contact,webmail='$webmail',email='$email',password='$pass',dob='$dob',cpi=$cpi,marks10=$marks10,marks12=$marks12,spec='$spec',gender='$gender',passout_year=$passout_year where rollno='$roll';";
        $result=$conn->query($sql);
        ?>
    </body>
</html>