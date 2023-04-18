<html>
    <body>
        <?php
            $conn = new mysqli("localhost:8080","root","1234","DBProj");
            $webmail=$_GET["email"];
            $code=$_GET["activation_code"]; 
            $sql="update Student set active=1 where activation_code='$code' and webmail='$webmail';";
            $result=$conn->query($sql);
            if($result)
            {
                echo "Account activated. Please go back to the login page.";
            }
        ?>
    </body>
</html>