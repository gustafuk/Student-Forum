<?php
include 'Session.php';
$EmailOrPhone = $_SESSION['EmailAddressOrPhoneNumber'];
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
    $Gender = $result['Gender'];
  }
}
?>
<?php
$conn = mysqli_connect("localhost","root","","scholardiscussiondata");
$query = "select * from scholardetails where DOB !='' and EmailAddressOrPhoneNumber != '$EmailOrPhone' and LevelOfEducation like '$Level'";
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
  }
}
?>
<?php if(isset($_POST['SendQuestions']))
{
 include("db.php");
  $file_tmp=$_FILES['ThePicture']["tmp_name"];
  $file_name=$_FILES['ThePicture']["name"];
  $file_type=$_FILES['ThePicture']["type"];
  $path = basename($_FILES['ThePicture']['name']);
  $QuestionDescr = $_POST['QuestionDescr'];
  $PostTime = date('H:ia');
  $PostDay = date('M d');
  move_uploaded_file($file_tmp,$path);
  if(!$conn)
  {
  die('server not connected');
  }
  else
  {
  if($file_name == '')
  {
    $query = "insert into scholaruploadingquestions(EmailAddressOrPhoneNumber,Descriptions,ProfilePhoto,FirstName,LastName,Level,PostTime,PostDay) values ('$EmailOrPhone','$QuestionDescr','$Photo','$FirstName','$LastName','$Level','$PostTime','$PostDay')";
    mysqli_query($conn, $query);
    mysqli_close($conn);
  }
  else
  {
    $query = "insert into scholaruploadingquestions(EmailAddressOrPhoneNumber,Descriptions,QuestionsPhotos,ProfilePhoto,FirstName,LastName,Level,PostTime,PostDay) values ('$EmailOrPhone','$QuestionDescr','$path','$Photo','$FirstName','$LastName','$Level','$PostTime','$PostDay')";
    mysqli_query($conn, $query);
    mysqli_close($conn);
  }
  }
}
?>
<?php if(isset($_POST['SendMyComment']))
{
  include("db.php");
  $file_tmp=$_FILES['AnswerPicture']["tmp_name"];
  $file_name=$_FILES['AnswerPicture']["name"];
  $file_type=$_FILES['AnswerPicture']["type"];
  $path = basename($_FILES['AnswerPicture']['name']);
  $AnswerComments = $_POST['AnswerComments'];
  $SenderID = $_POST['SenderID'];
  $SenderPid = $_POST['SenderPid'];
  $PostTime = date('H:ia');
  $PostDay = date('M d');
  move_uploaded_file($file_tmp,$path);
  if(!$conn)
  {
  die('server not connected');
  }
  else
  {
  if($file_name == '')
  {
    $query = "insert into comments(CommenterID,CommentedID,Comments,QuestionID,Day_Of_Comment,Time_Of_Comment,FirstName,LastName,Profile) values ('$EmailOrPhone','$SenderID','$AnswerComments','$SenderPid','$PostDay','$PostTime','$FirstName','$LastName','$Photo')";
    mysqli_query($conn, $query);
    mysqli_close($conn);
  }
  else
  {
    $query = "insert into comments(CommenterID,CommentedID,QuestionPhoto,Comments,QuestionID,Day_Of_Comment,Time_Of_Comment,FirstName,LastName,Profile) values ('$EmailOrPhone','$SenderID','$path','$AnswerComments','$SenderPid','$PostDay','$PostTime','$FirstName','$LastName','$Photo')";
    mysqli_query($conn, $query);
    mysqli_close($conn);
  }
  }
}
?>
<html >
<header>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://code.jquery.com/jquery-latest.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script src='https://code.jquery.com/jquery-2.1.3.min.js'></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
<link rel="stylesheet" type="text/css" href="RegisterStyleAndLoginStyles.css">
<link rel="stylesheet" type="text/css" href="HomeStyles.css">
<script src="MyJavaScript.js"></script>
</header>

