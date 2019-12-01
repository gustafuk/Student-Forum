<html>
<header>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="RegisterStyleAndLoginStyles.css">
  <link rel="stylesheet" type="text/css" href="fetch.php">
  <script src="MyJavaScript.js"></script>
</header>
<body style="background-color:white;background-image: url('Photos/IMG_0992.jpg');background-attachment: fixed;background-size: cover;background-repeat: no-repeat;background-color: black;">

  <nav class="nav navbar-fixed-top NavBarStyle" >
    <img src="Photos/IMG_0796.png"  style="height: 96%"/>
  </nav>
  <center><br/>
      <img src="Photos/mail-icon (1).png" style="height:13%"/><br/><br/>
      <form method="post" action="#" enctype="multipart/form-data">
      <div class="thumbnail" style="width:390px;height:56%;padding:35px;background-color:white;border-radius:5px;border-style:solid;border-width:thin;border-color:lightgray">
        <h4 style="font-family:'cambria';font-style:normal;color:#0D8DFE;margin-top:-2%;font-size:150%;font-weight:bold">Email Verification</h4>
        <hr/>
        <label style="float: left;font-family:'Times New Roman';font-weight:bold">Enter email:</label>
        <input name="UserEmail" id="UserEmail" spellcheck="false" required type="email" class="form-control text-default" placeholder="Enter your email address"/><h7 id="CheckEmail" style="float:left;margin-top:2%"></h7>
        <button id="LoadingButton" class="btn-sm btn btn-primary" type="button" style="display: none;float:right;margin-top:2%;width:100%;font-weight:bold">
           <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Sending...
        </button>
        <button onclick="ShowLoadingButton()" name="SendToMobile"  type="submit" id="Enable" class="btn-sm btn btn-primary" style="float: right;margin-top:2%;width:100%;font-weight:bold">Send Codes</button><br/><br/>
        <label style="color:lightgray;font-family:'Times New Roman';font-weight:bold">__________________ OR  _________________</label><br/><br/>
        <a href="Login.php" style="cursor: pointer">Back To Login</a>
      </div>
    </form>
  </center>
</body>
<script type="text/javascript">
function ShowLoadingButton()
{
  var LoadingButton = document.getElementById('LoadingButton');
  var Enable = document.getElementById('Enable');
  var UserEmail = $('#UserEmail').val();
  if(UserEmail == '')
  {

  }
  else
  {
    LoadingButton.style.display = 'block';
    Enable.style.display = 'none';
  }

}
$(document).ready(function()
{
  function Loader()
  {
    var MyLoader = document.getElementById('MyLoader');
    MyLoader.style.display = 'none';
  }
  setInterval(function(){
   Loading();
   checkemail();
  }, 500);
  function Loading()
  {
    var UserEmail = $("#UserEmail").val();
    $.ajax({
      url: "LoadLifeTime.php",
      type: "POST",
      async: false,
      data:{
        "CheckEmail": 1,
        "UserEmail": UserEmail
      },
       success: function(data)
      {
        checkemail();
      }
    });
  }
  function checkemail()
  {
    var UserEmail = $("#UserEmail").val();
  $.ajax({
    url: "LoadLifeTime.php",
    type: "POST",
    async: false,
    data:{
      "CheckEmail": 1,
      "UserEmail": UserEmail
    },
     success: function(data)
    {
        $("#CheckEmail").html(data);
    }
  });
  }
});
</script>
<?php
include 'C:/xampp/htdocs/Scholars Subject Discussion/vendor/autoload.php';
$App_key  = "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";
if(isset($_POST['SendToMobile']))
{
   $Code = ((date('s') * 19988) + (10*date('m')));
   $UserEmail = $_POST['UserEmail'];
   $SenderEmail = 'StudentTrainingForum@hotmail.com';

   $email = new \SendGrid\Mail\Mail();
   $email->setFrom($SenderEmail,"Student Forum");
   $email->setSubject("Password Reset Codes");
   $email->addTo($UserEmail,"Reset Code");
   $email->addContent("text/plain","Student Forum Code $Code");
   $sendgrid = new \SendGrid($App_key);
   if($sendgrid->send($email));
   {
     include("db.php");
     $queryUp = "update scholaraccount set Code_Updator = '$Code' where EmailAddressOrPhoneNumber like '$UserEmail'";
     mysqli_query($conn, $queryUp);
     mysqli_close($conn);
     header("location:Codecomparator.php");
   }
}
?>
</html>
