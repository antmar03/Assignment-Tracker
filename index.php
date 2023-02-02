<?php
include "assignment_5_db.php";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
$showDue = true;


if(isset($_POST['button'])) {
    $showDue = !$_GET['showDue'];
    header("Location: index.php?showDue=$showDue");
    
}

  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">


    <title>Document</title>
</head>
<body>

<div class = "head">
    <h1>IT Programming Assignment Tracker:</h1>
    <h3>Designed and Developed by Anthony Marcellino</h3>
</div>

<script type="text/javascript">

</script>

<div class = "toggle">
    <form method="post">
        <input name = "button" type="submit" class="btn btn-custom" value = "Toggle Overdue Assignments" />
    </form>
</div>



<table class="table">
    <thead>
        <tr>
            <th scope="col">Assignment Name</th>
            <th scope="col">Course</th>
            <th scope="col">Due Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $showDue = false;

            if(isset($_GET['showDue'])){
                $showDue = $_GET['showDue'];
            }

            if($showDue) {
                $sql = "SELECT * FROM assignments ORDER BY assignment_due ASC";
            }else{
                $sql = "SELECT * FROM assignments WHERE assignment_due >= CURDATE() ORDER BY assignment_due ASC";
            }
            
            $results = mysqli_query($conn, $sql);
            
            // Process Records //

            while($row = mysqli_fetch_assoc($results)) {
                $assignmentName = $row['assignment_name'];
                $course = $row['coursename'];
                $assignment_due = $row['assignment_due'];
                $date_now = date("Y-m-d");
                $styles = "";

                //if overdue highlight in red
                if($date_now > $assignment_due) {
                    $styles = "style='background-color: #8F1300'";
                }
                
                switch($course) {
                    case "PROG2400":
                        $course = "Data Structures";
                    break;
                    case "PROG2500":
                        $course = "Windows Programming";
                    break;
                    case "COMM4700":
                        $course = "Communications";
                    break;
                    case "PROG3017":
                        $course = "Full Stack";
                    break;
                    case "MOBI3001":
                        $course = "IOS Development";
                    break;

                }
                
                
                
                echo "<tr $styles>";
                echo "<th scope='row'>$assignmentName</th>";
                echo "<td>$course</td>";
                echo "<td>$assignment_due</td>";
                echo "</tr>";
            }

            mysqli_close($conn);
        ?>
        

    </tbody>
</table>

   



    <!-- Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js " integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj " crossorigin="anonymous "></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js " integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN " crossorigin="anonymous "></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js " integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV " crossorigin="anonymous "></script>
</body>
</html>