<body style="background-color:#0F52BA">
<nav class="nav navbar-fixed-top  NavBarStyle" style="  border-bottom-style: solid;border-bottom-width: thin;border-bottom-color: black;">
<div style="padding-right:0.4%;padding-left:0.4%"><a>
  <input  type="googlesearch" name="SeachFriends" id="SearchBox" placeholder="search.." class="search thumbnail backgroudIconSearch" style="outline:none;padding-left: 1%;float: left;margin-left:16%;margin-top:0.8%;width:20%;height:50%;border-radius:0"/></a>
  <button class="btn-xs btn btn-primary" type="button"  style="margin-top:0%;height:51%;border-radius:0">search</button>
<a href="Library.php"><i data-toggle="tooltip" title="Universal Library" data-placement="bottom" style="margin-left:5%;margin-top:-1.6%;font-size:120%;color:lightgray;cursor:pointer;padding-top:1%;padding-bottom:1%;padding-left:2%;padding-right:2%" class="fa fa-book-reader BackColor"></i></a>
<a href="BirthdayPanel.php"><i data-toggle="tooltip" title="Students events" data-placement="bottom" style="margin-left:0%;font-size:120%;color:lightgray;cursor:pointer;padding-top:1%;padding-bottom:1%;padding-left:2%;padding-right:2%" class="
fa fa-birthday-cake BackColor"><h7 id="AleertBirthday" style="transition:1s"></h7></i><a/>
<title id="TheAlert"></title>

</div>
<i id="SortDownDrop" onclick="onclickMeShow()" class="glyphicon glyphicon-triangle-bottom" style="float:right;margin-right:2%;color:black;margin-top:-1.5%;cursor:pointer"></i><br/></br/><br/>
<div id="DownshowShow" style="display:none;width:158px;padding-top:-1%;background-color: white;padding-left: 0%;padding-right: 0%;margin-top:-48px;height:120px;float: right;margin-right:1%;padding-bottom:6%; box-shadow: 0px 1px 3px 1px rgba(1,1,1,0.3);border-radius:3px;border-style:solid;border-width:thin;border-color:navy">
<div id="AllowUpload" class="arrow-up" style="width: 0;height:0;position: absolute;border-left: 10px solid transparent;border-right:10px solid transparent;border-bottom:15px solid white;right: 1.6%;bottom:-6px;border-top-color:black;"></div>
  <div style="margin-left:10px"><i class="fa fa-signing" style="float: left;margin-top:10px;color:black"></i><h7 style="margin-left:3%;font-size:80%;margin-top:10px;float:left;color:black;font-weight:bold">Action center</h7></div>
  <a onclick="MeID()"><button class="btn-xs btn btn-default LogOutPanel" style="width:100%;border-radius:0;margin-top:10px;border-bottom-width:0;text-align:left;padding-left:10%;border-left-width:0;border-right-width:0">close</button></a>
  <a><button class="btn-xs btn btn-default LogOutPanel" style="width:100%;border-radius:0;text-align:left;padding-left:10%;border-left-width:0;border-right-width:0;border-width:0">help</button></a>
  <a href="LogOut.php"><button class="btn-xs btn btn-default LogOutPanel" style="width:100%;border-radius:0;text-align:left;padding-left:10%;border-top-width:0;border-left-width:0;border-right-width:0">Sign out</button></a>
</div>
</nav>
<nav id="MySideBar" class="nav navbar-left navbar-fixed-top SidebarStyle">
<div style="width: 100%;height:8%;background-color:#0F52BA;border-bottom-style: solid;border-bottom-width: thin;border-bottom-color: black;">
<img  src="Photos/IMG_0796.png" style="height: 96%"/>
</div>
<br/>
<a title="Profile" href="Profile.php"><img  src="<?php
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
 ?>" style="float: left;height: 50px;width:50px;border-radius:100px;background-color:lightgray"/></a>
