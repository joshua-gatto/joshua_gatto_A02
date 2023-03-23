<?php
if(isset($_POST["submit"])){
    include("connection.php");

    define("DATABASE_LOCAL", "localhost");
    define("DATABASE_NAME", "joshua_gatto_syscbook");
    define("DATABASE_USER", "root");
    define("DATABASE_PASSWD", "");

    $conn = new mysqli(DATABASE_LOCAL, DATABASE_USER, DATABASE_PASSWD, DATABASE_NAME);
    if ($conn->connect_error) {
        echo "Error";
        die("Connection failed: " . $conn->connect_error);
    }else{
        //personal information
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
        $dob = mysqli_real_escape_string($conn, $_POST['DOB']);
        //Address
        $street_num = mysqli_real_escape_string($conn, $_POST['street_number']);
        $street_name = mysqli_real_escape_string($conn, $_POST['street_name']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $provence = mysqli_real_escape_string($conn, $_POST['provence']);
        $postal_code = mysqli_real_escape_string($conn, $_POST['postal_code']);
        //Profile Information
        $email = mysqli_real_escape_string($conn, $_POST['student_email']);
        $program = mysqli_real_escape_string($conn, $_POST['program']);
        $avatar = mysqli_real_escape_string($conn, $_POST['avatar']);
        //form first query
        $infoQuery = "INSERT INTO users_info(student_email, first_name, last_name, DOB) VALUES ('$email', '$first_name', '$last_name', '$dob');";
        //submit first query
        if (mysqli_query($conn, $infoQuery) === TRUE) {
            //get generated ID
            $student_ID = mysqli_insert_id($conn);
            //generate remaining queries
            $programQuery = "INSERT INTO users_program(student_ID, Program) VALUES ('$student_ID', '$program');";
            $addressQuery = "INSERT INTO users_address(student_ID, street_number, street_name, city, provence, postal_code) VALUES ('$student_ID', '$street_num', '$street_name', '$city', '$provence', '$postal_code');";
            $avatarQuery = "INSERT INTO users_avatar(student_ID, avatar) VALUES('$student_ID', '$avatar');";
            //submit remaining queries
            if(mysqli_query($conn, $programQuery) === TRUE and mysqli_query($conn, $addressQuery) === TRUE and mysqli_query($conn, $avatarQuery) === TRUE){
                //print results
            }else{
                echo 'Error persisting user data, Error Code 1' . $conn->connect_error;
            }
        }else{
            echo 'Error persisting user data, Error Code 2' . $conn->connect_error;
        }
    }
    $conn->close();
}
?>