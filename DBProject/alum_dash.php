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
                background-color: #f0f0f0;
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 600px;
                margin: 100px auto;
                padding: 20px;
                background-color: #ffffff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                text-align: center;
            }

            h1 {
                font-size: 36px;
                color: #333333;
                margin-top: 0;
                text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.1);
            }

            a {
                display: block;
                margin-bottom: 10px;
                color: #007bff;
                text-decoration: none;
                background-color: #f0f0f0;
                padding: 12px;
                border-radius: 5px;
                transition: background-color 0.3s ease-in-out;
            }

            a:hover {
                background-color: #007bff;
                color: #ffffff;
            }

            /* Animation for the links */
            @keyframes pulse {
                0% {
                    transform: scale(1);
                }
                50% {
                    transform: scale(1.05);
                }
                100% {
                    transform: scale(1);
                }
            }

            .animated-link {
                animation-name: pulse;
                animation-duration: 1s;
                animation-timing-function: ease-in-out;
                animation-iteration-count: infinite;
            }
        </style>
</head>
    <body><br>

    <div class="container">
    <?php
echo "<h1>Hi ".$_SESSION["rollno"]. "</h1>";
?>
        <a href="Alumni_Profile.php">Profile</a><br>
        <a href = "alumni_reg.php">Work Experience</a><br>
        <a href = "logout.php">Logout</a>
    </body>
</html>