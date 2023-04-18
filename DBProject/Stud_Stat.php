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
    <title>STATS PAGE: </title>
    
    <link rel="stylesheet" type="text/css" href="example-styles.css">
    <link rel="stylesheet" type="text/css" href="demo-styles.css">
    <script type="text/javascript" src="jquery-2.2.4.min.js"></script>
    <script type="text/javascript" src="jquery.multi-select.js"></script>

    <style>
        /* Table styles */
        #stats {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
        }
        #stats th {
            background-color: #f2f2f2;
            color: #333;
            font-weight: bold;
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        #stats td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        #stats tr:hover {
            background-color: #f9f9f9;
        }

        /* Pagination styles */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 16px;
        }
        .pagination a {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            margin: 0 4px;
            border-radius: 4px;
        }
        .pagination a:hover {
            background-color: #45a049;
        }
        .pagination a:disabled {
            background-color: #ddd;
            color: #777;
            cursor: default;
        }

        .form-container {
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #f2f2f2;
  padding: 60px;
}

.demo-example {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  max-width: 800px;
  width: 100%;
}

.form-row {
  display: flex;
  flex-direction: column;
  margin-right: 20px;
}

label {
  margin-bottom: 10px;
}

input[type="submit"] {
  margin-top: 20px;
  padding: 10px;
  border-radius: 5px;
  border: none;
  background-color: #4CAF50;
  color: white;
  cursor: pointer;
  font-size: 16px;
}

input[type="submit"]:hover {
  background-color: #3e8e41;
}

