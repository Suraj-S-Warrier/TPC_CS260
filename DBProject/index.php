<!DOCTYPE html>
<html>
    <head>
        <title>Registration and Login Portal</title>
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
    <body>
        <div class="container">
            <h1>Welcome!</h1>
            <!-- <a href="StudentReg.php" class="animated-link">Student Register</a> -->
            <!-- <a href="Company_Reg.php" class="animated-link">Company Register</a> -->
            <a href="Stud_Login.php" class="animated-link">Student Login</a>
            <a href="Comp_Login.php" class="animated-link">Company Login</a>
            <a href="alumni_login.php" class="animated-link">Alumni Login</a>
            <a href="Admin_Login.php" class="animated-link">Admin Login</a>
        </div>

        <script>
            // JavaScript code can be added here if needed
        </script>
    </body>
</html>