<h4 class="card-tittle" style="float:left;margin-Left:2%;margin-top:10%;font-size:15px;font-family:'Cambria';font-weight:bold"><?php echo $FirstName ?></h4><h4 style="font-family: 'Cambria';float: left;margin-left:3%;font-size: 15px;margin-Top:10%;font-weight:bold"><?php echo $LastName ?></h4><br/><br/>
<br/><br/>
<li style="background-color: lightblue">
<a  style="cursor: pointer;color: navy;border-width:1px;background-color: navy;color: white;border-bottom-style:solid;margin-top:-10%;font-size:95%;font-family:'arial Narrow'"><i class="glyphicon glyphicon-home" style="cursor: pointer ;color: white;height: 24px;font-size: 17px;float:left"></i><h8 style="margin-left: 4%;">Home Panel</h8></a>
<a href="Profile.php" style="cursor: pointer;color: navy;border-width:1px;border-bottom-style:solid;font-size:95%;font-family:'arial Narrow'"><i class="fas fa-user-graduate" style="cursor: pointer ;color: navy;height: 24px;font-size: 17px;float:left"></i><h8 style="margin-left: 4%">Profile</h8></a>
<a href="MyGroup.php" style="cursor: pointer;color: navy;border-width:1px;border-bottom-style:solid;font-size:95%;font-family:'arial Narrow'"><i class="fas fa-user-friends" style="cursor: pointer ;color: navy;height: 24px;font-size: 17px;float:left"></i><h8 style="margin-left: 4%">My Groups</h8></a>
<a  style="cursor: pointer;color: navy;border-width:1px;border-bottom-style:solid;font-size:95%;font-family:'arial Narrow'"><i class="fa fa-group" style="cursor: pointer ;color: navy;height: 24px;font-size: 17px;float:left"></i><h8 style="margin-left: 4%">Other Groups</h8></a>
<a href="ChattingRoom.php" style="cursor: pointer;color: navy;border-width:1px;border-bottom-style:solid;font-size:95%;font-family:'arial Narrow'"><i class="glyphicon glyphicon-comment" style="cursor: pointer ;color: navy;height: 24px;font-size: 17px;float:left"></i><h8 style="margin-left: 4%">Chatting Room</h8></a>
</li>
</nav>
<center>
<div  style="margin-left:2%;border-radius:0;background-color:white;margin-top:2%;border-bottom-left-radius:5px;border-bottom-right-radius:5px;width:68%;height:20%;padding-top:4%;padding-bottom:4%;border-bottom-style:solid;border-bottom-width:thin;border-bottom-color:navy">
  <h1 style="margin-top:-2%;font-weight:bold;color:#0F52BA;font-family:'Colonna MT';font-size:320%">STUDENT FORUM</h1>
  <h7 style="font-size:65%">Student Discussion, Learning ,Chatting and Sharing of different ideas</h7>
</div>
<?php
if($DOB == '')
{

}
else
{
 $bday  = new DateTime($DOB);
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

   if($diff->format('%a') == 0)
   {

   }
 }
 else
 {
   if($diff->format('%a') == 0)
   {
       ?>
       <div id="RemoveThis" style="width:68%;height:43%;border-radius:1px;margin-left:2%;background-color:white;background-image:url('Photos/wp2714640-happy-birthday-background-hd.jpg');background-size:cover;border-bottom-style:solid;border-bottom-width:thin;border-bottom-color:white;box-shadow: 0px 2px 4px 2px rgba(1,1,1,0.3);margin-top:0.3%">
          <a onclick="RemoveBirthdayAlert()"><i title="Close this birthday alert" class="fa fa-times closeMe" style="float:right;border-radius:0px;margin-right:0.5%;margin-top:0.5%;font-size:110%;padding-top:0.1%;padding-bottom:0.1%;;padding-left:0.4%;padding-right: 0.4%;background-color:black;color:white;cursor:pointer;border-style:solid;border-width:thin;border-color:white"></i></a>
          <img src="Photos/happy-birthday-cake-gif.gif" style="width:30%;height:50%;margin-Top:5%;border-style:solid;border-width:thin;border-color:black">
          <br/><br/><center><h7 style="margin-left:-3%;text-shadow:1px 1px 1px 1px rgba(1,1,1,0.3);font-weight:bold;color:red">Today is your HappyBirthDay <?php echo $FirstName ?> <?php echo $LastName ?><br/></h7>
          <h7 style="margin-left:-4%;font-family: 'Times New Roman';font-weight:bold">have a long life my friend</h7>
          </center>
       </div>
       <?php
   }
 }
}
?>
<center ><h6 id="CloseFriendHeader" class="thumbnail" style="width:180px;margin-top:-1%;padding:0.5%;font-size:80%;color:black;margin-left: 2%;font-weight:bold;border-style:double;border-width:thin;border-color:navy">
  <i class="fa fa-handshake-o" style="float:left;margin-top:0.5%;font-size:160%"></i>your fellow students<i class="fa fa-handshake-o" style="float:right;margin-top:0.5%;font-size:160%"></i></h6></center>
