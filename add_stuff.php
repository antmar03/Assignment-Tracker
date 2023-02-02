<?php 
include "assignment_5_db.php";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

$assignErrors = 0;

//Assignment Form
if(!isset($_POST['assignment-name']) || empty($_POST['assignment-name'])) $assignErrors++;
if(!isset($_POST['as-course-name']) || empty($_POST['as-course-name'])) $assignErrors++;
if(!isset($_POST['assignment-due']) || empty($_POST['assignment-due'])) $assignErrors++;
echo $assignErrors;

if($assignErrors == 0) {
    $assignmentName = $_POST['assignment-name'];
    $courseName = $_POST['as-course-name'];
    $due = strtotime($_POST['assignment-due']);
    $due = date('Y-m-d H:i:s', $due);

    $sql = "INSERT INTO assignments
    (assignment_name, coursename, assignment_due)
    
    VALUES ('$assignmentName','$courseName','$due')
    ";

    echo "Hgh";
    mysqli_query($conn, $sql);  
}

//Course Form

if(isset($_POST['course-name']) && !empty($_POST['course-name'])) {
    $course = $_POST['course-name'];
    $sql = "INSERT INTO course
    (coursename)
    
    VALUES ('$course')
    ";
    mysqli_query($conn, $sql);  
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
    <div class = "container-fluid">
        <div class="row justify-content-center">
            <div class = "col-xl-5">
                <form method="post">
                    <div class="form-group">
                        <label for="assignment-name">Assignment Name:</label>
                        <input type="text" class="form-control" id="assignment-name" name="assignment-name">
                    </div>
                    <div class="form-group">
                        <label for="as-course-name">Course Name:</label>
                        <select class="form-control" id="as-course-name" name="as-course-name">
                        <?php
                                
                                $sql = "SELECT * FROM course";
                                $results = mysqli_query($conn, $sql);
                                
                                // Process Records //

                                while($row = mysqli_fetch_assoc($results)) {
                                    $courseName = $row['coursename'];

                                    echo "<option value='$courseName'>$courseName</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="assignment-due">Assignment Due:</label>
                        <input type="date" class="form-control" id="assignment-due" name="assignment-due">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class = "col-xl-5">
            <form method="post">
                <div class="form-group">
                    <label for="course-name">Course Name:</label>
                    <input type="text" class="form-control" id="course-name" name="course-name">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
   



    <!-- Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js " integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj " crossorigin="anonymous "></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js " integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN " crossorigin="anonymous "></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js " integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV " crossorigin="anonymous "></script>
</body>
</html>

<?php 
mysqli_close($conn);?>