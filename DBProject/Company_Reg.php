<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="reg.css">
    
    <link rel="stylesheet" type="text/css" href="example-styles.css">
    <link rel="stylesheet" type="text/css" href="demo-styles.css">
    <script type="text/javascript" src="jquery-2.2.4.min.js"></script>
    <script type="text/javascript" src="jquery.multi-select.js"></script>
</head>
    <body>
        <div class = "container">
        <h2><b>Company Registration</b></h2><br><br>
        <form action="Comp_Reg_verify.php" method="post">
        <label for="fname">Company Name: </label>
        <input type="text" name="company_name"><br>
            <label>Hiring:</label> <select name="hiring">
                <option value="yes" selected>YES</option>
                <option value="no">NO</option>
            </select><br>
        
            <label for="fname">Email: </label>
            <input type="email" name="email"><br>

            <label for="fname">Contact No: </label>
            <input type="text" name="contact"><br>

            <label for="fname">Password: </label>
            <input type="password" name="pass"><br>

            <label for="fname">Confirm Password: </label>
            <input type="password" name="confirmpass"><br>
            
            
        <input type="submit" value="Register">
        </form>

    </body>
</html>