<div id='scrolly'>

<br/>
</div>
<br/>
<div  class="card" style="width:68%;height:141px;padding:1%;border-radius:5px;box-shadow: 0px 1px 3px 1px rgba(1,1,1,0.3);margin-Left:2%;background-color:white;margin-top:-1%;border-bottom-style: solid;border-bottom-width: 1px;border-bottom-color:black">
<img  src="<?php
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
?>" style="float: left;height: 48px;width:50px;border-radius:100px;background-color:lightgray;border-style:solid;border-width:1.5px;border-color:gray"/>
<form method="post" action="#" enctype="multipart/form-data">
<input onclick="InputDesc()" id="QuestionDescr" name="QuestionDescr" autocomplete="off" required  type="text" placeholder="What's your questions?" maxlength="50" style="padding-bottom: 1%;color:navy;outline:none;text-align: left;border-width: 0;float: left;margin-left:2%;margin-top:2.5%;width:40%;border-bottom-style:solid;border-bottom-width:0px;border-bottom-color:#0F52BA;border-radius:0;padding-left:1%"/>
<div title="image preview" id="image_preview"><img class="thumbnail" id="previewing" src="Photos/image-icon (2).png"  style="float:right;height:50%;width:50px"/></div>
<br/><br/><br/><hr/>
<div class="btn-group" role="group" style="float:left;width:25%;margin-top:-12px">
  <div class="div file btn btn-sm btn-primary" style="margin-top:0%;width:50%">
    <input name="ThePicture" id="ThePicture" title="Choose Question Photo" class="input" type="file" style="cursor: pointer"/><h8>Photo</h8>
  </div>
  <button type="submit" name="SendQuestions" title="Post Your question to get help" class="btn-sm btn btn-default"  style="cursor:pointer;width:50%;font-weight:bold">Post</button>
</div>
</form>
<div id="message"></div>
<br/><br/>
</div>
  <div id="LoadQuestions">

  </div>
 </body>
</center>
<audio id="myAudio2" preload="auto">
    <source src="Photos/shut-your-mouth.mp3"> </source>
</audio>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
var x = document.getElementById("myAudio2");
function playAudio2()
{
 x.play();
}
</script>
<script>
function LoadTheComments2()
{
  var TheReplies2 = document.getElementById('TheReplies2');
  if(TheReplies2.style.display == 'none')
  {
    TheReplies2.style.display = 'block';
    TheReplies2.style.transition = '0.5s';
  }
  else
  {
    TheReplies2.style.display = 'none';
  }
}
function LoadTheComments1()
{
  var TheReplies1 = document.getElementById('TheReplies1');
  if(TheReplies1.style.display == 'none')
  {
    TheReplies1.style.display = 'block';
    TheReplies1.style.transition = '0.5s';
  }
  else
  {
    TheReplies1.style.display = 'none';
  }
}
function InputDesc()
{
var QuestionDescr = document.getElementById('QuestionDescr');
  if(QuestionDescr.style.borderBottomWidth == '0px')
  {
    QuestionDescr.style.borderBottomWidth= '2px';
    QuestionDescr.style.transition = '0.3s';
  }
}
function InputDescClose()
{
  var QuestionDescr = document.getElementById('QuestionDescr');
    if(QuestionDescr.style.borderBottomWidth == '2px')
  {
    QuestionDescr.style.borderBottomWidth = '0px';
    QuestionDescr.style.transition = '0.3s';
  }
}
function onclickMeShow()
{
var SortDownDrop = document.getElementById('SortDownDrop');
var DownshowShow = document.getElementById('DownshowShow');
  if(DownshowShow.style.display == 'none')
  {
    SortDownDrop.style.color = 'white';
    DownshowShow.style.display = 'block';
    SortDownDrop.style.transition = '0.3s';
    DownshowShow.style.transition = '0.3s';
  }
  else
  {
    SortDownDrop.style.color = 'black';
    DownshowShow.style.display = 'none';
    SortDownDrop.style.transition = '0.3s';
    DownshowShow.style.transition = '0.3s';
  }
}
function MeID()
{
  var SortDownDrop = document.getElementById('SortDownDrop');
  var DownshowShow = document.getElementById('DownshowShow');
    if(DownshowShow.style.display == 'none')
    {
      SortDownDrop.style.color = 'white';
      DownshowShow.style.display = 'block';
      SortDownDrop.style.transition = '0.5s';
      DownshowShow.style.transition = '0.5s';
    }
    else
    {
      SortDownDrop.style.color = 'black';
      DownshowShow.style.display = 'none';
      SortDownDrop.style.transition = '0.5s';
      DownshowShow.style.transition = '0.5s';
    }
}
</script>
<audio id="myAudio4" preload="auto">
    <source src="Photos/base.mp3"> </source>
