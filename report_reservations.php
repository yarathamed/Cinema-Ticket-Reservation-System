<?php
include "config.php";


 if(isset($_POST['movie']))
 {
    $movie = mysqli_real_escape_string($conn,$_POST['movie']);

    $sql = "SELECT * FROM reservation r  WHERE r.movie_name = '$movie'";
    //echo $sql;
         if (mysqli_query($conn, $sql)) {
            echo "Found";
        
          } else {
           echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }

    //echo $sql;
    $result=mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0) 
    {
      echo "<table border=\"2\"><tr><th>Reservation number</th><th>Movie id</th><th>Customer id</th><th>Movie name</th><th>Time slot</th><th>Number of seats</th></tr>";
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo "<tr class='clickable' onclick=\"window.location='search.html'\">
        <td>".$row["reservation_number"]."</td>
        <td>".$row["movie_id"]."</td><td>".$row["customer_id"]."</td>
        <td>".$row["movie_name"]."</td><td>".$row["timeslot"]."</td>
        <td>".$row["n_of_seats"]."</tr>";
      }
      echo "</table>";
    } else {
      echo "0 results";
    }}
?>