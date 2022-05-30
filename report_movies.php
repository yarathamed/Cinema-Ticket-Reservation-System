<?php
include "config.php";

    $sql = "SELECT * FROM movie m";
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
      echo "<table border=\"2\"><tr><th>Movie id</th><th>Movie name</th><th>Available seats</th><th>Time slot</th><th>Price</th><th>Movie image</th></tr>";
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo "<tr class='clickable' onclick=\"window.location='search.html'\">
        <td>".$row["movie_id"]."</td><td>".$row["movie_name"]."</td>
        <td>".$row["available_seats"]."</td><td>".$row["timeslot"]."</td>
        <td>".$row["price"]."</td><td>".$row["movie_image"]."</tr>";
      }
      echo "</table>";
    } else {
      echo "0 results";
    }
?>