<?php 
session_start();
if(sizeof($_SESSION)==0)
{
    exit();
}
?>
<html>
    
<head>
    <meta charset="utf-8">
    <title>jquery-multi-select</title>
    <link rel="stylesheet" href="reg.css">
    <link rel="stylesheet" type="text/css" href="example-styles.css">
    <link rel="stylesheet" type="text/css" href="demo-styles.css">
    <script type="text/javascript" src="jquery-2.2.4.min.js"></script>
    <script type="text/javascript" src="jquery.multi-select.js"></script>
    <style>.b{
    margin-top: 20px;
  padding: 10px;
  border-radius: 5px;
  border: none;
  background-color: #4CAF50;
  color: white;
  cursor: pointer;
  font-size: 16px;
}
.b:hover {
  background-color: #3e8e41;
}
a{
    color: white;
    text-decoration: none;
}
</style>
</head>
    <body>
        <div class = "container">
        <h2><font size = "10">Post Job Roles</font></h2><br><br>
        <form method="POST" action="post_job_verify.php">
            <label>Position:</label><input type="text" name="position"><br>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="div-center">
                            <label for="people">Branches Required:</label>
                            <select id="people" name = 'branches_req[]' multiple size = 6 multiple id="dd" class="form-control">
                                <option value="ALL" selected>Select All</option>
                                <option value="CS">CS</option>
                                <option value="AI">AI</option>
                                <option value="MNC">MNC</option>
                                <option value="EE">EE</option>
                                <option value="PH">PH</option>
                                <option value="CB">CB</option>
                                <option value="CE">CE</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
                
            <script type="text/javascript">
                $(function(){
                    $('#people').multiSelect();
                });
            </script>
            <script type="text/javascript">
            $('#people').multiselect({
                columns: 1,
                placeholder: 'Select Languages',
                search: true,
                selectAll: true
            });
            </script>
            Minimum CPI required:<input type="number" min="0.00" max="10.00" step="0.01" name="cpi_req"><br>
            <label>Minimum Batch of Students recruiting:</label><select name="min_passout_year">
                <option value=<?php echo idate("Y")?> selected>4th Year</option>
                <option value=<?php echo idate("Y")+1?>>3th Year</option>
                <option value=<?php echo idate("Y")+2?>>2nd Year</option>
                <option value=<?php echo idate("Y")+3?>>1rst Year</option>
            </select><br>
            Minimum 12th marks required:<input type="number" min="0.00" max="500.00" step="0.01" name="marks_req"><br>
            Mode of Interview: <select name="wr_interview">
                <option value="1">Written</option>
                <option value="0">Interview</option>
            </select>
            <select name="on_off">
                <option value="1">Online</option>
                <option value="0">Offline</option>
            </select>
            <br>
            Package offered: <input type="number" name="package_offered"><br>
            <input type="submit" value="POST">


        </form><br>
        <center>
        <button class = "b"><a href="Comp_Dashboard.php">Back to Dashboard</a>
        </center>
    </body>
</html>