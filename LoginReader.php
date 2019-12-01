<html>
<header>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</header>
<?php
$conn=mysqli_connect('localhost','root','','scholardiscussiondata');
session_start();
if($conn->connect_error) die($conn->connect_error);
if(isset($_POST['StudentStartLogin']))
{
$UserEmail = mysqli_real_escape_string($conn, $_POST['Username/Email/MobileNumber']);
$ps= mysqli_real_escape_string($conn, $_POST['Password']);
$query="SELECT * FROM scholaraccount where EmailAddressOrPhoneNumber like '$UserEmail'";
$result=mysqli_query($conn,$query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = mysqli_num_rows($result);
if($count == 1)
{
 if(($row['EmailAddressOrPhoneNumber'] == $UserEmail and $row['Password'] == $ps))
  {
      $queryi="update scholardetails set Online = '1' where EmailAddressOrPhoneNumber like '$UserEmail'";
      $resulti=mysqli_query($conn,$queryi);
      $_SESSION['EmailAddressOrPhoneNumber'] = $UserEmail;
      $_SESSION['Password'] = $ps;
      header("location:Home.php");
  }
  else
  {
      ?>
      <title>Redirected</title>
      <center>
      <br/>
      <img src="Photos/IMG_0860.png" style="margin-top:12%"><br/><br/>
      <label class="alert-danger" style="padding:8px;width:40%;border-radius:5px;margin-top:14px"><?php echo 'wrong username or password' ?></label><br/>
      <a href="Login.php">Try again</a>
      </center>
      <?php
  }
}
}
?>
</html>
