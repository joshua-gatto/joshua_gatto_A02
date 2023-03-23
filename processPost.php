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
        echo 'Error persisting user data, Error Code 2' . $conn->connect_error;
        $conn->close();
    }
}
?>