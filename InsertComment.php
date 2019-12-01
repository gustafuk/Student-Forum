<?php
include 'Session.php';
$EmailOrPhone = $_SESSION['EmailAddressOrPhoneNumber'];
$password = $_SESSION['Password'];
?>
<?php if(isset($_POST['InsertComment']))
{
$conn = mysqli_connect('localhost','root','','scholardiscussiondata');
$CommentedID  = $_POST['SenderID'];
$Comment  = $_POST['Comment'];
$SenderPid  = $_POST['SenderPid'];
if(!$conn)
   {
     die('server not connected');
   }
  else
  {
    $query = "insert into comments(CommenterID,CommentedID,Comments,QuestionID) values ('$EmailOrPhone','$CommentedID','$Comment','$SenderPid')";
    mysqli_query($conn, $query);
    mysqli_close($conn);
  }
}
