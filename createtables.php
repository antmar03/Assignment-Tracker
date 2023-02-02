<?php
include "assignment_5_db.php";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
$errorsFound = 0;

if(!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
 }
 echo "Connection success!!";

 $sql = "CREATE TABLE IF NOT EXISTS course (
    course_id int(11) NOT NULL AUTO_INCREMENT,
    coursename varchar(100) NOT NULL,
    PRIMARY KEY (course_id)
    )CHARSET=utf8mb4";
    mysqli_query($conn, $sql);

$sql = "CREATE TABLE IF NOT EXISTS assignments (
    assignment_id int(11) NOT NULL AUTO_INCREMENT,
    assignment_name varchar(100) NOT NULL,
    coursename varchar(100) NOT NULL,
    assignment_due date NOT NULL,
    is_due int(11) NOT NULL,
    PRIMARY KEY (assignment_id)
    )CHARSET=utf8mb4";

    mysqli_query($conn, $sql);


 
