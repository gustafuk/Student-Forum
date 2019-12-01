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
    <img src="Photos/IMG_0796.png" style="height: 96%"/>
  </nav>
  <center><br/>
      <img src="Photos/IMG_0869.png" style="margin-top:0.2%"/><br/><br/>
      <div class="thumbnail" style="width:390px;height:34%;padding:35px;background-color:white;border-radius:5px;border-style:solid;border-width:thin;border-color:lightgray">
        <h4 style="font-family:'cambria';font-style:normal;color:#0D8DFE;margin-top:-1%;font-size:150%;font-weight:bold">Code Verification</h4>
        <hr/>
        <label style="font-family:'Elephant';font-weight:bold">CODE</label></h7>
        <input id="Codes" required type="codes" maxlength="6"  placeholder="- - -  - - -" autofocus style="font-weight:bold;border-radius:0;outline: none;width:100%;text-align: center;border-width:0;font-size:120%;border-bottom-style:solid;border-bottom-width:2px;border-bottom-color:#0D8DFE;color:#0D8DFE"/><br/><br/>
        <h7 style="float: left;font-size:75%;font-family:'times new roman';color:green;margin-top:-3%;font-weight:bold">Code successfull sent to your email</h7><h7 id="checkCodes"></h7>
        <div id="DisabledOrEnabled"></div>
      </div>
      <br/>
  </center>
</body>
<script type="text/javascript">
$(document).ready(function()
{
  setInterval(function(){
   Loading();
   checkCodes();
 }, 600);
  function Loading()
  {
    var Codes = $("#Codes").val();
    $.ajax({
      url: "LoadLifeTime.php",
      type: "POST",
      async: false,
      data:{
        "CheckCode": 1,
        "Codes": Codes
      },
       success: function(data)
      {
        checkCodes();
      }
    });
  }
  function checkCodes()
  {
    var Codes = $("#Codes").val();
  $.ajax({
    url: "LoadLifeTime.php",
    type: "POST",
    async: false,
    data:{
      "CheckCode": 1,
      "Codes": Codes
    },
     success: function(data)
    {
        $("#DisabledOrEnabled").html(data);
    }
  });
  }
});
</script>
</html>
