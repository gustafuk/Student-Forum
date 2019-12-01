<?php
include 'Session.php';
$EmailOrPhone = $_SESSION['EmailAddressOrPhoneNumber'];
$password = $_SESSION['Password'];
?>
<?php
  if(isset($_POST['AccountUpdater']))
  {
    $conn = mysqli_connect("localhost","root","","scholardiscussiondata");
    $query = "select * from scholaraccount where EmailAddressOrPhoneNumber like '$EmailOrPhone'";
    $data = mysqli_query($conn, $query);
    $Total = mysqli_num_rows($data);
    $OldPassword = $_POST['OldPassword'];
    $NewPassword = $_POST['NewPassword'];
    if ($Total!=0)
     {
       while ($result = mysqli_fetch_assoc($data))
        {
          if($result['Password'] == $OldPassword)
          {
              $queryUpdater = "update scholaraccount set Password = '$NewPassword' where EmailAddressOrPhoneNumber like '$EmailOrPhone'";
              mysqli_query($conn, $queryUpdater);
              mysqli_close($conn);
          }
          else
          {

          }
        }
     }
  }
 ?>
 <?php
 if(isset($_POST['LoadProfilePicture']))
 {
 include("db.php");
 $query = "select * from scholardetails where EmailAddressOrPhoneNumber like '$EmailOrPhone'";
 $data = mysqli_query($conn, $query);
 $Total = mysqli_num_rows($data);
 if ($Total!=0)
 {
 while ($resultw = mysqli_fetch_assoc($data))
 {
   $Photo = $resultw['ProfilePhoto'];
   ?><div id="ProfilePicture"
   <?php if($Photo == '')
   {
   ?>
   style = "background-image: url('Photos/IMG_0992.jpg');width:100%;height:350px;background-size: cover;background-repeat: no-repeat;background-attachment: inherit;border-radius: 0">
   <?php
   }
   else
   {
   ?>
   style = "background-image: url('<?php echo $Photo ?>');width:100%;height:350px;background-size: cover;background-repeat: no-repeat;background-attachment: inherit;border-radius: 0;border-bottom-style:solid;border-bottom-width:thin;border-bottom-color:lightgray">
   <?php
   }
   ?>
 </div><?php
 }
 }
}
?>
<?php
include("db.php");
$query = "select * from scholardetails where EmailAddressOrPhoneNumber like '$EmailOrPhone'";
$data = mysqli_query($conn, $query);
$Total = mysqli_num_rows($data);
if ($Total!=0)
{
while ($resultw = mysqli_fetch_assoc($data))
{
$FirstName = $resultw['FirstName'];
$LastName = $resultw['LastName'];
$Level = $resultw['LevelOfEducation'];
$Photo = $resultw['ProfilePhoto'];
$CurrentLocation = $resultw['CurrentLocation'];
$Currentcity = $resultw['CurrentCity'];
$Country = $resultw['Country'];
$DateOfBirth = $resultw['DOB'];
$Gender = $resultw['Gender'];
}
}
?>
<?php
  if(isset($_POST['ShowTheProfileRound']))
  {
    ?><img  src="
  <?php
  if($Photo == '')
  {
    if($Gender == 'Male')
    {
      ?>Photos/profile-pic.jpeg<?php
    }
    else
    {
      ?>Photos/4_Female.jpg<?php
    }
  }
  else
  {
   echo $Photo;
  }
  ?>" style="float: left;height: 8%;width:50px;border-radius:100px;background-color:lightgray"/><?php
  }
?>
