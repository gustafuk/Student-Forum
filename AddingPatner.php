<?php
include 'Session.php';
$EmailOrPhone = $_SESSION['EmailAddressOrPhoneNumber'];
$password = $_SESSION['Password'];
?>
<?php
$conn = mysqli_connect("localhost","root","","scholardiscussiondata");
$query = "select * from scholardetails where EmailAddressOrPhoneNumber like '$EmailOrPhone'";
$data = mysqli_query($conn, $query);
$Total = mysqli_num_rows($data);
if ($Total!=0)
{
while ($result = mysqli_fetch_assoc($data))
{
$FirstName = $result['FirstName'];
$LastName = $result['LastName'];
$Level = $result['LevelOfEducation'];
$Photo = $result['ProfilePhoto'];
$DOB = $result['DOB'];
}
}
?>
<?php
//Adding patner
if(isset($_POST['Padd']))
{
    include("db.php");
    $PatnerID = $_POST['PatnerID'];
    $query = "insert into student_patner(StudentEmail,PatnerID,Remove_Or_AddPatner) values ('$EmailOrPhone','$PatnerID','1')";
    mysqli_query($conn, $query);
    mysqli_close($conn);
 }
?>
<?php
$conn = mysqli_connect("localhost","root","","scholardiscussiondata");
$query = "select * from student_patner where StudentEmail like '$EmailOrPhone' and PatnerID != ''";
$data = mysqli_query($conn, $query);
$Total = mysqli_num_rows($data);
if ($Total!=0)
{
while ($resultss = mysqli_fetch_assoc($data))
{
  $Patner = $resultss['PatnerID'];
}
}
//Select patner
?>
<?php
if(isset($_POST['SearchFriend']))
{
$SearchBox = $_POST['SearchBox'];
if($SearchBox == '')
{
  $query = "select * from scholardetails where LevelOfEducation like '$Level' and EmailAddressOrPhoneNumber != '$EmailOrPhone'";
  $data = mysqli_query($conn, $query);
  $Total = mysqli_num_rows($data);
  if ($Total!=0)
  {
  while ($resulti = mysqli_fetch_assoc($data))
  {
    $Gender = $resulti['Gender'];
   ?>
    <div class="StyleMe">
     <img title="Add <?php echo $resulti['FirstName'] ?> as new patner" class="StyleFriend" src="<?php
     if($resulti['ProfilePhoto']=='')
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
       echo $resulti['ProfilePhoto'];
     }
     ?>
     " style="color:lightgray;border-top-left-radius: 4px;border-top-right-radius: 4px;width:100%;background-color:white"/><br/>
     <h8 style="float:left;margin-left:3%;font-size:80%;font-family: 'Arial Narrow';font-weight: bold;margin-top:2%"><?php echo $resulti['FirstName'];?></h8>
     <input id="PatnerID" value="<?php echo $resulti['EmailAddressOrPhoneNumber'];?>" style="display: none" >
     <h8 style="float:right;margin-right:3%;font-size:70%;font-family: 'Cambria';font-weight: bold;margin-top:2%;color:white"><?php echo $resulti['CollegeUniversitySchool'];?></h8>
     <br/><i class="glyphicon glyphicon-flag" style="font-size:110%;color:white;margin-left:-1%"></i><h7 style="font-size:75%;margin-left:2%;font-weight:bold;font-family:'Times new roman'"><?php echo $resulti['Country'] ?></h7>
     <br/>
   </div>
  <?php
  }
 }
}
else
 {
   $query = "select * from scholardetails where LevelOfEducation like '$Level' and EmailAddressOrPhoneNumber != '$EmailOrPhone' and FirstName like '$SearchBox'";
   $data = mysqli_query($conn, $query);
   $Total = mysqli_num_rows($data);
   if ($Total!=0)
   {
   while ($resulti = mysqli_fetch_assoc($data))
   {
     $Gender = $resulti['Gender'];
    ?>
     <div class="StyleMe">
      <img title="Add <?php echo $resulti['FirstName'] ?> as new patner" class="StyleFriend" src="<?php
      if($resulti['ProfilePhoto']=='')
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
        echo $resulti['ProfilePhoto'];
      }
      ?>
      " style="color:lightgray;border-top-left-radius: 4px;border-top-right-radius: 4px;width:100%;background-color:white"/><br/>
      <h8 style="float:left;margin-left:3%;font-size:80%;font-family: 'Arial Narrow';font-weight: bold;margin-top:2%"><?php echo $resulti['FirstName'];?></h8>
      <input id="PatnerID" value="<?php echo $resulti['EmailAddressOrPhoneNumber'];?>" style="display: none" >
      <h8 style="float:right;margin-right:3%;font-size:70%;font-family: 'Arial Narrow';font-weight: bold;margin-top:2%;color:white"><?php echo $resulti['CollegeUniversitySchool'];?></h8>
      <br/><i id="AddPatner" data-container="body" data-toggle="popover" data-trigger ='hover' data- data-placement="bottom" data-content="add <?php echo $resulti['FirstName'];?> as new patner" class="fa fa-user-plus" style="margin-right:3%;float:right;margin-top:2%;color:white;cursor:pointer;font-size:80%"></i>
      <br/>
    </div>
   <?php
   }
  }
 }
}
?>
