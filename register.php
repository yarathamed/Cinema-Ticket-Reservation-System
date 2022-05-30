<?php
include "config.php";

if(isset($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['pass']))
{
$first_name = mysqli_real_escape_string($conn,$_POST['first_name']);
$last_name = mysqli_real_escape_string($conn,$_POST['last_name']);
$email = mysqli_real_escape_string($conn,$_POST['email']);
$pass = mysqli_real_escape_string($conn,$_POST['pass']);


          $sql_query1="SELECT * from customer where (email='$email')";
          $res1=mysqli_query($conn,$sql_query1);
          if (mysqli_query($conn, $sql_query1)) {
          if (mysqli_num_rows($res1) > 0) {
            $row = mysqli_fetch_assoc($res1);
            if($email==isset($row['email']))
            {
              echo "
                <script type='text/javascript'>
               alert('Email already exists')
                </script>
            ";
            
            }
          }
        
          else {
            $sql = "INSERT INTO customer (first_name, last_name, email, pass)
        VALUES ('".$first_name."','".$last_name."', '".$email."','".$pass."' );";
         if (mysqli_query($conn, $sql)) {
            echo "
            <script type='text/javascript'>
           alert('You are successfully registered!')
           
            </script>
        ";
        header('location:login.php');
        
          } else {
           echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }
          }
        }          
        }

?>
<!DOCTYPE html>
<html>
    <head>
<title>Please enter your information</title>
<link rel="stylesheet" href="style.css">
    </head>
    <body style="background-image: url('theatre.jpg'); height: 100%; background-repeat: no-repeat; background-size: cover;">
<form name="myForm"  method="post">
<label class="labels"><b>First name:</b></label><br>
<input type="text" name="first_name" id="first_name">
<br>
<br>
<label class="labels"><b>Last name:</b></label> <br>  
<input type="text" name="last_name" id="last_name">
<br>
<br>
<label class="labels"><b>Email:</b></label> <br>  
<input type="text" name="email" id="email">
<br>
<br>
<label class="labels"><b>Password :</b></label> <br>  
<input type="password" name="pass" id="pass">
<br>
<br>
<button type="submit" name="button">Submit</button><br><br>


</form>
    </body>
</html>