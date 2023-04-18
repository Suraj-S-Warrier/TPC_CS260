<?php
// Start the session
session_start();
if(sizeof($_SESSION)==0)
{
    exit();
}

?> 


<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>jquery-multi-select</title>
    
    <link rel="stylesheet" type="text/css" href="example-styles.css">
    <link rel="stylesheet" type="text/css" href="demo-styles.css">
    <script type="text/javascript" src="jquery-2.2.4.min.js"></script>
    <script type="text/javascript" src="jquery.multi-select.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="div-center">
                <form class="demo-example" method = 'post'>
                <label for="people">Minimum CPI: </label><input type="number" min="0.00" max="10.00" step="0.01" name="cpi_req" defaultValue=<?php echo $_SESSION["cpi_req"] ?>>
                

                </select>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>