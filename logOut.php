<?php
if(isset($_SESSION["user"])){
    unset($_SESSION["user"]);
    session_destroy();
    include("index.php");
}else{
    echo $_SESSION["user"];
    include("profile.php");
}
?>