</audio>
<script>
var y = document.getElementById("myAudio4");
function playAudio4()
{
y.play();
}
</script>
<script>
function onSearch()
{
var FormSearch = document.getElementById('FormSearch');
if(FormSearch.style.marginTop == '-26%')
{
FormSearch.style.marginTop = '-1';
}
else
{
FormSearch.style.marginTop = '-26%';
}

}
$(function()
{
$('[data-toggle="popover"]').popover()
})
function OnclickSearch(){
var FormSearch = document.getElementById('FormSearch');
if(FormSearch.style.display == 'none')
{
FormSearch.style.display = 'block';
FormSearch.style.transition = '0.6s';
}
else {
FormSearch.style.display = 'none';
FormSearch.style.transition = '0.6s';
}
}
function RemoveBirthdayAlert()
{
var RemoveThis = document.getElementById('RemoveThis');
RemoveThis.style.display = 'none';
playAudio4();
RemoveThis.style.transition: '0.3s';

}
function onclickMe()
{
var Downshow = document.getElementById('Downshow');
if(Downshow.style.display == 'none')
{
Downshow.style.display = 'block';
}
else {
Downshow.style.display = 'none';
}
}
</script>
<script>
$(document).ready(function()
{
//Auto reflesh
setInterval(function(){
 displayMyNewPatner();
 LoadBirthdayAlert();
 BirthdayAlerts();
 LoadBirthdayAlertToTittle();
}, 5000);
  //auto reflesh end
});
displayMyNewPatner();
LoadBirthdayAlert();
BirthdayAlerts();
LoadBirthdayAlertToTittle();
function displayDataFromDatabase()
{
$.ajax({
url: "HomeIsertQuestions.php",
type: "POST",
async: false,
data:{
"SelectQuestionPhotos": 1
},
success: function(data){
$("#LoadQuestions").html(data);
}
})
}
function LoadBirthdayAlert()
{
$.ajax({
url: "HomeIsertQuestions.php",
type: "POST",
async: false,
data:{
"LoadBirthDay": 1
},
success: function(data){
$("#AleertBirthday").html(data);
}
})
}

