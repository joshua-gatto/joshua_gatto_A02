<!DOCTYPE html>
<html lang="en">
<head >
   <meta charset="utf-8">
   <title>Register on SYSCBOOK</title>
   <link rel="stylesheet" href="assets/css/reset.css">
   <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
   <header>
      <h1>SYSCBOOK</h1>
      <p>Social media for SYSC students in Carleton University</p>
   </header>
   <nav>
   </nav>
   <main>
      <table>
         <tr>
            <td>
               <nav>
                  <table class="sideBar">
                     <ul>
                        <tr>
                           <td><li><a href="./index.php">Home</a></li></td>
                        </tr>
                        <tr>
                           <td><li><a href="./profile.php">Profile</a></li></td>
                        </tr>
                        <tr id="current">
                           <td><li><a href="#">Register</a></li></td>
                        </tr>
                        <tr>
                           <td><li><a href="logOut.php">Log Out</a></li></td>
                        </tr>
                     
                     </ul>
               </table>
               </nav>
            </td>
            <td>
               <section>
                  <h2>Register a new profile</h2>
                  <form formaction="" method="post">
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
                                 <td class="buttons"><button type='submit' name='submit' value='submit' formaction=''>Submit</button></td>
                                 <td class="buttons"><button type="reset" formaction="reset.css">Reset</button></td>
                              </td>
                           </tr>
                        </table>
                     </fieldset>
                  </form>
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
                        //collect data from user input
                        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
                        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
                        $dob = mysqli_real_escape_string($conn, $_POST['DOB']);
                        $email = mysqli_real_escape_string($conn, $_POST['student_email']);
                        $program = mysqli_real_escape_string($conn, $_POST['program']);
                        //form first query
                        $infoQuery = "INSERT INTO users_info(student_email, first_name, last_name, DOB) VALUES ('$email', '$first_name', '$last_name', '$dob');";
                        //submit first query
                        if (mysqli_query($conn, $infoQuery) === TRUE) {
                              //get generated ID
                              $student_ID = mysqli_insert_id($conn);
                              //generate remaining queries
                              $programQuery = "INSERT INTO users_program(student_ID, Program) VALUES ('$student_ID', '$program');";
                              $addressQuery = "INSERT INTO users_address(student_ID, street_number, street_name, city, provence, postal_code) VALUES ('$student_ID', 0, NULL, NULL, NULL, NULL);";
                              $avatarQuery = "INSERT INTO users_avatar(student_ID, avatar) VALUES('$student_ID', NULL);";
                              //submit remaining queries
                              if(mysqli_query($conn, $programQuery) === TRUE and mysqli_query($conn, $addressQuery) === TRUE and mysqli_query($conn, $avatarQuery) === TRUE){
                                 //print results
                              }else{
                                 echo 'Error persisting user data, Error Code 1' . $conn->connect_error;
                              }
                        }else{
                              echo 'Error persisting user data, Error Code 2' . $conn->connect_error;
                        }
                     $conn->close();
                     }
                  }
                  ?>
               </section>
            </td>
         </tr>
      </table>
   </main>
</body>
</html>