<html>
<?php
include 'Session.php';
$EmailOrPhone = $_SESSION['EmailAddressOrPhoneNumber'];
?>
<?php
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
    $Gendary = $result['Gender'];
    if($Photo == '')
    {
      if($Gendary == 'Male')
      {
        $MM = 'profile-pic.jpeg';
      }
      else {
        $MM = '4_Female.jpg';
      }
    }
    else {
      $MM = $Photo;
    }
  }
 }
?>
<?php if(isset($_POST['AddChatting']))
{
  $ChattingID = ((date('s') * 10208) + (10*date('m')));
  $PatnerEmail = $_POST['PatnerEmail'];
  $PatnerName = $_POST['PatnerName'];
  $LasName = $_POST['LastName'];
  $sProfilePhoto = $_POST['PProfilePhoto'];
  $ChattingTime = date("h:i a");
  $ChattingDay =  date('d M Y');
  $conn = mysqli_connect('localhost','root','','scholardiscussiondata');
  if(!$conn)
   {
     die('server not connected');
   }
  else
  {

     $queryCconnectionss = "Insert into chatting_connector(Student1,Student2,FirstName,LastName,ProfilePhoto,ProfilePhoto2,ConnectorFirstName,ConnectorLastName,Chatting_ID,Connection,Day_Connection) values ('$EmailOrPhone','$PatnerEmail','$PatnerName','$LasName','$sProfilePhoto','$MM','$FirstName','$LastName','$ChattingID','1','$ChattingDay')";
     $queryss = "update chatting_connector set Connection = '0' where  Chatting_ID != '$ChattingID' and Student1 = '$EmailOrPhone'";
     mysqli_query($conn, $queryCconnectionss);
     mysqli_query($conn, $queryss);
     mysqli_close($conn);
   }
}
?>
<?php
if(isset($_POST['StartChatting']))
{
  // Inserts Messages Into database
    $conn = mysqli_connect("localhost","root","","scholardiscussiondata");
    $ChattingTime = date("h:i a");
    $ChattingDay =  date('d M Y');
    $StudentID = $_POST['StudentID'];
    $StudentFirstName = $_POST['StudentFirstName'];
    $Mypicture = $_POST['StudentPicture'];
    $Chatting_ID = $_POST['Chatting_ID'];
    $query = "select * from chatting_connector where (Student1 = '$EmailOrPhone' or Student2 = '$EmailOrPhone') and Connection = '1'";
    $data = mysqli_query($conn, $query);
    $Total = mysqli_num_rows($data);
    if ($Total!=0)
    {
      while ($resulti = mysqli_fetch_assoc($data))
      {
        if($resulti['Chatting_ID'] == $Chatting_ID)
        {
          $querys = "update studentchatting set Connection = '1' where  Chatting_ID = '$Chatting_ID'";
          $querysn = "update chatting_connector set Connection = '0' where  Chatting_ID != '$Chatting_ID'";
          mysqli_query($conn, $querys);
          mysqli_query($conn, $querysn);
          mysqli_close($conn);
        }
        elseif($resulti['Chatting_ID'] != $Chatting_ID)
        {
          $querys = "update chatting_connector set Connection = '1' where  Chatting_ID = '$Chatting_ID'";
          $querysn = "update chatting_connector set Connection = '0' where  Chatting_ID != '$Chatting_ID'";
          $query = "Insert into studentchatting(Student1,Student2,Chatting_ID,ProfilePhoto,StudentName,ChattingTime,ChattingDay,Alert_Of_Income_text,Clear_ID) values ('$EmailOrPhone','$StudentID','$Chatting_ID','$Mypicture','$StudentFirstName','$ChattingTime','$ChattingDay','0','1')";
          mysqli_query($conn, $querys);
          mysqli_query($conn, $querysn);
          mysqli_query($conn, $query);
          mysqli_close($conn);
        }
      }
    }
    else
    {
          $querys = "update chatting_connector set Connection = '1' where  Chatting_ID = '$Chatting_ID'";
          $querysc = "update chatting_connector set Connection = '0' where  Chatting_ID != '$Chatting_ID'";
          $query = "Insert into studentchatting(Student1,Student2,Chatting_ID,ProfilePhoto,StudentName,ChattingTime,ChattingDay,Alert_Of_Income_text,Clear_ID) values ('$EmailOrPhone','$StudentID','$Chatting_ID','$Mypicture','$StudentFirstName','$ChattingTime','$ChattingDay','0','1')";
          mysqli_query($conn, $querys);
          mysqli_query($conn, $querysc);
          mysqli_query($conn, $query);
          mysqli_close($conn);
    }
}
?>
<?php
//student profile
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
      $Gendert = $result['Gender'];
    }
 }
 ?>
