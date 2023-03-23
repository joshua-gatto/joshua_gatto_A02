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
        $conn->close();
        $text = mysqli_real_escape_string($conn, $_POST['text']);

        $postQuery = "INSERT INTO user_posts(student_ID, new_post) VALUES (0, '$text');";
        if(mysqli_query($conn, $postQuery)){
            //print results
            echo 
            "<!DOCTYPE html>
            <html lang='en'>
            <head>
            <meta charset='utf-8'>
                <title>Register on SYSCBOOK</title>
                <link rel='stylesheet' href='assets/css/reset.css'>
                <link rel='stylesheet' href='assets/css/style.css'>
            </head>
            <body><p>Done!</p></body>";
        }else{
            
        }
    }
}
?>