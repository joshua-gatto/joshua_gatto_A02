<?php
    $session_query = "SELECT student_ID, session_ID FROM users_session WHERE session_ID='$_COOKIE[session_ID]';";
    $result = mysqli_query($conn, $session_query);
    if($result){
        $retrieve_query = 
        "SELECT *
        FROM users_info
        JOIN users_program ON users_info.student_ID = users_program.student_ID
        JOIN users_avatar ON users_info.student_ID = users_avatar.student_ID
        JOIN users_address ON users_info.student_ID = users_address.student_ID
        WHERE users_info.student_ID = ". mysqli_fetch_assoc($result)["student_ID"] .";";
        $user_details = mysqli_query($conn, $retrieve_query);
        if (mysqli_num_rows($user_details) > 0) {
            $row = mysqli_fetch_assoc($user_details);
            $_SESSION["user"] = array(
            "student_ID" => $row["student_ID"],
            "student_email" => $row["student_email"],
            "first_name" => $row["first_name"],
            "last_name" => $row["last_name"],
            "DOB" => $row["DOB"],
            "program" => $row["Program"],
            "street_num" => $row["street_number"],
            "street_name" => $row["street_name"],
            "city" => $row["city"],
            "provence" => $row["provence"],
            "postal_code" => $row["postal_code"],
            "avatar" => $row["avatar"]
            );
        }
    }
?>