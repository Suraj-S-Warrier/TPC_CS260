<!-- TODO: 
1) need to add email verification...probably thinking of maybe adding two emails..one webmail, and another alternative, so that 
a random person cant create an account for my roll no...alternative email so that if webmail gets deactivated after graduating, alternative
can be used in alumni login.
2) the upload file thing is still not done
-->

<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #006699;
        }
        form {
            margin-top: 20px;
        }
        input[type="text"], input[type="email"], input[type="password"], input[type="number"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type="submit"] {
            background-color: #006699;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #004466;
        }
        label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Student Registration</h2><br><br>
        <form action="Stud_Reg_verify.php" method="post" enctype="multipart/form-data">
            <label for="fname">First Name:</label>
            <input type="text" name="fname" id="fname">
            <label for="lname">Last Name:</label>
            <input type="text" name="lname" id="lname">
            <label for="rollno">Roll No. :</label>
            <input type="text" name="rollno" id="rollno">
            <label for="gender">Gender:</label>
            <select name="gender" id="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="NA">I'd rather not say</option>
            </select>
            <label for="webmail">IITP Webmail:</label>
            <input type="email" name="webmail" id="webmail">
            <label for="email">Alternate Email:</label>
            <input type="email" name="email" id="email">
            <label for="contact">Phone No. :</label>
            <input type="tel" name="contact" id="contact"><br><br>
            <label for="dob">DOB:</label>
            <input type="date" name="dob" id="dob"><br><br>
            <label for="package">Package received:</label>
            <input type="number" name="package" value="0" id="package">
            <label for="spec">Specialisation:</label>
            <select name="spec" id="spec">
                <option value="CS">CS</option>
                <option value="AI">AI</option>
                <option value="MNC">MNC</option>
                <option value="EE">EE</option>
                <option value="CB">CB</option>
                <option value="PH">PH</option>
                <option value="CE">CE</option>
                <option value="ME">ME</option>
            </select><br>
            <label for="pass">Password:</label>
            <input type="password" name="pass">



            <label for="pass">Confirm Password:</label>
            <input type="password" name="confirmpass"><br>
            <label for="pass">CPI:</label>
            <input type="number" min="0.00" max="10.00" step="0.01" placeholder="7.96" name="cpi"><br>
            <label for="pass">1st Semester SPI:</label>
            <input type="number" min="0.00" max="10.00" step="0.01" placeholder="7.96" name="spi1"><br>
            <label for="pass">2nd semester SPI: </label>
            <input type="number" min="0.00" max="10.00" step="0.01" placeholder="7.96" name="spi2"><br>
            <label for="pass">3rd semester SPI:  </label>
            <input type="number" min="0.00" max="10.00" step="0.01" placeholder="7.96" name="spi3"><br>
            <label for="pass">4th semester SPI: </label>
            <input type="number" min="0.00" max="10.00" step="0.01" placeholder="7.96" name="spi4"><br>
            <label for="pass">5th semester SPI: </label>
            <input type="number" min="0.00" max="10.00" step="0.01" placeholder="7.96" name="spi5"><br>
            <label for="pass">6th semester SPI:  </label>
            <input type="number" min="0.00" max="10.00" step="0.01" placeholder="7.96" name="spi6"><br>
            <label for="pass">7th semester SPI: </label>
            <input type="number" min="0.00" max="10.00" step="0.01" placeholder="7.96" name="spi7"><br>
            <label for="pass">8th semester SPI: </label>
            <input type="number" min="0.00" max="10.00" step="0.01" placeholder="7.96" name="spi8"><br>
            <label for="pass">10th marks: </label>
            <input type="number" min="0.0" max="500.0" step="0.01" name="10marks"><br>
            <label for="pass">12th marks:   </label>
            <input type="number" min="0.0" max="500.0" step="0.01" name="12marks"><br>

            <label for="pass">Graduating Year:  </label>
            <input type="number" min="2008" name="passout_year" defaultValue=<?php echo idate("Y")+3?> placeholder=<?php echo idate("Y")+3?>><br><br>

            <label for="pass">Upload Transcript:   </label>
             <input type="file" name='transcript' id='transcript'><br><br>

             <label for="pass">Upload Resume:   </label>
            <input type="file" name='resume' id='resume'><br><br>

        <input type="submit" value="Register">
        </form>
    </div>

    </body>
</html>