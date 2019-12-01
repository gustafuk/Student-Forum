<?php
  $conn = mysqli_connect("localhost","root","","scholardiscussiondata");
  $query = "select * from scholaruploadingquestions";
  $data = mysqli_query($conn, $query);
  $Total = mysqli_num_rows($data);

  if ($Total!=0)
   {
     while ($result = mysqli_fetch_assoc($data))
      {
       echo $result['Comments'];
      }
  }
?>
