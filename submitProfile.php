<?php
if(isset($_POST['submit'])){
    include("connection.php");

    define('DATABASE_LOCAL', 'localhost');
    define('DATABASE_NAME', 'joshua_gatto_syscbook');
    define('DATABASE_USER', 'root');
    define('DATABASE_PASSWD', '');

    $conn = new mysqli(DATABASE_LOCAL, DATABASE_USER, DATABASE_PASSWD, DATABASE_NAME);
    if ($conn->connect_error) {
        echo "Error";
        die("Connection failed: " . $conn->connect_error);
    }else{
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
        $dob = mysqli_real_escape_string($conn, $_POST['dob']);
        $email = mysqli_real_escape_string($conn, $_POST['student_email']);
        $program = mysqli_real_escape_string($conn, $_POST['program']);

        $infoQuery = "INSERT INTO user_info(student_email, first_name, last_name, DOB) VALUES ('$email', '$first_name', '$last_name', '$dob')";
        if (mysqli_query($conn, $infoQuery) === TRUE) {
            $student_ID = mysqli_insert_id($conn);
            $programQuery = "INSERT INTO user_program(student_ID, Program) VALUES ('$student_ID', '$program')";
            if(mysqli_query($conn, $programQuery) === TRUE){
                define("ZERO", 0);
                define("NULL", NULL);
                $addressQuery = "INSERT INTO user_address(student_ID, street_number, street_name, city, provence, postal_code) VALUES (ZERO, ZERO, NULL, NULL, NULL, NULL)";
                $avatarQuery = "INSERT INTO user_avatar(student_ID, avatar) VALUES('ZERO', 'NULL')";
                if(mysqli_query($conn, $addressQuery) === TRUE and mysqli_real_escape_string($conn, $avatarQuery) === TRUE){
                    echo 
                    '<!DOCTYPE html>
                    <html lang="en">
                    <head >
                    <meta charset="utf-8">
                        <title>Register on SYSCBOOK</title>
                        <link rel="stylesheet" href="assets/css/reset.css">
                        <link rel="stylesheet" href="assets/css/style.css">
                    </head>
                    <body><p>Done!</p>"</body>';
                }
            }
        }
    $conn->close();
    }
}
?>