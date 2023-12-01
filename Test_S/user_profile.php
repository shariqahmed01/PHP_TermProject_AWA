 <?php

  include_once('connection.php');
  require_once 'core.php';
  $username = $_POST['username'];
  $sql_query =  "SELECT * FROM `users` WHERE username = '$username'  ";
  $insert_run = mysqli_query($conn, $sql_query);
  $row = mysqli_fetch_assoc($insert_run);
  $name = $row['name'];
  $username = $row['username'];
  $email = $row['email'];
  $phone = $row['phone'];
  echo '
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Welcome ! $username</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Introducing Lollipop, a sweet new take on Android.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    

    <!-- Page styles -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="styles/signup_style.css">
    <link rel="stylesheet" href="styles/profile.css"> 
</head>
<link href="styles/login_style.css" rel="stylesheet">
<link href="styles/divison_style.css" rel="stylesheet">
<link href="styles/timeline.css" rel="stylesheet">
<body>
<nav class="navbar-fixed navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Student Compass</a>
    </div>

    <button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
    <span class ="icon-bar"></span>
    <span class ="icon-bar"></span>
    <span class ="icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse navHeaderCollapse">

    <ul class="navbar-right">
    <li><a href="home.php">Home</a></li>';
  if (loggedin()) {
    $temp = $_SESSION['username'];
    echo <<< _END
    <li class="active"><a href="profile.php">Welcome ! $temp</a></li>
    <li> 
<a href = "create_adv.php">Create Advertisement</a></li>
<li><a href="notifications.php">Notifications</a></li>
   

 </ul>
  </div>  

   
     
  </div>
</nav>

<br>

      
      <div class="container">
  <div class="row">
    
        
        
       <div class="col-md-7 ">

<div class="panel panel-default">
  <div class="panel-heading">  <h4 >User Profile</h4></div>
   <div class="panel-body">
       
    <div class="box box-info">
        
            <div class="box-body">
                     <div class="col-sm-6">
                     <div  align="center"> <img alt="User Pic" src="images/profile.jpg" id="profile-image1" height="100px" width="100px"> 
                
           <!--     <input id="profile-image-upload" class="hidden" type="file">
<div style="color:#999;" >click here to change profile image</div> -->
                <!--Upload Image Js And Css-->  
             
                     </div>

              
              <br>
    
              <!-- /input-group -->
            </div>
            <div class="col-sm-6">
            <h4 style="color:#00b1b1;"> $name</h4>
              <span><p></p></span>            
            </div>
            <div class="clearfix"></div>
            <hr style="margin:5px 0 5px 0;">
    
              
<div class="col-sm-5 col-xs-6 tital " >Name:</div><div class="col-sm-7 col-xs-6 ">$name</div>
     <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >User Name:</div><div class="col-sm-7">$username</div>
  <div class="clearfix"></div>
<div class="bot-border"></div>


<div class="col-sm-5 col-xs-6 tital " >Phone:</div><div class="col-sm-7">$phone</div>

  <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Email:</div><div class="col-sm-7">$email</div>



            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
       
            
    </div> 
    </div>
</div>  
    
    </div>
</div>



 

_END;

    echo <<< _END
	</body>
	</html>
_END;
  }
  ?>