<header>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://code.jquery.com/jquery-latest.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script src='https://code.jquery.com/jquery-2.1.3.min.js'></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-latest.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="RegisterStyleAndLoginStyles.css">
  <link rel="stylesheet" type="text/css" href="HomeStyles.css">
  <script src="MyJavaScript.js"></script>
</header>
<div id="MyLoader" style="margin-top:3.9%">

</div>
<body onload="Loader()" style="background-color:#0F52BA">
  <nav class="nav navbar-fixed-top  NavBarStyle">
      <div class="btn-group" role="group" style="margin-left:220px;margin-top:1%">
         <input type="text" class="input-search" placeholder="Search.." style="outline: none;float:left;padding-left:10px"/>
         <button class="btn-xs btn btn-primary" style="height:52%;width:60px">Seach</button>
      </div>
  </nav>
<div id='scrolly'>

<br/>
</div>
  <nav id="MySideBar" class="nav navbar-left navbar-fixed-top SidebarStyle">
    <div style="width: 100%;height:8%;background-color:#0F52BA;border-bottom-style: solid;border-bottom-width: thin;border-bottom-color: black;">
      <img src="Photos/IMG_0796.png" style="height: 96%"/>
    </div>
    <br/>
    <a title="Profile" href="Profile.php"><img  src="<?php
    if($Photo == '')
    {
      if($Gendert == 'Male')
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
     ?>" style="float: left;height: 8%;width:50px;border-radius:100px;background-color:lightgray"/></a>
    <h4 class="card-tittle" style="float:left;margin-Left:2%;margin-top:10%;font-size:15px;font-family:'Cambria';font-weight:bold"><?php echo $FirstName ?></h4><h4 style="font-family: 'Cambria';float: left;margin-left:3%;font-size: 15px;margin-Top:10%;font-weight: bold"><?php echo $LastName ?></h4><br/><br/>
    <br/><br/>
    <li style="background-color: lightblue">
      <a href="Home.php" style="cursor: pointer;color: navy;border-width:1px;color: navy;border-bottom-style:solid;margin-top:-10%;font-size:95%;font-family:'arial Narrow'"><i class="glyphicon glyphicon-home" style="cursor: pointer ;color:navy;height: 24px;font-size: 17px;float:left"></i><h8 style="margin-left: 4%;">Home Panel</h8></a>
      <a href="Profile.php" style="cursor: pointer;color: navy;border-width:1px;border-bottom-style:solid;font-size:95%;font-family:'arial Narrow'"><i class="fas fa-user-graduate" style="cursor: pointer ;color: navy;height: 24px;font-size: 17px;float:left"></i><h8 style="margin-left: 4%">Profile</h8></a>
      <a href="MyGroup.php" style="cursor: pointer;color: navy;border-width:1px;border-bottom-style:solid;font-size:95%;font-family:'arial Narrow'"><i class="fas fa-user-friends" style="cursor: pointer ;color: navy;height: 24px;font-size: 17px;float:left"></i><h8 style="margin-left: 4%">My Groups</h8></a>
      <a  style="cursor: pointer;color: navy;border-width:1px;border-bottom-style:solid;font-size:95%;font-family:'arial Narrow'"><i class="fa fa-group" style="cursor: pointer ;color: navy;height: 24px;font-size: 17px;float:left"></i><h8 style="margin-left: 4%">Other Groups</h8></a>
      <a  style="cursor: pointer;color: white;background-color: navy;border-width:1px;border-bottom-style:solid;font-size:95%;font-family:'arial Narrow'"><i class="glyphicon glyphicon-comment" style="cursor: pointer ;color: white;height: 24px;font-size: 17px;float:left"></i><h8 style="margin-left: 4%">Chatting Room</h8></a>
    </li>
    <div style=";padding-left:2%;padding-right:1%;border-top-style: solid;border-top-width: thin;border-top-color: red;margin-top:120%;background-color:lightblue;width:100%;height:20%">
      <img src="Photos/IMG_0941.png" style="float:left;height:15%;margin-top:3%"/><br/>
      <h5 style="font-size:69%;font-family:'Times New Roman';font-style:oblique">chatting between two patner is secure between two ends</h5>
    </div>
  </nav>
 <center><label id="OfflineAlert" style="font-size:70%;width:20%;float: right;margin-top:1%;margin-right:-4%;background-color:white;color:red;padding:1%;box-shadow: 2px 2px 6px 1px rgba(1, 1, 1, 0.3);border-radius:5px"><i class="fa fa-plug"></i><h7 style="margin-left:1%">Your Offline</h7><label/></center>
 <div id="ShowChattingPanel">

 </div>

</body>

<div class="nav navbar-fixed-top" style="background-color: white;width:17%;height:100%;float:right;margin-left: 83.1%;border-radius:0;padding:0;border-width:0;margin-Top:0%;box-shadow: 2px 2px 6px 1px rgba(1, 1, 1, 0.3);">
  <div style="width: 100%;height:10.8%;background-color:#0F52BA;border-bottom-style: solid;border-bottom-width: thin;border-bottom-color: black;">
    <i class="fa fa-comments"  style="font-size: 180%;margin-left:3%;margin-top:5%"></i><h8 style="font-family:'Times New Roman';color:white;margin-left:2%;font-size:83%">Chatting History</h8>
  </div>
  <div id="MyChattingHistory">

  </div>
</div>

<audio id="myAudio" preload="auto">
      <source src="Photos/case-closed.mp3"></source>
</audio>
<script>
    var x = document.getElementById("myAudio");
    function playAudio()
    {
    x.play();
    }
</script>
<script type="text/javascript">
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
$(document).ready(function()
{
  //Auto reflesh
  setInterval(function(){
   DisplayThePatner();
   LoadingMyChattingHistory();
 }, 5000);
 setInterval(function(){
  displayDataMessages();
  isOnline();
}, 500);
  //auto reflesh end
  displayDataMessages();
  isOnline();
  DisplayThePatner();
  LoadingMyChattingHistory();
function isOnline()
{
    var online = navigator.onLine;
    // Detecting the internet connection
    var OfflineAlert = document.getElementById('OfflineAlert');
    if(online)
    {
       OfflineAlert.style.display = 'none';
       OfflineAlert.style.marginRight = '-4%';
       OfflineAlert.style.transition = '0.5s';
       Online();
    }
    else
    {
       //alert('You\'re Offline now...');
       OfflineAlert.style.display = 'block';
       OfflineAlert.style.marginRight = '15%';
       OfflineAlert.style.transition = '0.5s';
       Offline();
    }
}
function Online(){
  $.ajax({
    url: "ChattingServer.php",
    type: "POST",
    async: false,

    data:{
      "Online": 1
    },
     success: function(data){
        //
    }
  })
}
function Offline(){
  $.ajax({
    url: "ChattingServer.php",
    type: "POST",
    async: false,

    data:{
      "Offline": 1
    },
     success: function(data){
        //
    }
  })
}
});
ShowChatting();
 function displayDataMessages(){
   $.ajax({
     url: "ChattingServer.php",
     type: "POST",
     async: false,

     data:{
       "displayChatting": 1
     },
      success: function(data){
         $("#Body").html(data);
     }
   })
 }
 function ShowChatting()
 {
   $.ajax({
     url: "ChattingServer.php",
     type: "POST",
     async: false,

     data:{
       "OpenChattingPanel": 1
     },
      success: function(data){
         $("#ShowChattingPanel").html(data);
     }
   })
 }
 $("#ShowSend").click(function(){
    var SendShow = document.getElementById('ShowSend');
    var TextInput = $("#TextInput").val();
    var GMname = $("#GMname").val();
    var Mypicture = $("#Mypicture").val();
    $.ajax({
      url: "ChattingServer.php",
      type: "post",
      async: false,
      data: {
            "SendTheMessage":1,
            "Message":TextInput,
            "GMname":GMname,
            "Mypicture":Mypicture
            },
            success: function(data){
            displayDataMessages();
            $("#TextInput").val('');
            SendShow.style.display = 'none';
            playAudio();
        }
    });
 });
 $.ajax({
   url: "ChattingServer.php",
   type: "POST",
   async: false,
   data:{
     "displayChatting": 1
   },
    success: function(data){
       $("#Body").html(data);
   }
 })
 function DisplayThePatner()
 {
   $.ajax({
     url: "ChattingServer.php",
     type: "POST",
     async: false,
     data:{
       "displayPatner": 1
     },
      success: function(data){
         $("#scrolly").html(data);
     }
   })
 }

 $.ajax({
   url: "ChattingServer.php",
   type: "POST",
   async: false,
   data:{
     "displayPatner": 1
   },
    success: function(data){
       $("#scrolly").html(data);
   }
 })
function ClickBoxToshow()
{
var SendShow = document.getElementById('ShowSend');
SendShow.style.transition = '0.9s';
SendShow.style.display = 'block';
SendShow.style.color = 'blue';
}
function DeleteThisChatting()
{
  $.ajax({
  url: "ChattingServer.php",
  type: "POST",
  async: false,
  data:{
    "deleteChats": 1
  },
   success: function(data)
   {
     ///
  }
})
}
function LoadingMyChattingHistory()
{
$.ajax({
url: "ChattingServer.php",
type: "POST",
async: false,
data:{
  "loadingChattingHistory": 1
},
 success: function(data)
{
   $("#MyChattingHistory").html(data);
}
})
}
</script>
<style >
#scrolly{
width: 68%;
height: 23%;
overflow: auto;
overflow-y: hidden;
margin: 0 auto;
overflow-x: auto;
border-radius: 0px;
white-space: nowrap;
margin-top:2%;
margin-left: 15.1%;
padding-left: 0%;
padding-right: 0.6%;
box-shadow: 0px 1px 3px 1px rgba(1,1,1,0.3);
border-bottom-style: solid;
border-bottom-width:thin;
border-bottom-color:white;
}
.StyleMe
{
width: 120px;
height: 132px;
margin-left:0.5%;
margin-top: 0.4%;
border-radius: 5px;
border-color: navy;
border-top-width:0;
border-style: solid;
border-width: thin;
background-color: white;
display:  inline-block;
box-shadow: 0px 1px 3px 1px rgba(1,1,1,0.3);
padding-bottom: 2%;
}
.StyleFriend
{
width: 100%;
height: 80%;
margin-left:0%;
margin-top: 0%;
padding: 0.1%;
display:  inline-block;
}
.div
{
position: relative;
overflow: hidden;
margin-top: -10%;
}
.input
{
position: absolute;
font-size: 50px;
opacity: 0;
right: 0;
top: 0;
}
.HoverChattingHistory:hover
{
background-color: navy;
}
.zoomPicture:hover
{
  transform: scale(3.8,3.8);
  transition: 0.5s;
}
.close:hover
{
  color:red;
}
</style>
</html>
