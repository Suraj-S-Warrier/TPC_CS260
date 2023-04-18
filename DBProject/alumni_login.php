<?php
// Start the session
session_start();
?>
<html>
<head><link rel="stylesheet" href="reg.css"></head>
    <body>
    <div class="container">
        <h2>Alumni Login Page</h2>
        <form action="alumni_verify_login.php" method="POST">
            
        <label for="fname">Webmail: </label>
         <input type="email" name="webmail"><br>
         <label for="fname">Password: </label>
        <input type="password" name="pass"><br>
        <input type="submit" value="Login">
        </form>
    </body>
</html>
