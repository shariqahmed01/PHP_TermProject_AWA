 <!DOCTYPE html>
 <?php require_once 'core.php';
  require_once 'connection.php'; ?>
 <html lang="en">

 <head>
   <title>Sign Up</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="styles/signup_style.css">
 </head>

 <body>
   <div class="collapse navbar-collapse navHeaderCollapse">

     <ul class="nav navbar-nav navbar-right">
       <li><a href="home.php">Home</a></li>
       <li> <a href="create_adv.php">Create Advertisement</a></li>

       <?php
        if (loggedin()) {
          $temp = $_SESSION['username'];
          echo <<< _END
      		<li><a href="user_profile.php">Welcome $temp</a>
      		<li><a href="logout.php">Logout</a> 
_END;
        }

        ?>
       <li class="active"><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
       <li><a href="login.php"><span class="glyphicon glyphicon-user"></span> Sign In</a>
     </ul>
   </div>
   <?php
    $name = "";
    $username = "";
    $password = "";
    $password_again = "";
    $email = "";
    $phone = "";
    $servername = "localhost";



    if (isset($_POST['name']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password_again']) && isset($_POST['email']) && isset($_POST['phone'])) {
      $name = trim(htmlentities(strip_tags($_POST['name'])));
      $username = trim(htmlentities(strip_tags($_POST['username'])));
      $password = trim(htmlentities(strip_tags($_POST['password'])));
      $password_again = trim(htmlentities(strip_tags($_POST['password_again'])));
      $email = trim(htmlentities(strip_tags($_POST['email'])));
      $phone = trim(htmlentities(strip_tags($_POST['phone'])));
      $password_hash = md5($password);




      if (!empty($name) && !empty($username) && !empty($password) && !empty($password) && !empty($password_again) && !empty($email && !empty($phone))) {
        if ($password != $password_again) {
          echo "Password don't match";
        } else {
          $query = "SELECT username FROM users WHERE username = '$username'";
          $query_run = mysqli_query($conn, $query);

          $email_query = "SELECT email FROM users WHERE email = '$email'";
          $email_query_run = mysqli_query($conn, $email_query);




          if (mysqli_num_rows($query_run) == 1) {
            echo "The username '$username' already exixsts";
          } else if (mysqli_num_rows($email_query_run) != 0) {
            echo "This emial id '$email' already exixsts";
          } else if (array_key_exists('phone', $_POST) &&  !preg_match('/^[0-9]{10}$/', $_POST['phone'])) {
            $error = '';

            $error = 'Invalid Number!';
            echo $error;
          } else {
            $insert_query = "INSERT INTO users VALUES('$username' , '$name' , '$password_hash' , '$email' , '$phone')";
            $insert_run = mysqli_query($conn, $insert_query);
            echo "Successfully Done !";
            $_SESSION['registered'] = 1;
            echo '<script type="text/javascript">window.location.href="home.php";</script>';
            die();
          }
        }
      } else {
        echo "All Fields are Required !";
      }
    }

    ?>

   <div class="container">
     <div class="">
       <div id="login">
         <form id="signup" method="post" action="signup.php">
           <h1>Create an Account</h1>
           <input name="name" type="text" placeholder="Your Name" required="required" autofocus="autofocus" value="<?php echo $name; ?>" />
           <input name="username" type="text" placeholder="What's your username?" pattern="^[\w]{3,16}$" required="required" value="<?php echo $username; ?>" />
           <input name="password" type="password" placeholder="Choose a password" required="required" />
           <input name="password_again" type="password" placeholder="Confirm password" required="required" />
           <input name="email" type="email" placeholder="Email address" value="<?php echo $email; ?>" />
           <input name="phone" type="number" placeholder="Phone Number" value="<?php echo $phone; ?>" required="required" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" />
           <input type="submit" value="Sign me up!" class="inputButton" />
           <div class="text-center">
             already have an account? <a href="login.php" id="login_id">login</a>
           </div>
         </form>
       </div>
     </div>
     <!--col-md-6 -->



   </div>





 </body>

 </html>