.b{
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

    </style>
</head>
<body>
<?php 
    $conn = new mysqli("localhost:8080","root","1234","DBProj");
    $page = isset($_GET["page"]) ? $_GET["page"] : 1;

// Calculate the starting row number based on the current page and limit
$limit = 5; // Number of rows to display per page
$start = ($page - 1) * $limit;
    if(isset($_POST["company"]))
    {
        $_SESSION["current_comp"]=$_POST["company"];
    }
    else if(!isset($_SESSION["current_comp"]))
    {
        
        $sql="select company_name from Company;";
        $result=$conn->query($sql);
        $_SESSION["current_comp"]=[];
        while($row=$result->fetch_assoc())
        {
            array_push($_SESSION["current_comp"],$row["company_name"]);
        }
        
    }
    
    if(isset($_POST["from"]))
    {
        $_SESSION["current_from"]=$_POST["from"];
    }
    else if(!isset($_SESSION["current_from"]))
    {
        $_SESSION["current_from"]=2012;
    }
    if(isset($_POST["to"]))
    {
        $_SESSION["current_to"]=$_POST["to"];
    }
    else if(!isset( $_SESSION["current_to"]))
    {
        $_SESSION["current_to"]=idate("Y");
    }
    if(isset($_POST["orderby"]))
    {
        $_SESSION["current_orderby"]=$_POST["orderby"];
    }
    else if(!isset($_SESSION["current_orderby"]))
    {
        $_SESSION["current_orderby"]="CTC";
    }

?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="div-center">
    <form class="demo-example" method = 'post'>
        <label for="people">Select Company:</label>
        <select id="people" name = 'company[]' multiple size = 6 multiple id="dd" class="form-control">
            <?php 
                $flag=0;
                foreach($_SESSION["current_comp"] as $c3)
                {
                    //echo $c3."<br>";
                    if($c3==1)
                    {
                        $flag=true;
                        break;

                    }
                }
                echo "<option value='1'". ($flag?" selected":" ").">Select All</option>";
                $_SESSION["selectAllFlag"]=$flag;
            ?>
            <?php 
                $conn = new mysqli("localhost:8080","root","1234","DBProj");
                $sql="select company_name from Company;";
                $result=$conn->query($sql);
                $flg2=$_SESSION["selectAllFlag"];
                while($row=$result->fetch_assoc())
                {
                    $c1 = $row["company_name"];
                    $c2 = $_SESSION["current_comp"];
                    $flag = false;
                    foreach($c2 as $c3)
                    {
                        //echo $c3."<br>";
                        if($c1==$c3)
                        {
                            $flag=true;
                            break;

                        }
                    }
                    echo "<option value='$c1' " . ($flag&&(!$flg2) ? 'selected' : '') . ">$c1</option>";
                }
            ?>
        </select>

        <label for="people">From: </label>
        <select name="from" id="cars">
            <?php 
                $year=2012;
                while($year<=idate("Y"))
                {
                    $flag=false;
                    if($_SESSION["current_from"]==$year)
                    {
                        $flag=true;
                    }
                    echo "<option value=$year".($flag ?' selected':'')." >$year</option>";
                    $year++;
                }
            ?>
        </select>
        <br><br>

        <label for="people">To: </label>
        <select name="to" id="cars">
            <?php 
                $year=2012;
                while($year<=idate("Y"))
                {
                    $flag=false;
                    if($_SESSION["current_to"]==$year)
                    {
                        $flag=true;
                    }
                    echo "<option value=$year".($flag ?' selected':'')." >$year</option>";
                    $year++;
                }
            ?>
        </select>
        <br><br>

        <label for="people">Order By: </label>
        <select name="orderby" id="cars">
            <option value="CTC" <?php echo $_SESSION["current_orderby"]=="CTC"?' selected':' '?>>Highest CTC</option>
            <option value="Placements" <?php echo $_SESSION["current_orderby"]=="Placements"?' selected':' '?>>Highest Placements</option>
            <option value="branch" <?php echo $_SESSION["current_orderby"]=="branch"?' selected':' '?>>Branch Wise</option>

        </select>


        <input type = 'submit' name = 'submit' value = Search>
    </form>
	
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

<?php 
    $all_branches=array("CS","AI","MNC","EE","CB","PH","CE","ME");
    $conn = new mysqli("localhost:8080","root","1234","DBProj");
    if($conn->connect_error){
        die("connection failed".$conn->connect_error."\n");
        exit();

    }
    if((isset($_POST["company"]) && $_POST["company"][0]=="1") || !isset($_POST["company"]))
    {
        $sql="select company_name from Company;";
        $result=$conn->query($sql);
        unset($_SESSION["company"]);
        $_SESSION["company"]=[];
        while($row=$result->fetch_assoc()){
            $el = $row["company_name"];
            array_push($_SESSION["company"],$el);
        }
        $_POST["company"] = $_SESSION["company"];
    }
    if(!isset($_POST["from"]))
    {
        $_POST["from"]=2018;
    }
    if(!isset($_POST["to"]))
    {
        $_POST["from"]=date("Y");
    }
    if(!isset($_POST["orderby"]))
    {
        $_POST["orderby"]="CTC";
    }
    if(!isset($_POST["company"]) && !isset($_POST["from"]) && !isset($_POST["to"]) && !isset($_POST["orderby"]))
    {
        // $sql= "create table intermediate as select * from Recruitment_History order by recruitment_year desc; ";
        // $result=$conn->query($sql);
        $sql = "select company_name,recruitment_year, count(rollno) from Recruitment_History group by company_name, recruitment_year LIMIT 5;";
        $result=$conn->query($sql);
        
        while($row=$result->fetch_assoc())
        {
            echo $row["company_name"]."   ".$row["recruitment_year"]."   ".$row["count(rollno)"]."<br>";
        }
        // $sql = "drop table intermediate;";
        // $result=$conn->query($sql);

    }
    else if(isset($_POST["orderby"]))
    {   
        
        // $sql= "create table intermediate as select * from Recruitment_History order by recruitment_year desc; ";
        // $result=$conn->query($sql);
        if($_POST["orderby"]=="Placements")
        {
            $sql =   "select company_name,recruitment_year, count(rollno) from Recruitment_History ";
        }
        elseif($_POST["orderby"]=="CTC")
        {
            $sql = "select rollno, company_name,CTC,recruitment_year from Recruitment_History";
        }
        else if($_POST["orderby"]=="branch")
        {
            $sql =   "select company_name,recruitment_year, count(rollno) from Recruitment_History natural join Common ";
        }
        $z=0;
        $z1=0;
        if(isset($_POST["company"]) || (isset($_POST["from"]) && isset($_POST["to"])))
        {
            
            if(count($_POST["company"])>0)
            {
                $z=1;

                $sql .=" where company_name in ( ";
                for($x=0;$x<count($_POST["company"]);$x++)
                {
                    $y=$_POST["company"][$x];
                    if($x==0)
                    {
                        $sql .= "'$y'";
                    }
                    else{
                        $sql .= ", '$y'";
                    }
                    
                }
                $sql .= ") ";
            }
            if(isset($_POST["from"]) && isset($_POST["to"]))
            {
                $z1=1;
                $c1=$_POST["from"];
                $c2=$_POST["to"];
                if($z==1)
                {
                    $sql .=" and "; 
                }
                else
                {
                    $sql .=" where ";
                }
                $sql .="recruitment_year between $c1 and $c2 ";
                

            }
        }

        if($_POST["orderby"]=="Placements"){
            $sql1 = $sql;
            $sql .=" group by company_name, recruitment_year;";
            $sql1 .=" group by company_name, recruitment_year LIMIT $start, $limit;";
        }
        elseif($_POST["orderby"]=="CTC"){

            $sql2 = $sql;
            $sql .= " order by CTC desc ;";
            $sql2 .= " order by CTC desc LIMIT $start, $limit;";
        }
        elseif($_POST["orderby"]=="branch")
        {
            foreach($all_branches as $br)
            {
                if($z!=0 || $z1!=0)
                {
                    $sql1=$sql." and spec='$br' group by company_name;";
                    

                }
                else
                {
                    $sql1=$sql."where spec='$br' group by company_name;";
                }
                $result=$conn->query($sql1);
                echo "<h1>".$br."</h1><br>";
                echo "<table id = stats>";
                echo "<tr><th>Company Name</th><th>Year of Recruitment</th><th>Number of Students hired</th></tr>";
                while($row=$result->fetch_assoc())
                {
                    $comp=$row["company_name"];
                    $rec_year=$row["recruitment_year"];

    
                    echo "<tr><td><a href='ExpandCompanyDet2.php?company=$comp&year=$rec_year&branch=$br'>".$row["company_name"]."</a></td><td>".$row["recruitment_year"]." </td><td>".$row["count(rollno)"]."</td></tr><br>";
                   
                }
                echo "</table><br>";

            }
            
        }
        //echo $sql."<br>";
        
        $result = $conn->query($sql);
        $total_rows = $result->num_rows;

        
        if($_POST["orderby"]=="Placements")
        {   

            $result = $conn->query($sql1);
            echo "<table id = stats>";
            echo "<tr><<th>Company Name</th><th>Year of Recruitment</th><th>Number of Students hired</th></tr>";
 
            

            while($row=$result->fetch_assoc())
            {
                if($_POST["orderby"]=="Placements"){
                    $comp=$row["company_name"];
                    $rec_year=$row["recruitment_year"];
    
                    echo "<tr><td><a href='ExpandCompanyDet.php?company=$comp&year=$rec_year'>".$row["company_name"]."</a></td><td>".$row["recruitment_year"]."</td><td>".$row["count(rollno)"]."</td></tr></a><br>";
                }
                
                
            }

            $total_pages = ceil($total_rows / 5);

            // Display navigation buttons
            echo "<button onclick='prevPage()'><</button>";
            echo "<button onclick='nextPage()'>></button>";
            echo "<script>
                var currentPage = $page;
                var totalPages = $total_pages;
                function prevPage() {
                    console.log('$total_pages');
                    if (currentPage > 1) {
                        currentPage--;
                        window.location.href = 'Stud_Stat.php?page=' + ($page - 1); // Replace your_page_name.php with your actual page name
                    }
                }
                function nextPage() {
                    console.log('$total_pages');
                    if (currentPage < totalPages) {
                        currentPage++;
                        window.location.href = 'Stud_Stat.php?page=' + ($page + 1); // Replace your_page_name.php with your actual page name
                    }
                }
            </script>";
        }
        elseif($_POST["orderby"]=="CTC")
        {   
            $result = $conn->query($sql2);
            echo "<table id = stats>";
            echo "<tr><<th>Roll No</th><th>Company Name</th><th>CTC</th><th>Year of Recruitment</th></tr>";
            while($row=$result->fetch_assoc())
            {
            $roll = $row["rollno"];
            echo "<tr><td><a href='Alumnus_Profile.php?id=$roll'>".$row["rollno"]."</a></td><td>".$row["company_name"]."</td><td> ".$row["CTC"]."</td><td>".$row["recruitment_year"]."</td></tr></a><br>";
            }

            $total_pages = ceil($total_rows / 5);

            // Display navigation buttons
            echo "<button onclick='prevPage()'><</button>";
            echo "<button onclick='nextPage()'>></button>";
            echo "<script>
                var currentPage = $page;
                var totalPages = $total_pages;
                function prevPage() {
                    if (currentPage > 1) {
                        currentPage--;
                        window.location.href = 'Stud_Stat.php?page=' + ($page - 1);; // Replace your_page_name.php with your actual page name
                    }
                }
                function nextPage() {
                    console.log('$total_pages');

                    if (currentPage < totalPages) {
                        currentPage++;
                        window.location.href = 'Stud_Stat.php?page=' + ($page + 1); // Replace your_page_name.php with your actual page name
                    }
                }
            </script>";
        }


        
        echo "</table>";
        // Previous and Next buttons

        // $sql = "drop table intermediate;";
        // $result=$conn->query($sql);
    
    }
    
?>
<br><a href="Stud_dashboard.php"><button class = "b">Dashboard</button></a>
  
    </body>
</html>