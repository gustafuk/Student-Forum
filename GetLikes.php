<?php
include 'Session.php';
$EmailOrPhone = $_SESSION['EmailAddressOrPhoneNumber'];
$password = $_SESSION['Password'];
?>
<?php
if(isset($_POST['InsertLikes']))
{
    include("db.php");
    $SenderID = $_POST['SenderID'];
    $SenderPid = $_POST['SenderPid'];
    $query = "select * from thelikes where LikedID like '$SenderID' and QuestionID like '$SenderPid'";
    $data = mysqli_query($conn, $query);
    $Total = mysqli_num_rows($data);
    if ($Total!=0)
     {
       while ($resultw = mysqli_fetch_assoc($data))
        {
          if(!$conn)
             {
               die('server not connected');
             }
           else
             {
                $MyFirstLike = 1;
                $query = "insert into thelikes(LikerID,LikedID,Likes,QuestionID) values ('$EmailOrPhone','$SenderID','$MyFirstLike','$SenderPid')";
                mysqli_query($conn, $query);
                mysqli_close($conn);
             }
         }
      }
 }
 //updating likes
?>
