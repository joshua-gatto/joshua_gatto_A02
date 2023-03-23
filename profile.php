<!DOCTYPE html>
<html lang="en">
<head >
   <meta charset="utf-8">
   <title>Update SYSCBOOK profile</title>
   <link rel="stylesheet" href="assets/css/reset.css" />
   <link rel="stylesheet" href="assets/css/style.css" />
   <?php
   session_start();
   ?>
</head>
<body>
   <header>
      <h1>SYSCBOOK</h1>
      <p>Social media for SYSC students in Carleton University</p>
   </header>
   <main>
      <table>
         <tr>
            <td>
               <nav>
                  <ul>
                     <table class="sideBar">
                        <tr>
                           <td><li><a href="./index.php">Home</a></li></td>
                        </tr>
                        <tr id="current">
                           <td><li><a href="#">Profile</a></li></td>
                        </tr>
                        <tr>
                           <td><li><a href="./register.php">Register</a></li></td>
                        </tr>
                        <tr>
                           <td><li><a href="logOut.php">Log Out</a></li></td>
                        </tr>
                     </table>
                  </ul>
               </nav>
            </td>
            <td>
               <section>
                  <h2>Update Profile information</h2>
                  <form>
                     <fieldset>
                        <legend><p>Personal information</p></legend>
                        <table>
                           <tr>
                              <td>
                                 <label>First Name: </label>
                                 <input type="text" name="first_name"></input>
                              </td>
                              <td>
                                 <label>Last Name: </label>
                                 <input type="text" name="last_name"></input>
                              </td>
                              <td>
                                 <label>DOB: </label>
                                 <input type="date" name="DOB"></input>
                              </td>
                           </tr>
                        </table>
                     </fieldset>
                     <fieldset>
                        <legend><p>Address</p></legend>
                        <table>
                           <tr>
                              <td>
                                 <label>Street Number: </label>
                                 <input type="number" name="street_number">
                              </td>
                              <td>
                                 <label>Street Name: </label>
                                 <input type="text" name="street_name">
                              </td>
                              <td>
                                 <label>City: </label>
                                 <input type="text" name="city">
                              </td>
                           </tr>
                           <label>Province: </label>
                           <input type="text" name="provence">
                           <label>Postal Code: </label>
                           <input type="text" name="postal_code">
                        </table>
                     </fieldset>
                     <fieldset>
                        <legend><p>Profile Information</p></legend>
                        <table>
                           <tr>
                              <td>
                                 <label>Email Address: </label>
                                 <input type="email" name="student_email">
                              </td>
                           </tr>
                           <tr>
                              <td>
                                 <label>Program </label>
                                 <select name='program'>
                                    <option selected>Choose Program</option>
                                    <option value="Computer Systems Engineering">Computer Systems Engineering</option>
                                    <option value="Software Engineering">Software Engineering</option>
                                    <option value="Communications Engineering">Communications Engineering</option>
                                    <option value="Biomedical and Electrical Engineering">Biomedical and Electrical Engineering</option>
                                    <option value="Electrical Engineering">Electrical Engineering</option>
                                    <option value="Other">Special</option>
                                 </select>
                              </td>
                           </tr>
                           <tr>
                              <td>
                                 <label>Choose Avatar</label>
                              </td>
                           </tr>
                           <tr>
                              <td>
                                 <input type="radio" name="avatar" class="avatarSelect" value='A'>
                                 <img class="pfp" src="./images/img_avatar1.png" alt="Avatar 1">
                                 <input type="radio" name="avatar" class="avatarSelect" value='B'>
                                 <img class="pfp" src="./images/img_avatar2.png" alt="Avatar 2">
                                 <input type="radio" name="avatar" class="avatarSelect" value='C'>
                                 <img class="pfp" src="./images/img_avatar3.png" alt="Avatar 3">
                                 <input type="radio" name="avatar" class="avatarSelect" value='D'>
                                 <img class="pfp" src="./images/img_avatar4.png" alt="Avatar 4">
                                 <input type="radio" name="avatar" class="avatarSelect" value='E'>
                                 <img class="pfp" src="./images/img_avatar5.png" alt="Avatar 5">
                              </td>
                           </tr>
                           <tr>
                              <td>
                                 <td class="buttons"><button type='submit' name='submit' value='submit' formmethod='post' formaction=''>Submit</button></td>
                                 <td class="buttons"><button type="reset" formaction="reset.css">Reset</button></td>
                              </td>
                           </tr>
                        </table>
                     </fieldset>
                  </form>
                  <?php
                  if(isset($_POST["submit"])){
                     if(isset($_SESSION["user"])){
                        echo $_SESSION["user"]["student_ID"];
                     }
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
                                 if(!isset($_SESSION["user"])){
                                    $_SESSION["user"] = 
                                    array(
                                       "student_ID" => $student_ID,
                                       "student_email" => $email,
                                       "first_name" => $first_name,
                                       "last_name" => $last_name,
                                       "DOB" => $dob,
                                       "program" => $program,
                                       "street_num" => $street_num,
                                       "street_name" => $street_name,
                                       "city" => $city,
                                       "provence" => $provence,
                                       "postal_code" => $postal_code,
                                       "avatar" => $avatar,
                                    );
                                 }
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
               </section>
            </td>
         </tr>
      </table>
   </main>
</body>
</html>