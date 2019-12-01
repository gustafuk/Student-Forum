<?php
 if(isset($_POST['CheckEmail']))
 {
   session_start();
   include("db.php");
   $UserEmail = $_POST['UserEmail'];
   if($UserEmail != '')
   {
     $query = "select * from scholaraccount where EmailAddressOrPhoneNumber like '$UserEmail'";
     $data = mysqli_query($conn, $query);
     $Total = mysqli_num_rows($data);
     if ($Total!=0)
     {
       while ($result = mysqli_fetch_assoc($data))
       {
           if( $result['EmailAddressOrPhoneNumber'] == $UserEmail)
           {
             ?><h7 style="color:green;font-size:80%"><?php echo 'Checked'?></h7><?php
           }
           else
           {
             ?><h7 style="color:red;font-size:80%"><?php echo 'Email does not exist';?></h7><?php
           }
       }
    }
   }
}
if(isset($_POST['CheckCode']))
{

  include("db.php");
  session_start();
  $Codes = $_POST['Codes'];
  if($Codes != '')
  {
    $query = "select * from scholaraccount";
    $data = mysqli_query($conn, $query);
    $Total = mysqli_num_rows($data);
    if ($Total!=0)
    {
      while ($result = mysqli_fetch_assoc($data))
      {
      if($result['Code_Updator'] != '')
      {
        if( $result['Code_Updator'] == $Codes)
        {
            $_SESSION['Codes'] = $Codes;
           ?><a href="ChangeMypassword.php"><button onload="" name="ChangeMypassword" class="btn-sm btn btn-primary" style="float: right;margin-top:-5%;width:30%">Reset</button></a><?php
        }
        else
        {
          ?><h7 style="font-size:80%;color:red;float: right;margin-top:-4%">invalid Code</h7><?php
        }
      }
    }
   }
  }
}
if(isset($_POST['SaveMyPassword']))
{
  include("db.php");
  $Codes = $_POST['Codes'];
  $password = $_POST['Password'];
  if($password != '')
  {
    $queryAccount="update scholaraccount set Password = '$password' where Code_Updator like '$Codes'";
    $resulti=mysqli_query($conn,$queryAccount);
    header("location:Successfull.php");
  }
}
?>
