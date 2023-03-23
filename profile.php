<!DOCTYPE html>
<html lang="en">
<head >
   <meta charset="utf-8">
   <title>Update SYSCBOOK profile</title>
   <link rel="stylesheet" href="assets/css/reset.css" />
   <link rel="stylesheet" href="assets/css/style.css" />
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
                           <td><li><a href="#">Log Out</a></li></td>
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
                                 <td class="buttons"><button type='submit' name='submit' value='submit' formmethod='post' formaction='./processProfile.php'>Submit</button></td>
                                 <td class="buttons"><button type="reset" formaction="reset.css">Reset</button></td>
                              </td>
                           </tr>
                        </table>
                     </fieldset>
                  </form>
               </section>
            </td>
         </tr>
      </table>
   </main>
</body>
</html>