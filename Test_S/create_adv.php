<!DOCTYPE html>
<?php require_once 'core.php'; ?>
<html lang="en">

<head>
    <title>Create Advertisement</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="styles/create_adv_style.css">
    <link rel="stylesheet" href="styles/profile.css">
    <link rel="stylesheet" href="styles/not_loggedin.css">
    <link rel="stylesheet" href="styles/alert.css">
</head>

<body>
    <div class="collapse navbar-collapse navHeaderCollapse">

        <ul class="nav navbar-nav navbar-right">
            <li><a href="home.php">Home</a>
            <li class="active"><a href="create_adv.php">Create Advertisement</a></li>
            <?php
            if (loggedin()) {
                $temp = $_SESSION['username'];
                echo <<< _END
      		<li><a href="profile.php">Welcome $temp</a>
      		<li><a href="logout.php">Logout</a> 
_END;
            } else {
                echo <<< _END
      		<li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
      		<li><a href="login.php"><span class="glyphicon glyphicon-user"></span> Sign In</a>
_END;
            }

            ?>

        </ul>
    </div>

    <?php
    include_once('connection.php');
    if (!loggedin()) {
        echo <<< _END
  <div class= "alert1">
	You are not logged in </br> You must be logged in to Post Advertisement </br><a href="login.php">Click Here </a> to login.<br>
	If you are new user , <a href = "signup.php">Click here</a> to register.</div>
_END;
    } else {
        $title = "";
        $price = "";
        $phone = "";
        $description = "";
        $area = "";
        $category = "";
        $address = "";
        $image_path = "";
        $price_initial = "";
        $price_final = "";
        $username = $_SESSION['username'];
        $result = "";


        if (
            isset($_POST['title']) && isset($_POST['price']) && isset($_POST['phone']) && isset($_POST['area']) &&
            isset($_POST['category']) && isset($_POST['description'])
        ) {

            //echo "Hello World 2 !";
            $title = trim(htmlentities(strip_tags($_POST['title'])));
            $price = trim(htmlentities(strip_tags($_POST['price'])));
            $phone = trim(htmlentities(strip_tags($_POST['phone'])));
            $description = trim(htmlentities(strip_tags($_POST['description'])));
            $area = trim(htmlentities(strip_tags($_POST['area'])));
            $category = trim(htmlentities(strip_tags($_POST['category'])));
            $address = trim(htmlentities(strip_tags($_POST['address'])));
            $price_array = explode("-", $price);
            $price_initial = $price_array[0];
            $price_final = $price_array[1];
            $target_dir = "user_uploads/";
            $Filename = basename($_FILES['Filename']['name']);
            $Filename = preg_replace('/\s+/', '', $Filename);
            $target = $target_dir . $Filename;
            $j = 1;

            while (file_exists($target)) {
                $target = $target_dir . $Filename . "($j)";
                $j = $j + 1;
            }
            $temp_approve = false;

            if (!empty($title) && !empty($price) && !empty($phone) && !empty($description) && !empty($area) && !empty($category)) {


                if (array_key_exists('phone', $_POST) &&  !preg_match('/^[0-9]{10}$/', $_POST['phone'])) {
                    $error = '';

                    $error = 'Invalid Number!';
                    echo $error;
                } else if (move_uploaded_file($_FILES['Filename']['tmp_name'], $target)) {
                    $insert_query = "INSERT INTO advertisements (adv_id, username , title , price_initial , price_final ,
                  phone ,  address,area, category , description ,  image , approve ) VALUES (NULL, '$username', '$title', 
                  '$price_initial', '$price_final', '$phone', '$address', '$area', '$category', '$description', '$Filename' , '$temp_approve')";

                    $insert_query_run = mysqli_query($conn, $insert_query);
                    $_SESSION['res'] = '<div class="alert1"> Your Advertisement is posted Successfully in our database, your post is sent  to be reviewed by us Our Admin & hopefully approved by our admin shortly , Thank you :)  </div>';
                } else {
                    $_SESSION['res'] =  "There was some error uploading your file";
                }
            }
            header("Location:{$_SERVER['PHP_SELF']}");
            exit();
        }
        if (isset($_SESSION['res'])) {
            $result = $_SESSION['res'];
            // session_destroy();
            unset($_SESSION['res']);
        }
        if (!empty($result)) {
            echo "<h3>" . $result . "</h3>";
        }
        echo <<< _END
        <div class="container">
    <div class="col-md-6">
    <div id="logbox">
      <form id="create_adverisement" method="post" action="create_adv.php" enctype="multipart/form-data">
        <h1>Create your Advertisement</h1>
        <input name="title" type="text"  placeholder="Title" class="input pass"  autofocus="autofocus" value="$title" required = "required"/>
        
        <input name="price" type="text" placeholder="Enter Price e.g: 1000-2000" class="input pass"  required = "required"  />
        <input name="phone" type="number" placeholder="Phone Number" class="input pass" value="$phone" required="required" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" />

        <input name="address" type="text" placeholder="Address *(OPTIONAL)" class="input pass" value = "$address"   />
        
        <select  name =  "area" class="input pass"  value = "$area" required = "required">
        <option  value="">___Select your locality____</option>
        <option  value="overlandpark" >Overland Park</option>
        <option  value="leesummit" >Lee Summit</option>
        <option  value="olathe">olathe</option>
        <option  value="warrensburg">warrensburg</option>
        <option  value="kansascity">kansascity</option>
        <option  value="independence">independence</option>
        <option  value="lenexa">lenexa</option>
        </select>

        
        <select name= "category"   class="input pass"  value = "$category" required = "required">
        <option  value="">___Select product category____</option>
        <option  value="accomidation">Accomidation</option>
        <option  value="accesories">Accesories</option>
        <option  value="bicycle">Bicycle</option>
        <option  value="book">Book</option>
        <option  value="car">Car</option>
        <option  value="mobile">Mobile Phone</option>
        <option  value="other">Others</option>
        
        </select>

        <textarea  name = "description" placeholder="Describe product in 200 characters" class="input pass"  required="required" ></textarea> </br>

        
        <div class="button-wrapper">
  <span class="label">
    Upload File
  </span>
  
    <input type="file" name="Filename" id="upload" class="upload-box" placeholder="Upload File">
  
</div>
        
        <input type="submit" value="Submit!" class="inputButton"/>
        
      </form>
    </div>
   </div>
    <!--col-md-6 -->
    
   
    
  </div>
  


  

  </body>
</html>

_END;
    }
    ?>