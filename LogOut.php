<?php
session_start();
include 'Session.php';
$EmailOrPhone = $_SESSION['EmailAddressOrPhoneNumber'];
$password = $_SESSION['Password'];
$query="SELECT * FROM scholaraccount where EmailAddressOrPhoneNumber like '$EmailOrPhone'";
$result=mysqli_query($conn,$query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = mysqli_num_rows($result);
if($count == 1)
{
      $queryi="update scholardetails set Online = '0' where EmailAddressOrPhoneNumber like '$EmailOrPhone'";
      $resulti=mysqli_query($conn,$queryi);
}
?>
<?php
 session_start();
 header('Location: login.php');
 session_destroy();
 exit;
?>
