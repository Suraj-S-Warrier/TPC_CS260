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
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f8f8;
            border-radius: 5px;
        }

        h1 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 10px;
        }

        .form-label {
            display: inline-block;
            width: 150px;
            font-weight: bold;
        }

        .form-value {
            display: inline-block;
            width: calc(100% - 150px);
        }

        .form-link {
            display: block;
            margin-top: 10px;
        }
    </style>
    </head>
    <body>
    <?php
        if(isset($_GET['id'])) {
        $id = $_GET['id'];
        }
        $conn = new mysqli("localhost:8080","root","1234","DBProj");
        $sql="select * from Common natural join Student where rollno='$id';";
        $result=$conn->query($sql);
        $row=$result->fetch_assoc();
        $fname=$row["first_name"];
        $lname=$row["last_name"];
        $gender=$row["gender"];
        $passout=$row["passout_year"];
        $spi_1 = $row["spi1"];
        $spi_2=$row["spi2"];
        $spi_3=$row["spi3"];
        $spi_4=$row["spi4"];
        $spi_5=$row["spi5"];
        $spi_6=$row["spi6"];
        $spi_7=$row["spi7"];
        $spi_8=$row["spi8"];
        $spec=$row["spec"];

        if($gender=="M")
        {
            $gender="Male";
        }
        else if($gender=="F")
        {
            $gender="Female";
        }
        else
        {
            $gender="I'd Rather Not Say";
        }
        // echo "Roll No: $id<br>"; 
        // echo "First Name: $fname<br>"; 
        // echo "Last Name: $lname<br>"; 
        // echo "Gender: $gender<br>";
        // echo "Passout Year:$passout<br><br>";
        // echo "1st Semester SPI: ".($spi_1==0.00?"Not Yet Updated":$spi_1)."<br>";
        // echo "2nd Semester SPI: ".($spi_2==0.00?"Not Yet Updated":$spi_2)."<br>";
        // echo "3rd Semester SPI: ".($spi_3==0.00?"Not Yet Updated":$spi_3)."<br>";
        // echo "4th Semester SPI: ".($spi_4==0.00?"Not Yet Updated":$spi_4)."<br>";
        // echo "5th Semester SPI: ".($spi_5==0.00?"Not Yet Updated":$spi_5)."<br>";
        // echo "6th Semester SPI: ".($spi_6==0.00?"Not Yet Updated":$spi_6)."<br>";
        // echo "7th Semester SPI: ".($spi_7==0.00?"Not Yet Updated":$spi_7)."<br>";
        // echo "8th Semester SPI: ".($spi_8==0.00?"Not Yet Updated":$spi_8)."<br>";
        // echo "Branch: $spec<br>";


        echo "<div class='container'>
        <h1>Applicant Information</h1>
        <div class='form-group'>
            <label class='form-label'>Roll No:</label>
            <span class='form-value'>".$id."</span>
        </div>";

        echo"
        <div class='form-group'>
            <label class='form-label'>First Name:</label>
            <span class='form-value'>".$fname."</span>
        </div>";

        echo "
        <div class='form-group'>
            <label class='form-label'>Last Name:</label>
            <span class='form-value'>".$lname."</span>
        </div>";

        echo "
        <div class='form-group'>
            <label class='form-label'>Gender:</label>
            <span class='form-value'>".$gender."</span>
        </div>";

        echo "
        <div class='form-group'>
            <label class='form-label'>Batch of:</label>
            <span class='form-value'>".$passout."</span>
        </div>";

        echo "
        <div class='form-group'>
            <label class='form-label'>1st Semester SPI:</label>
            <span class='form-value'>".$spi_1."</span>
        </div>";

        echo "
        <div class='form-group'>
            <label class='form-label'>2nd Semester SPI:</label>
            <span class='form-value'>".$spi_2."</span>
        </div>";

        echo "
        <div class='form-group'>
            <label class='form-label'>3rd Semester SPI:</label>
            <span class='form-value'>".$spi_3."</span>
        </div>";

        echo "
        <div class='form-group'>
            <label class='form-label'>4th Semester SPI:</label>
            <span class='form-value'>".$spi_4."</span>
        </div>";


        echo "
        <div class='form-group'>
            <label class='form-label'>5th Semester SPI:</label>
            <span class='form-value'>".$spi_5."</span>
        </div>";


        echo "
        <div class='form-group'>
            <label class='form-label'>6th Semester SPI:</label>
            <span class='form-value'>".$spi_6."</span>
        </div>";

        echo "
        <div class='form-group'>
            <label class='form-label'>7th Semester SPI:</label>
            <span class='form-value'>".$spi_7."</span>
        </div>";

        echo "
        <div class='form-group'>
            <label class='form-label'>8th Semester SPI:</label>
            <span class='form-value'>".$spi_8."</span>
        </div>";
        
        $url = "Resumes/".$id.'1.pdf';
        $text = "View Resume";
        echo "
        <div class='form-group'>
        <label class='form-label'><a href='$url'>$text</a></label><br><br>";

        $url1 = "Transcripts/".$id.'0.pdf';
        $text1 = "View Transcript";
        echo "  <div class='form-group'>
        <label class='form-label'><a href='$url1'>$text1</a></label><br>";



        


  
  
        

        

    ?>
    </body>
</html>