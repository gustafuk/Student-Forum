<?php
include 'SessionCode.php';
$Codes = $_SESSION['Codes'];

include("db.php");
$query = "select * from scholaraccount where Code_Updator like '$Codes'";
$data = mysqli_query($conn, $query);
$Total = mysqli_num_rows($data);
if ($Total!=0)
{
  while ($result = mysqli_fetch_assoc($data))
  {
    $Email = $result['EmailAddressOrPhoneNumber'];
    $conn = mysqli_connect("localhost","root","","scholardiscussiondata");
    $query = "select * from scholardetails where EmailAddressOrPhoneNumber like '$Email'";
    $data = mysqli_query($conn, $query);
    $Total = mysqli_num_rows($data);
    if ($Total!=0)
     {
       while ($result = mysqli_fetch_assoc($data))
        {
          $FirstName = $result['FirstName'];
        }
      }
  }
}
?>
<html>
 <header>
 	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="RegisterStyleAndLoginStyles.css">
    <script src="MyJavaScript.js"></script>
 </header>
  <body style="background-color:white;background-image: url('Photos/IMG_0992.jpg');background-attachment: fixed;background-size: cover;background-repeat: no-repeat;background-color: black;">
 	  <nav class="nav navbar-fixed-top NavBarStyle" >
      <img src="Photos/IMG_0796.png" style="height: 96%"/>
    </nav>
        <center>
          <form method="post" action="LoadLifeTime.php" enctype="multipart/form-data">
           <div id="StudentDetails" class="card " style="padding:35px;width:28%;height:428px;margin-top:5%;border-radius:5px;border-style:solid;border-width:thin;border-color:lightgray"><br/>
              <img src="Photos/Forum_Header1.png" style="width:85%;margin-top:-6%"><br/>
              <h7 style="font-weight:bold;font-family:'Cambria'">Welcome Dear <?php echo $FirstName ?></h7>
              <input name="Codes" value="<?php echo  $Codes ?>" style="display: none">
              <input required id="PasswordConfirm" name="Password" type="password" class="form-control" placeholder="Enter new password" style="padding-top:1%;margin-top:2%"/>
              <input required name="PasswordConfirm" type="password" class="form-control" placeholder="Confirm new password" style="padding-top:1%;margin-top:2%"/>
              <button onclick="Checking()" type="submit" name="SaveMyPassword" class="btn btn-primary" style="width: 100%;margin-top:4%">Change</button>
              <h7 style="font-size:73%;margin-top:2%">Makesure Input Password must contain [7 to 15 characters] which contain only characters, numeric digits</h7><br/>
              <label style="color:lightgray;font-family:'Times New Roman';font-weight:bold">_________________ OR  _________________</label><br/>
              <a href="Login.php" style="cursor: pointer">Back To Login</a>
           </div>
         </form>
        </center>
  </body>
<script>
<script type="text/javascript">
$(document).ready(function()
{
  setInterval(function(){
    CheckPassword();
  }, 500);
    var CheckStrongPassword = document.getElementById('PasswordConfirm');
    function CheckPassword()
    {
      if(CheckStrongPassword != '')
      {
        var passw =  /^[A-Za-z]\w{7,14}$/;
        if(CheckStrongPassword.value.match(passw))
        {
          alert('correct');
        }
        else
        {
          alert('incorrect');
        }
      }
    }
  });
</script>
</html>
