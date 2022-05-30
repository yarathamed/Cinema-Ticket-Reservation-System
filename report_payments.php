<?php
include "config.php";

    $sql = "SELECT * FROM payment p";
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
      echo "<table border=\"2\"><tr><th>Payment number</th><th>Reservation number</th><th>Customer id</th><th>Amount</th><th>Type of payment</th></tr>";
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo "<tr class='clickable' onclick=\"window.location='search.html'\">
        <td>".$row["payment_no"]."</td><td>".$row["reservation_number"]."</td>
        <td>".$row["customer_id"]."</td><td>".$row["amount"]."</td>
        <td>".$row["type_of_payment"]."</tr>";
      }
      echo "</table>";
    } else {
      echo "0 results";
    }
?>