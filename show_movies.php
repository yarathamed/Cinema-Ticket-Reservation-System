<!doctype html>
<html lang="en">

<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="mystyles.css">
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
  </symbol>
  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>
    <title>Movie Showtimes</title>
        
</head>
<?php
session_start();
        $servername = "localhost";
        $database = "cinema_ticket_reservation";
        $user = "root";
        $password = "";
        
        $conn = mysqli_connect($servername, $user, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            } 

            $now = new DateTime();
            $dnow = $now->format('Y-m-d H:i:s');
            $sql = "SELECT * FROM movie WHERE timeslot >  '".$dnow."'";
            //$sql = "SELECT * FROM movie ";
            $result = mysqli_query($conn, $sql);
            $_SESSION['resultData'] = $result;


?>
         
<body style="background-image: url('cust.jpg');">
<br>

<div class="container w-30" style="text-align: center">
<h3 style="color: #ac0e0ec0">Choose from the available movies</h3>
</div>
<!-- <div > -->
<form action="booking.php" method="post" class="container w-25" onsubmit="return validate()" name="Choosing" >

    <label style="color: #ac0e0ec0">Movie</label>


    <table class='table'>
      <tr>
                <th>#</th> 
                <th>Movie</th>
                <th>timeslot</th>
                <th>price</th>
                
            </tr>   
        
<?php   
                while ($rows = mysqli_fetch_assoc($result))
                {
             ?>
            <tr>
                <td><img src="<?php echo $rows['movie_image']; ?>" alt="" border=3 height=100 width=100></img></td>    
                <td><?php echo $rows['movie_name'];?></td>
                <td><?php echo $rows['timeslot'];?></td>
                <td><?php echo $rows['price'];?></td>
                <!--<td><input type="text" id="seats" name="seats" placeholder="Seats"> </td>-->
                <td><input type="radio" id="<?php echo $rows['movie_id']; ?>" name="choice" value="<?php echo $rows['movie_id']; ?>" > </td>
            </tr>
            <?php
                }
             ?>
            
        </table>

      <div id="result"></div>
    <label  class="form-label">Choose Number of Seats</label>

    <div class="input-group mb-3">

        <!--<span class="input-group-text" id="basic-addon1"></span>-->

        <input type="text" id="no_of_seats" name="no_of_seats" class="form-control" placeholder="Number Of Seats" aria-label="Username" aria-describedby="basic-addon1">

    </div>
    <div class="second" style="margin-top: 300px">
            <button type="submit" name="book" value="Submit" class="btn btn-primary" >Book tickets</button>
        </div>
</form>
<form action="login.php" method="post"  style="margin-top: 300px">
    <div >
            <button type="submit" name="log out" value="Submit" class="btn btn-primary" >Log out</button>
        </div>
</form>

</body>  

</html>