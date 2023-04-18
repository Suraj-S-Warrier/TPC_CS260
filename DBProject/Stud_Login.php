<?php
// Start the session
session_start();
?>
<html>
    <head>
    <link rel="stylesheet" href="reg.css">
    <style>.b{
    margin-top: 20px;
  padding: 10px;
  border-radius: 5px;
  border: none;
  background-color: #4CAF50;
  color: white;
  cursor: pointer;
  font-size: 16px;
  color: white;
}
.b:hover {
  background-color: #3e8e41;
}

.cont{
    text-decoration: none;
    color: white;
}
</style>
    </head>
    <body>
    <div class="container">
        <h2>Student Login Page</h2>
        <form action="Stud_Login_verify.php" method="POST">
        <label for="fname">Webmail:</label>
        <input type="email" name="webmail"><br>
        <label for="fname">Password:</label>
        <input type="password" name="pass"><br>
            <input type="submit" value="Login">
            
        </form>
        <button class = "b"><a href="StudentReg.php" class="cont">Click here to Register</a>
    </body>
</html>