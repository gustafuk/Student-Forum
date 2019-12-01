<html>
<header>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://code.jquery.com/jquery-latest.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="RegisterStyleAndLoginStyles.css">
  <link rel="stylesheet" type="text/css" href="HomeStyles.css">
  <script src="MyJavaScript.js"></script>
</header>
<?php
include 'Session.php';
$EmailOrPhone = $_SESSION['EmailAddressOrPhoneNumber'];
$password = $_SESSION['Password'];
$conn = mysqli_connect("localhost","root","","scholardiscussiondata");
$query = "select * from scholardetails where EmailAddressOrPhoneNumber like '$EmailOrPhone'";
$data = mysqli_query($conn, $query);
$Total = mysqli_num_rows($data);
if ($Total!=0)
 {
   while ($result = mysqli_fetch_assoc($data))
    {
      $Level = $result['LevelOfEducation'];
    }
 }
 ?>
 <?php
 $conn = mysqli_connect("localhost","root","","scholardiscussiondata");
 $query = "select * from scholardetails where DOB !='' and EmailAddressOrPhoneNumber != '$EmailOrPhone'";
 $data = mysqli_query($conn, $query);
 $Total2 = mysqli_num_rows($data);
 if ($Total2!=0)
  {
    while ($resultq = mysqli_fetch_assoc($data))
     {
       $FirstNam = $resultq['FirstName'];
       $LastNam = $resultq['LastName'];
       $Levels = $resultq['LevelOfEducation'];
       $Photos = $resultq['ProfilePhoto'];
       $DOBAll = $resultq['DOB'];
       $Gender = $resultq['Gender'];
     }
  }
?>
<?php
if (isset($_POST['LoadBirthdayPanel']))
{
$conn = mysqli_connect("localhost","root","","scholardiscussiondata");
$query = "select * from scholardetails where EmailAddressOrPhoneNumber != '$EmailOrPhone' and DOB != '' and LevelOfEducation like '$Level' order by FirstName asc";
$data = mysqli_query($conn, $query);
$Total = mysqli_num_rows($data);
if ($Total!=0)
{
while ($resulti = mysqli_fetch_assoc($data))
{
  $Genderi = $resulti['Gender'];
?>
<div class="StyleMe">
<img class="StyleFriend" src="<?php
if($resulti['ProfilePhoto']=='')
{
 if($Genderi == 'Male')
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
<h8 style="float:left;margin-left:3%;margin-top:2%;font-size:80%;font-family: 'Arial Narrow';font-weight: bold"><?php echo $resulti['FirstName'];?></h8>
<i class="fas fa-baby" style="float:right;margin-right:2%;font-size:120%;color:white;margin-top:2%"></i>
<center>
  <?php
  $bday  = new DateTime($resulti['DOB']);
  $today  = new DateTime();
  $b_y = $bday->format('Y');
  $b_d = $bday->format('d');
  $b_m = $bday->format('m');

  if((bool)$bday->format('L') && $b_d == 29 && $b_m == 2){
    if((bool)$today->format('L')){
      $bday_obj = new DateTime(date('Y').'-'.$b_m.'-'.$b_d);
      $diff = $bday_obj->diff($today);
    }else{
      for($i=1;$i++;$i<=3){
        $today->add(new DateInterval('P1Y'));
        if((bool)$today->format('L')){
          $bday_obj = new DateTime(date('Y').'-'.$b_m.'-'.$b_d);
          $diff = $bday_obj->diff($today);
          break ;
        }
      }
    }
  }else{
    $bday_obj = new DateTime(date('Y').'-'.$b_m.'-'.$b_d);
    $diff = $bday_obj->diff($today);
  }

  $now = new DateTime() ;
  if($now > $bday_obj){
     {
      ?><br/><h7 style="margin-left:5%;color:maroon;font-size:65%;font-weight:bold"><?php echo ''.$diff->format('%a days').' before';?></h7><?php
    }
  }
  else
  {
    if(($diff->format('%a')) == 0)
    {

        ?>
        <br/>
        <h7  style="margin-left:5%;color:white;font-size:68%;font-family:'Times New Roman';border-style:solid;border-width:thin;border-color:orange;padding:2.5%;margin-left:-8%;font-weight:bold"><?php echo ' HappyBirthDay Today';?>
          <i class="fa fa-gift" style="float:left;margin-left:5%;color:orange;font-size:150%"></i>
        </h7>
        <?php
    }
    else
    {
      ?><br/><h7  style="margin-left:5%;color:white;font-size:68%;font-family:'Times New Roman';border-style:solid;border-width:thin;border-color:white;padding:2.5%;font-weight:bold"><?php
      echo 'after  '.$diff->format('%a days');?></h7><?php
    }

  }
?>
</center>
<br/>
</div>
<?php
}
}
}
?>
</html>
