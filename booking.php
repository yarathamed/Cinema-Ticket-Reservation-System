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
    <title>Reserve Your Ticket</title>
    
</head>


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cinema_ticket_reservation";

session_start();
$moviesData=$_SESSION['resultData']; 
$noOfSeats= $_POST['no_of_seats'];
$cust_id=$_SESSION['customer_id'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}



//


if(isset($_POST['choice']) /*&& isset($_POST['Visa Number']) && isset($_POST['Card CVV'])*/)
{
  
     $movieID =$_POST['choice'];

     //$regNo= $_POST['Reservation_number'];
     
echo "REG  " . $movieID. "<br>";

     $sql = "SELECT * FROM movie where movie_id  = '".$movieID."'";
     $result = mysqli_query($conn, $sql);

     if(mysqli_num_rows($result) > 0)
      {
           while($row = mysqli_fetch_assoc($result)) 
           {
               //echo "Welcome  " . $row["name"]. "<br>";
            $v_movieID   = $row["movie_id"];
            $v_movieName = $row["movie_name"];
            $v_availableSeats   = $row["available_seats"];
            $v_timeslot   = $row["timeslot"];
            $v_price   = $row["price"];


            

/*echo "v_movieID  " . $v_movieID. "<br>";
echo "v_movieName  " . $v_movieName. "<br>";
echo "v_availableSeats  " . $v_availableSeats. "<br>";
echo "v_timeslot  " . $v_timeslot. "<br>";
echo "v_price  " . $v_price. "<br>";
echo "noOfSeats  " . $noOfSeats. "<br>";
*/
            $new_available_seats = $v_availableSeats-$noOfSeats;

           
        
            $sql1 = "UPDATE movie
                    SET available_seats = '".$new_available_seats."'"."
                     WHERE movie_id = '".$v_movieID."'";
            $res_id = uniqid('res');         
            $sql2 = "INSERT INTO reservation (reservation_number,customer_id,movie_name,timeslot,n_of_seats,movie_id) VALUES ('".$res_id."','".$cust_id."','".$v_movieName."','".$v_timeslot."','".$noOfSeats."','".$v_movieID."')";
        

             if( ($conn->query($sql1) === TRUE ) &&( $conn->query($sql2) === TRUE))
             {
               echo "Successful Booking !!"; 
             } 
             else 
             {
               echo "Error: " . $sql . "<br>" . $conn->error;
             }
             



           }  
      }      
      /*else 
      {
           echo "Reservation doesn't exist! ";
      } 
*/
      
      
}

$_SESSION['reservation_id'] = $res_id;
$_SESSION['no_Of_Seats'] = $noOfSeats;
$_SESSION['tickectprice'] = $v_price;


//$conn->close();
?>

<!doctype html>
<html lang="en">

<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   
     <link rel="stylesheet" href="mystyles.css"> 
    <title>Success!</title>
</head>
<body style="background-image: url('cust.jpg'); height: 100%; background-repeat: no-repeat; background-size: cover;">

<br>
<p>Your Reservation Number is:  <?php echo htmlspecialchars($res_id);?></p>
<form action="payment1.html" method="post">
    <div >
            <button type="submit" name="proceed" value="Submit" class="btn btn-primary">Proceed to Pay</button>
        </div>
</form>
<!-- <form action="login.php" method="post">
    <div>
            <button type="submit" name="logout" value="Submit" class="btn btn-primary">Log out</button>
        </div>
</form> -->
</html>
