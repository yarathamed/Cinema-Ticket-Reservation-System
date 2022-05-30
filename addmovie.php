<?php

//include "config.php";
session_start();
        $servername = "localhost";
        $database = "cinema_ticket_reservation";
        $user = "root";
        $password = "";
        
        $conn = mysqli_connect($servername, $user, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            } 


if(isset($_POST['movie_name'], $_POST['available_seats'], $_POST['timeslot'], $_POST['price'], $_POST['movie_image']))

{

$movie_name = mysqli_real_escape_string($conn,$_POST['movie_name']);

$available_seats = mysqli_real_escape_string($conn,$_POST['available_seats']);

$timeslot = mysqli_real_escape_string($conn,$_POST['timeslot']);

$price = mysqli_real_escape_string($conn,$_POST['price']);

$movie_image = mysqli_real_escape_string($conn,$_POST['movie_image']);
$movie_id = uniqid('mov');
echo "REG  " . $movie_id. "<br>";

$sql = "INSERT INTO movie (movie_id,movie_name, available_seats, timeslot, price, movie_image)

        VALUES ('".$movie_id."','".$movie_name."','".$available_seats."', '".$timeslot."','".$price."','".$movie_image."' );";

         if (mysqli_query($conn, $sql)) {

            echo "New movie added successfully<br/>";

        

          } else {

           echo "Error: " . $sql . "<br>" . mysqli_error($conn);

          }

}



?>

<!DOCTYPE html>

<html>

    <head>

<title>Enter new movie details</title>

<link rel="stylesheet" href="style.css">

    </head>

    <body style="background-image: url('addmovie.png'); height: 100%; background-repeat: no-repeat; background-size: cover;">

<form name="myForm"  method="post">

<label class="labels"><b>Movie name:</b></label> <br>  

<input type="text" name="movie_name" id="movie_name">

<br>

<br>

<label class="labels"><b>Available seats:</b></label> <br>  

<input type="text" name="available_seats" id="available_seats">

<br>

<br>

<label class="labels"><b>Time slot:</b></label> <br>  

<input type="text" name="timeslot" id="timeslot">

<br>

<br>

<label class="labels"><b>Price:</b></label> <br>  

<input type="text" name="price" id="price">

<br>

<br>

<label class="labels"><b>Movie image:</b></label> <br>  

<input type="text" name="movie_image" id="movie_image">

<br>

<br>

<button type="submit" name="button">ADD MOVIE</button><br><br>

<button type="submit" class="button" value="logout" formaction = "logout.php" name = "logout">Log out </button><br>

<br>

<br>



</form>

    </body>

</html>