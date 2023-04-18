<html>
    <body>
        <?php 
        $cid=uniqid();
        $company_name=$_POST["company_name"];
        $hiring=(($_POST["hiring"]=="yes")?1:0);
        $email=$_POST["email"];
        $contact=$_POST["contact"];
        $pass=$_POST["pass"];
        $conpass=$_POST["confirmpass"];

        if($pass!=$conpass){
            echo "Passwords not matching";
            exit();
        }
        else{
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

            $sql="select count(*) from Company where cid='$cid' or company_name='$company_name'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            if($row["count(*)"]>0)
            {
                echo 'Company Name is already taken. Try logging in or re-check the entered credentials.';
                exit();
            }
            $sql  = "insert into Company values('$cid','$company_name','$hiring','$email','$contact','$pass',0);";  //the zero specifies the activation status...once the email verification is done, activation status can be set to 1.
            $result = $conn->query($sql);
            if($result)
            {
                echo 'Registered Successfully!<br>NOTE: The registered company has not been activated yet..For activating the Company account, please contact the admin.';
            }
            else
            {
                echo mysqli_error($conn);
            }

            


            
        }


        ?><br>
        <a href="Comp_Login.php">Login</a>
    </body> 
</html>