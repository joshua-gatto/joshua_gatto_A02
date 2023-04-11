<!DOCTYPE html>
<html lang="en">
   <head >
      <meta charset="utf-8">
      <title>SYSCBOOK - Main</title>
      <link rel="stylesheet" href="assets/css/reset.css" />
      <link rel="stylesheet" href="assets/css/style.css" />
      <?php
         if(isset($_POST["post_submit"]) && isset($_COOKIE["session_ID"])){
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
               if(isset($_SESSION["user"])){
                  $student_ID = $_SESSION['user']['student_ID'];
                  $text = mysqli_real_escape_string($conn, $_POST['text']);
                  $postQuery = "INSERT INTO users_posts(student_ID, new_post) VALUES ('$student_ID', '$text');";
                  if(mysqli_query($conn, $postQuery)){
                     $postQuery = "SELECT post_ID, new_post FROM users_posts WHERE student_ID='$student_ID' ORDER BY post_date LIMIT 5";
                     $posts = mysqli_query($conn, $postQuery);
                     if(mysqli_num_rows($posts) > 0){
                        foreach($posts as $post){
                           echo
                           "<div class='postDiv'> <!-- Replace with Tables if time permits -->
                           <details open>
                              <Summary>Post ". $post["post_ID"] ."</Summary>
                              ". $post["new_post"] ."
                           </details>
                        </div>";
                        }
                     }
                  }else{
                     echo 'Error persisting user data, Error Code 1' . $conn->connect_error;
                  }
               }
               $conn->close();
            }
         }
      ?>
   </head>
   <body>
      <header>
         <h1>SYSCBOOK</h1>
         <p>Social media for SYSC students in Carleton University</p>
      </header>
      <main>
         <table class="sideBar">
            <tr>
               <td rowspan="2">
                  <nav>
                     <ul>
                        <table class="sideBar">
                           <tr id="current">
                              <td><li><a href="#">Home</a></li></td>
                           </tr>
                           <tr>
                              <td><li><a href="./profile.php">Profile</a></li></td>
                           </tr>
                           <tr>
                              <td><li><a href="./register.php">Register</a></li></td>
                           </tr>
                           <tr>
                              <td><li><a href="./logOut.php">Log Out</a></li></td>
                           </tr>
                        </table>
                     </ul>
                  </nav>
               </td>
               <td>
                  <form method="post" action="">
                     <fieldset>
                        <legend>
                           <p>New Post</p>
                        </legend>
                        <table id="newPost">
                           <tr>
                              <td colspan="2"><textarea rows="4" cols="45" maxlength="500" placeholder="What's on your mind? (max 500 char)" name="text"></textarea></td>
                           </tr>
                           <tr>
                              <td><button type="submit" name="post_submit" value="post_submit" method="post" formaction=''>Post</button></td>
                              <td><button type="reset" formaction="reset.css">Reset</button></td>
                           </tr>
                        </table>
                     </fieldset>
                  </form>
               </td>
            </tr>
            <tr class="posts">
               <td>
                  <section>
                     <table>   
                        <div class="postDiv"> <!-- Replace with Tables if time permits -->
                           <details open>
                              <Summary>Post 1</Summary>
                              Geophagy, or the practice of eating dirt, may sound strange to some, but it has been practiced by people all over the 
                              world for centuries. While it may seem like an unhealthy habit, there are actually numerous health benefits associated 
                              with eating dirt. In this post, we'll explore the practice of geophagy and why people choose to consume soil.
                           </details>
                        </div>
                        <div class="postDiv">
                           <details open>
                              <summary>Post 2</summary>
                                 Many cultures have incorporated eating dirt into their traditional diets for generations, and for good reason. Dirt is 
                                 actually a source of essential minerals, including iron, calcium, and magnesium. These minerals play important roles in 
                                 maintaining good health, from building strong bones to supporting the immune system. In this post, we'll delve into the 
                                 specific nutritional benefits of consuming dirt, and how it can support overall health.
                           </details>
                        </div>
                        <div class="postDiv">
                           <details open>
                              <summary>Post 3</summary>
                              While eating dirt may seem unsanitary, it is a practice that has been researched and documented by scientists. Recent 
                              studies have shown that soil consumption can improve gut health, prevent nutrient deficiencies, and even help to fight 
                              infections. In this post, we'll examine the scientific evidence behind the health benefits of geophagy and explore why 
                              this practice may be worth considering.<br>It's important to note that eating dirt can also pose health risks, as some 
                              soil may contain harmful pathogens or toxins. As such, it is recommended to only consume soil that is known to be safe and 
                              free from contaminants. Additionally, it's always a good idea to talk to a doctor or healthcare professional before making 
                              any changes to your diet.
                           </details>
                        </div>
                     </table>
                  </section>
               </td>
            </tr>
         </table>
      </main>
   </body>
</html>