function LoadBirthdayAlertToTittle()
{
$.ajax({
url: "HomeIsertQuestions.php",
type: "POST",
async: false,
data:{
"LoadBirthDay": 1
},
success: function(data){
$("#TheAlert").html(data);
}
})
}
//select question photos by using ajax
$.ajax({
url: "HomeIsertQuestions.php",
type: "POST",
async: false,
data:{
"SelectQuestionPhotos": 1
},
success: function(data){
$("#LoadQuestions").html(data);
}
})
</script>
<script>
  //script adding Friend
  $(document).ready(function()
  {
  $("#AddPatner").click(function(){
  var PatnerID = $("#PatnerID").val();
  $.ajax({
  url: "AddingPatner.php",
  type: "post",
  async: false,
  data: {
  "Padd":1,
  "PatnerID":PatnerID
  },
  success: function(data)
  {
  displayMyNewPatner();
  }
  });
  });
  });
  function displayMyNewPatner()
  {
  var SearchBox = $("#SearchBox").val();
  $.ajax({
  url: "AddingPatner.php",
  type: "POST",
  async: false,
  data:{
  "SearchFriend": 1,
  "SearchBox":SearchBox
  },
  success: function(data){
  $("#scrolly").html(data);
  }
  })
  }

  function BirthdayAlerts()
  {
  $.ajax({
  url: "HomeIsertQuestions.php",
  type: "POST",
  async: false,
  data:{
  "ShowBirthdayAlert": 1
  },
  success: function(data)
  {
   ///
  }
  })
  }
</script>
<script>

$(document).ready(function (e) {
$("#SendQuestion").on('submit',(function(e) {
e.preventDefault();
$("#message").empty();
$('#loading').show();
$.ajax({
url: "SendQuestions.php", // Url to which the request is send
type: "POST",             // Type of request to be send, called as method
data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
contentType: false,       // The content type used when sending data to the server.
cache: false,             // To unable request pages to be cached
processData:false,        // To send DOMDocument or non processed data file it is set to false
success: function(data)   // A function to be called if request succeeds
{
$('#loading').hide();
$("#message").html(data);
}
});
}));
// Function to preview image after validation
$(function() {
$("#ThePicture").change(function() {
$("#message").empty(); // To remove the previous error message
var file = this.files[0];
var imagefile = file.type;
var match= ["image/jpeg","image/png","image/jpg"];
if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
{
$('#previewing').attr('src','noimage.png');
$("#message").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
return false;
}
else
{
var reader = new FileReader();
reader.onload = imageIsLoaded;
reader.readAsDataURL(this.files[0]);
}
});
});
function imageIsLoaded(e) {
$("#ThePicture").css("color","green");
$('#image_preview').css("display", "block");
$('#previewing').attr('src', e.target.result);
$('#previewing').attr('width', '250px');
$('#previewing').attr('height', '230px');
};
});
</script>
<style >
#scrolly{
width: 68%;
height: 25%;
overflow: auto;
overflow-y: hidden;
margin: 0 auto;
overflow-x: auto;
border-radius: 0px;
white-space: nowrap;
margin-top:-1.5%;
margin-left: 17%;
padding-left: 0.3%;
padding-right: 1%;
background-color: transparent;
border-color: white;
border-style: solid;
border-width: 0;
border-left-width: 1px;
border-left-style: solid;
border-left-color:white;
border-right-width: 1px;
border-right-style: solid;
border-right-color:white;
}
.StyleMe
{
width: 125px;
height: 140px;
margin-left:1%;
margin-top: 0.4%;
border-radius: 5px;
display:  inline-block;
border-color: white;
padding-left: 0;
border-style: solid;
border-width: thin;
box-shadow: 0px 1px 3px 1px rgba(1,1,1,0.3);
padding-bottom: 2%;
}
.StyleFriend
{
width: 100%;
height: 80%;
margin-left:0%;
margin-top: 0%;
padding: 0%;
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
.BackColor:hover
{
background-color: navy;
}
.closeMe:hover
{
opacity: 0.8;
}
.HoverColor:hover
{
 background-color:#0F52BA;
 color:white;
 border-left-style:solid;
 border-left-width:thin;
 border-left-color:navy;
 border-right-style:solid;
 border-right-width:thin;
 border-right-color:navy;
}
.BorderColorInput
{
  border-width:0;
  border-color:transparent;
  border-style:solid;
}
.LogOutPanel:hover
{
  background-color:#0F52BA;
  color:white;
  border-top-style: solid;
  border-top-width:thin;
  border-top-color:black;
  border-bottom-style: solid;
  border-bottom-width:thin;
  border-bottom-color:black;
  font-weight:bold;
}
</style>
</html>
