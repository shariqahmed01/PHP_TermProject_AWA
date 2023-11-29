<?php
$dbusername = "root";
$password = "";
$dbname = "student_compass";
$servername = "localhost";
// Create connection
$conn = mysqli_connect($servername, $dbusername, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully <br>";
