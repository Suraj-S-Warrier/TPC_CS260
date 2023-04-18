<?php
// Start the session
session_start();
?>
<html>
    <body>
        <?php
            
            
            // remove all session variables
            session_unset();

            // destroy the session
            session_destroy();
            echo 'Logged out successfully!';

            header("location:index.php");
            
        ?>
        <br>
        <a href="index.php">Welcome Page</a>
        
        
        
    </body>
</html>