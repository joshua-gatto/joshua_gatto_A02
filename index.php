<!DOCTYPE html>
<html lang="en">
   <head >
      <meta charset="utf-8">
      <title>SYSCBOOK - Main</title>
      <link rel="stylesheet" href="assets/css/reset.css" />
      <link rel="stylesheet" href="assets/css/style.css" />
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
                              <td><li><a href="#">Log Out</a></li></td>
                           </tr>
                        </table>
                     </ul>
                  </nav>
               </td>
               <td>
                  <form method="post" action="./processPost.php">
                     <fieldset>
                        <legend>
                           <p>New Post</p>
                        </legend>
                        <table id="newPost">
                           <tr>
                              <td colspan="2"><textarea rows="4" cols="45" maxlength="500" placeholder="What's on your mind? (max 500 char)" name="text"></textarea></td>
                           </tr>
                           <tr>
                              <td><button type="submit" name="submit" method="post" formaction=''>Post</button></td>
                              <td><button type="reset" formaction="reset.css">Reset</button></td>
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
                        $text = mysqli_real_escape_string($conn, $_POST['text']);
                        $postQuery = "INSERT INTO users_posts(student_ID, new_post) VALUES (0, '$text');";
                        if(mysqli_query($conn, $postQuery)){
                              //print results
                        }else{
                           echo 'Error persisting user data, Error Code 1' . $conn->connect_error;
                        }
                        $conn->close();
                     }
                  }
                  ?>
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