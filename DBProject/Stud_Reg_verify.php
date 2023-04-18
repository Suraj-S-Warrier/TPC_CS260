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

        $fname= $_POST["fname"];
        $lname= $_POST["lname"];
        $webmail = $_POST['webmail'];
        $pass = $_POST['pass'];
        $conpass = $_POST['confirmpass'];
        $gender = $_POST['gender'];
        $email=$_POST["email"];
        $roll = $_POST["rollno"];
        $contact =$_POST["contact"]; 
        $dob = $_POST["dob"];
        $package = $_POST["package"];
        $cpi = $_POST["cpi"];
        $spi1 = $_POST["spi1"];
        $spi2 = $_POST["spi2"];
        $spi3 = $_POST["spi3"];
        $spi4 = $_POST["spi4"];
        $spi5 = $_POST["spi5"];
        $spi6 = $_POST["spi6"];
        $spi7 = $_POST["spi7"];
        $spi8 = $_POST["spi8"];
        $marks10=$_POST["10marks"];
        $marks12 = $_POST["12marks"];
        $spec=$_POST["spec"];
        $passout_year=$_POST["passout_year"];

        if($pass!=$conpass){
            echo "Passwords not matching";
            exit();
        }
        else if($error1 == 0 && $error2 ==0){
            $conn = new mysqli("localhost:8080","root","1234","DBProj");
            if($conn->connect_error){
                die("connection failed".$conn->connect_error."\n");
                exit();

            }

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

            //ensuring proper email format
            
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
            $uppercase = preg_match('@[A-Z]@', $pass);
            $lowercase = preg_match('@[a-z]@', $pass);
            $number    = preg_match('@[0-9]@', $pass);
            $specialChars = preg_match('@[^\w]@', $pass);

            if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass) < 8) {
                echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
                exit();
            }
            $sql="select count(*) from Common where rollno='$roll' or webmail='$webmail'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            if($row["count(*)"]>0)
            {
                echo 'User is already registered. Try logging in or re-check the entered credentials.';
                exit();
            }
            $activation_code=uniqid();
            $sql  = "Insert into Student values('$roll','$spi1','$spi2','$spi3','$spi4','$spi5','$spi6','$spi7','$spi8','$package',0, '$new_trans_name', '$new_resume_name');";  //the zero specifies the activation status...once the email verification is done, activation status can be set to 1.
            $result = $conn->query($sql);
            
            $sql="insert into Common values('$fname','$lname','$roll','$contact','$webmail','$email','$pass','$dob','$cpi','$marks10','$marks12','$spec', '$gender', '$passout_year');";
            $result = $conn->query($sql);
            if($result)
            {

                //echo 'An activation link has been sent to your email. ';

            }
            
        }
        else
        {
            echo "transcript error:".$error1."<br>resume error:".$error2;
        }

        


        ?><br>
        <a href="Stud_Login.php">Login</a>
    </body> 
</html>