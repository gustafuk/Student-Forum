<html>
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
while ($resultw = mysqli_fetch_assoc($data))
{
$FirstNamCreator = $resultw['FirstName'];
$Pprofile = $resultw['ProfilePhoto'];
}
}
?>
<?php
$conn = mysqli_connect("localhost","root","","scholardiscussiondata");
$query = "select * from scholar_group_members where Members = '$EmailOrPhone' and Active = '1'";
$data = mysqli_query($conn, $query);
$Total = mysqli_num_rows($data);
if ($Total!=0)
{
  while ($resultLoadGroupID = mysqli_fetch_assoc($data))
  {
    $GroupIDMe = $resultLoadGroupID['Group_MemberID'];
    $Members = $resultLoadGroupID['Members'];
    $conn = mysqli_connect("localhost","root","","scholardiscussiondata");
    $query = "select * from groups where GroupID like '$GroupIDMe'";
    $data = mysqli_query($conn, $query);
    $Total = mysqli_num_rows($data);
    if ($Total!=0)
    {
    while ($resultw = mysqli_fetch_assoc($data))
    {
      $GroupIDii = $resultw['GroupID'];
      $GroupName = $resultw['GroupName'];
      $GroupImage = $resultw['GroupImage'];
      $GroupDescription = $resultw['GroupDescription'];
      $GroupLeader = $resultw['GroupReader'];
    }
    }
  }
}
?>
<?php if(isset($_POST['AddToMyGroup']))
{
  $PatnerEmail = $_POST['PatnerEmail'];
  $PatnerName = $_POST['GroupMemberName'];
  $ProfilePhoto = $_POST['GroupMemberProfilePhoto'];
  $conn = mysqli_connect('localhost','root','','scholardiscussiondata');
  if(!$conn)
   {
     die('server not connected');
   }
  else
  {
      $conn = mysqli_connect("localhost","root","","scholardiscussiondata");
      $query = "select * from scholar_group_members where Members = '$EmailOrPhone' and Active = '1'";
      $data = mysqli_query($conn, $query);
      $Total = mysqli_num_rows($data);
      if ($Total!=0)
      {
        while ($resultLoadGroupID = mysqli_fetch_assoc($data))
        {
           $MyGroupID = $resultLoadGroupID['Group_MemberID'];
           $MyGroupImage = $resultLoadGroupID['GroupImage'];
           $MyGroupName = $resultLoadGroupID['GroupName'];
           $queryAddMember = "insert into scholar_group_members(Group_MemberID,Members,Members_Names,Members_Profile_picture,Active,GroupImage,GroupName) values ('$MyGroupID','$PatnerEmail','$PatnerName','$ProfilePhoto','1','$MyGroupImage','$MyGroupName')";
           mysqli_query($conn, $queryAddMember);
           mysqli_close($conn);
        }
      }
   }
}
?>
<?php if(isset($_POST['CreateG']))
{
//Create Group
$RecieptNumber = date('s');
$Poi = date('i');
$GroupID = (10000000+($RecieptNumber*$Poi));
$GroupName = $_POST['GroupName'];
$GroupDs = $_POST['GroupDs'];
$file_tmp=$_FILES['GPicture']["tmp_name"];
$file_name=$_FILES['GPicture']["name"];
$file_type=$_FILES['GPicture']["type"];
$path = basename($_FILES['GPicture']['name']);
move_uploaded_file($file_tmp,$path);
$CreatedDay = date('d/M/Y');
$CreatedTime = date('H:ia');
$conn = mysqli_connect('localhost','root','','scholardiscussiondata');
if(!$conn)
{
die('server not connected');
}
else
{
  if($file_name == '')
  {
  //;
  }
  else
  {
  $queryToGroup = "Insert into groups(GroupName,GroupReader,GroupImage,GroupDescription,GroupID,DayOfCreation,TimeOfCreation,Active) values ('$GroupName','$EmailOrPhone','$path','$GroupDs','$GroupID','$CreatedDay','$CreatedTime','0')";
  $queryToMembers = "Insert into  scholar_group_members(Group_MemberID,Members,Members_Names,Members_Profile_picture,GroupImage,GroupName) values ('$GroupID','$EmailOrPhone','$FirstNamCreator','$Pprofile','$path','$GroupName')";
  mysqli_query($conn, $queryToGroup);
  mysqli_query($conn, $queryToMembers);
  mysqli_close($conn);
  }
}
}
?>
<?php
if(isset($_POST['SelectMyGroup']))
{
  $SelectedGroup = $_POST['ID'];
  $conn = mysqli_connect('localhost','root','','scholardiscussiondata');
  if(!$conn)
   {
     die('server not connected');
   }
  else
  {
    $conn = mysqli_connect("localhost","root","","scholardiscussiondata");
    $query = "select * from scholar_group_members where Members = '$EmailOrPhone'";
    $data = mysqli_query($conn, $query);
    $Total = mysqli_num_rows($data);
    if ($Total!=0)
    {
      while ($resultLoadGroupID = mysqli_fetch_assoc($data))
      {
        $querySelect = "update scholar_group_members set Active = '1' where Group_MemberID like '$SelectedGroup'";
        $queryUnselect = "update scholar_group_members set Active = '0' where Group_MemberID != '$SelectedGroup' and Members = '$EmailOrPhone'";
        mysqli_query($conn, $querySelect);
        mysqli_query($conn, $queryUnselect);
        mysqli_close($conn);
      }
    }
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
$Gender = $result['Gender'];
}
}
?>
<?php
$conn = mysqli_connect("localhost","root","","scholardiscussiondata");
$query = "select * from scholar_group_members where Active = '1' and Members = '$EmailOrPhone'";
$data = mysqli_query($conn, $query);
$Total = mysqli_num_rows($data);
if ($Total!=0)
{
  while ($resultLoadGroupID = mysqli_fetch_assoc($data))
  {
    if(($resultLoadGroupID['Members'] == $EmailOrPhone))
    {
      $GroupImages = $resultLoadGroupID['GroupImage'];
      $GroupName = $resultLoadGroupID['GroupName'];
    }
  }
}
 ?>
 <?php
 if(isset($_POST['Savepapers']))
 {
 $conn = mysqli_connect("localhost","root","","scholardiscussiondata");
 $query = "select * from scholar_group_members where Members = '$EmailOrPhone' and Active = '1'";
 $data = mysqli_query($conn, $query);
 $Total = mysqli_num_rows($data);
 if ($Total!=0)
 {
   while ($result = mysqli_fetch_assoc($data))
   {
     $Groupids = $result['Group_MemberID'];
     $PostDay = date('d/M/Y');
     $postTime = date('H:ia');
     $GroupDs = $_POST['GroupDs'];
     $file_tmp=$_FILES['PastpapersAndNotes']["tmp_name"];
     $file_name=$_FILES['PastpapersAndNotes']["name"];
     $file_type=$_FILES['PastpapersAndNotes']["type"];
     $path = basename($_FILES['PastpapersAndNotes']['name']);
     move_uploaded_file($file_tmp,$path);
     $conn = mysqli_connect('localhost','root','','scholardiscussiondata');
     if(!$conn)
     {
     die('server not connected');
     }
     else
     {
       if($file_name == '')
       {
         //;
       }
       else
       {
       $InsertPastPapers = "Insert into student_group_pastpaper_and_notes(Group_ID,Group_Notes_And_PastPapers,Post_Day,Post_Time) values ('$Groupids','$path','$PostDay','$postTime')";
       mysqli_query($conn, $InsertPastPapers);
       mysqli_close($conn);
       }
     }
   }
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
<link href="lib/css/emoji.css" rel="stylesheet">
<link href="dist/emojionearea.css" rel="stylesheet"/>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="RegisterStyleAndLoginStyles.css">
<link rel="stylesheet" type="text/css" href="HomeStyles.css">
<script src="MyJavaScript.js"></script>
</header>
<div id="MyLoader" style="margin-top:3.9%">

</div>
<body onload="Loader()" style="background-color:#0F52BA">
<nav class="nav navbar-fixed-top  NavBarStyle">
<div id="GroupCreator" style="height:289%;width:63%;display:block ;background-color:white;margin-left:18%;margin-top:-36%;border-radius:5px;box-shadow:1px 1px 5px 1px rgba(1,1,1,0.3)">
<div style="height: 60%;width: 100%;padding-top:2%;background-image:url('Photos/IMG_1078.png');background-repeat: no-repeat;background-size: cover;background-attachment: stretch;background-color:#0F52BA">
<center><h2 style="font-weight:bold">Create New Group</h2></center>
<i onclick="CloseCRT()" id="CloseCreator" title="close" class="fa fa-close" style="float:right;margin-top:-9%;margin-right:1%;border-radius:50px;cursor:pointer"></i>
</div>
<div style="width:100%;height:50%;padding:2%">
<form method="post" action="#" enctype="multipart/form-data">
<input required name="GroupName" type="text" placeholder="Group name" style="outline: none;width:28%;padding-left:1%;border-width:0;border-bottom-style: solid;border-bottom-width: thin;border-bottom-color: lightgray"/>
<input required name="GroupDs" type="text" placeholder="Group discription" style="outline: none;width:33%;margin-left:4%;padding-left:1%;border-width:0;border-bottom-style: solid;border-bottom-width: thin;border-bottom-color: lightgray"/>
<div class="btn-group" style="width:30%">
  <div class="div file btn btn-xs btn-default" style="border-radius:2px;margin-top:-0.3%;height:60%;width:50%;padding-top:0.5%;margin-left:2%">
  <input required title="Choose group Profile picture" class="input" type="file" name="GPicture" style="cursor: pointer"/><h8>Group profile image</h8>
  </div>
  <button type="submit" name="CreateG" class="btn-xs btn btn-primary" style="height:60%;margin-top:-1">create</button>
</div>
</form>
</div>
</div>
<!--Group notes and pastpapers-->
<div id="GroupNotesAndPastPapers" class="thumbnail" style="display: none;margin-top:40%;height:390px;width:62%;margin-left:18%;padding:0%;border-width:0.3%;box-shadow: 2px 2px 8px 1px rgba(1, 1, 1, 0.5);border-top-right-radius:9px;border-top-left-radius:9px;border-color:white">
  <div style="width:100%;height:90px;background-color:#0F52BA;background-attachment:fixed;padding-top:1%;border-top-right-radius:8px;border-top-left-radius:8px;background-image:url('<?php echo $GroupImages ?>')">
    <i onclick="CloseGroupPastPapers()" title="close" class="fa fa-close" style="float:right;margin-right:1%;cursor:pointer"></i>
    <center><h2 style="font-weight:bold;font-size:190%">Groups Pastpapers and Notes</h2></center>
    <center><h7 style="font-size:88%;font-weight:bold">This Papers or Notes is the property of <?php echo $GroupName ?></h7></center>
  </div>
  <br/>
  <form method="post" action="#" enctype="multipart/form-data">
  <div class="btn-group" style="width:20%;margin-left:0.5%;float:left">
      <div class="div file btn btn-xs btn-primary" style="height:23px;padding-top:0.5%">
        <input required title="Choose Picture or Image" class="input" type="file" name="PastpapersAndNotes" style="cursor: pointer"/><h8>Choose</h8>
      </div>
      <button type="submit" name="Savepapers" class="btn-xs btn btn-primary" style="height:23px;width:32%;margin-top:-17px">Save</button>
      <button class="btn-xs btn btn-default" style="height:23px;width:32%;margin-top:-17px">close</button>
  </div>
  </form>
  <div class="thumbnail" style="margin-top:-3px;height:68%;width:99%;margin-left:0.5%;overflow-y: auto;overflow-x:hidden;position:relative">
     <div id="LoadGroupPastpaters">

     </div>
  </div>
</div>
<!--End Group notes and pastpapers-->
<center style="">
<div id="MygroupMembers" class="thumbnail" style="width:60%;height:580px;margin-top:30%;margin-left:-2%;border-top-left-radius:10px;border-top-right-radius:10px;display: none;box-shadow: 2px 2px 8px 1px rgba(1, 1, 1, 0.5)">
<div id="GroupImagePanel"></div>

<div class="thumbnail" style="width:100%;height:auto;padding:1%;border-radius:0">
<input  type="text" autocomplete="off" placeholder="Search member" style="padding-left:1%;width:100%"/>
</div>
<div id="Members" class="thumbnail" style="width:100%;height:65%;padding-left:0;padding-right:0;margin-top:-2%;padding-bottom:1%;overflow-y:auto;border-style:solid;border-color:black;border-width:thin">

</div>
</div>
</center>
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
?>" style="float: left;height: 8%;width:50px;border-radius:100px;background-color:lightgray"/></a>
<h4 class="card-tittle" style="float:left;margin-Left:2%;margin-top:10%;font-size:15px;font-family:'Cambria';font-weight:bold"><?php echo $FirstName ?></h4><h4 style="font-family: 'Cambria';float: left;margin-left:3%;font-size: 15px;margin-Top:10%;font-weight: bold"><?php echo $LastName ?></h4><br/><br/>
<br/><br/>
<li style="background-color: lightblue">
  <a href="Home.php" style="cursor: pointer;color: navy;border-width:1px;color: navy;border-bottom-style:solid;margin-top:-10%;font-size:95%;font-family:'arial Narrow'"><i class="glyphicon glyphicon-home" style="cursor: pointer ;color:navy;height: 24px;font-size: 17px;float:left"></i><h8 style="margin-left: 4%;">Home Panel</h8></a>
  <a href="Profile.php" style="cursor: pointer;color: navy;border-width:1px;border-bottom-style:solid;font-size:95%;font-family:'arial Narrow'"><i class="fas fa-user-graduate" style="cursor: pointer ;color: navy;height: 24px;font-size: 17px;float:left"></i><h8 style="margin-left: 4%">Profile</h8></a>
  <a style="cursor: pointer;color: white;border-width:1px;background-color: navy;border-bottom-style:solid;font-size:95%;font-family:'arial Narrow'"><i class="fas fa-user-friends" style="cursor: pointer ;color: white;height: 24px;font-size: 17px;float:left"></i><h8 style="margin-left: 4%">My Groups</h8></a>
  <a  style="cursor: pointer;color: navy;border-width:1px;border-bottom-style:solid;font-size:95%;font-family:'arial Narrow'"><i class="fa fa-group" style="cursor: pointer ;color: navy;height: 24px;font-size: 17px;float:left"></i><h8 style="margin-left: 4%">Other Groups</h8></a>
  <a href="ChattingRoom.php" style="cursor: pointer;color: navy;border-width:1px;border-bottom-style:solid;font-size:95%;font-family:'arial Narrow'"><i class="glyphicon glyphicon-comment" style="cursor: pointer ;color: navy;height: 24px;font-size: 17px;float:left"></i><h8 style="margin-left: 4%">Chatting Room</h8></a>
</li><br/>
<div class="thumbnail" style="border-radius:0">
  <div class="btn-group-vertical" style="width:100%">
    <button title="create new group" onclick="ShowGroupcreator()" class="btn-xs btn btn-primary" style="width:100%"><i class="fa fa-group" style="color:black"></i><h7   style="font-family: 'cambria';margin-left: 2%;cursor:pointer">Create new group</h7></button>
    <button title="help"  class="btn-xs btn btn-primary" style="width:100%"><i class="fa fa-Question-circle" style="color:black;margin-left:-25%;font-size:120%"></i><h7   style="font-family: 'cambria';cursor:pointer;margin-left:2%">Get help</h7></button>
  </div>
</div>
<!--Date panel-->
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <i class="glyphicon glyphicon-calendar" style="font-size:120%"></i><p style="font-weight:bold">Group Calendar</p>
    <center><h7 id="AlertFill" style="color:red;font-size:90%;margin-top:-6%;font-weight:bold;font-family:'Times New Roman';display:none"><i class="fa fa-edit"></i>  Please fill your event and Day of event</h7></center>
    <center><h7 id="AlertSuccess" style="color:green;font-size:90%;margin-top:-6%;font-weight:bold;font-family:'Times New Roman';display:none">Event Successfull created</h7></center>
    <hr/>
    <div class="panel panel-default" style="padding-bottom:2%">
       <div class="panel-heading" style="width:100%">
          Setting GroupEvent
          <a onclick="ShowGroupEventEditor()" style="float:right;cursor:pointer;font-weight:bold">Add Event</a>
       </div>
       <div class="panel-body" style="height:64%">
          <input id="GroupLeader" value="<?php $GroupLeader ?>" style="display: none"/>
          <input id="GroupID" value="<?php echo $GroupIDii ?>" style="display:none"/>
          <div id="ShowEventEditor" style="display: none">
            <input id="GroupEvents" type="text" class="thumbnail" placeholder="Which group events will happens ?" style="float:left;width:48%;height:10%;padding-left:1%"/>
            <input id="GroupEventsDate" type="date" class="thumbnail" style="float:left;margin-left: 1%;display:block;height:10%">
            <button onclick="SaveTheEvent()" class="btn-xs btn btn-primary" style="margin-left:1%;height:10%;width:20%">Save Event</button>
          </div><br/>
          <div style="width:100%;height:15px;background-color:#0F52BA;margin-top:0%;padding-bottom:5%">
            <i class="fa fa-bookmark-o" style="float:left;margin-top:1%;margin-left:5%;font-size:120%;color:white"></i>
            <h6 style="float:left;margin-left:4%;font-weight:bold;color:lightgray">Event</h6>
            <h6 style="float:right;margin-right:4%;font-weight:bold;color:lightgray">Event day</h6>
            <i class="fa fa-calendar-check-o" style="float:right;margin-top:1%;margin-right:4%;font-size:120%;color:white"></i>
          </div>
          <div id="TheGroupEventWillLoadedHere" class="thumbnail" style="overflow: auto;border-style:solid;width:100%;height:70%;border-width:thin;border-color:lightgray">

          </div>
       </div>
       <div id="calendar"></div>
    </div>
  </div>
</div>
<!--Date Panel End-->
<!--info panel-->
<div id="ShowGroupInfo" class="modal">
  <div class="modal-content2">
    <i class="fa fa-info-circle" style="font-size:180%;float:left"></i><h7 style="font-size:90%;font-weight:bold;margin-left:1%;;margin-top:1%;float:left"><?php echo $GroupName ?>'s</h7><h7 style="font-size:90%;margin-left:1%;;margin-top:1%;float:left"> Group info</h7><br/><hr/><br/>
    <p style="font-weight:bold;font-family:'Times New Roman';margin-top:-5%"><?php echo $GroupDescription ?></p>
  </div>
</div>
<!--info Panel End-->
</nav>
<div id="ShowChattingPanel"></div>

</body>

<div class="nav navbar-fixed-top" style="background-color: white;width:17%;height:100%;float:right;margin-left: 83.1%;border-radius:0;padding:0;border-width:0;margin-Top:0%;box-shadow: 2px 2px 6px 1px rgba(1, 1, 1, 0.3);">
<div style="width: 100%;height:9.9%;background-color:#0F52BA;border-bottom-style: solid;border-bottom-width: thin;border-bottom-color: black;">
<img id="Imoji" src="Photos/groups-icon.png" style="height: 80%;margin-left:3%;margin-top:1%"/><h8 style="font-family:'Times New Roman';color:white;margin-left:1%">My groups</h8>
</div>
<div id="MyGroups"></div>

</div>
<audio id="myAudioSend" preload="auto">
  <source src="Photos/case-closed.mp3"></source>
</audio>
<script src="jquery.min.js"></script>
<script src="dist/emojionearea.min.js"></script>
<script>
function ShowGroupEventEditor()
{
  var ShowEventEditor = document.getElementById('ShowEventEditor');
  ShowEventEditor.style.display = 'block';
  ShowEventEditor.style.transition = '0.5s';
}
function Calenda()
{
  $('#ShowCalenda').modal('show');
}
var x = document.getElementById("myAudioSend");
function playAudioSend()
{
x.play();
}
function OpenGroupPastPapers()
{
  var GroupNotesAndPastPapers = document.getElementById('GroupNotesAndPastPapers');
  GroupNotesAndPastPapers.style.display = 'block';
}
function CloseGroupPastPapers()
{
  var GroupNotesAndPastPapers = document.getElementById('GroupNotesAndPastPapers');
  GroupNotesAndPastPapers.style.display = 'none';
}
</script>
<script type="text/javascript">
//Auto reflesh
setInterval(function(){
DisplayMyPatner();
ShowMyMembers();
LoadingThepastpapersAndNotes();
ShowMyGroups();
ShowGroupPanelContainsMembers();
GroupEventAjax();
}, 500);
//auto reflesh end
DisplayMyPatner();
ShowMyMembers();
LoadingThepastpapersAndNotes();
ShowMyGroups();
ShowGroupPanelContainsMembers();
GroupEventAjax();
function displayDataGroupMembers(){
$.ajax({
url: "GroupSendAndReadData.php",
type: "POST",
async: false,
data:{
"LoadMembers": 1
},
success: function(data){
$("#Members").html(data);
}
})
}
ShowSelectGroup();
function ShowSelectGroup()
{
$.ajax({
url: "GroupSendAndReadData.php",
type: "post",
async: false,
data: {
"ShowChattingArea":1
},
success: function(data)
{
  $("#ShowChattingPanel").html(data);
}
});
}
function LoadingThepastpapersAndNotes()
{
$.ajax({
url: "GroupSendAndReadData.php",
type: "post",
async: false,
data: {
"LoadPastpapers":1
},
success: function(data)
{
  $("#LoadGroupPastpaters").html(data);
}
});
}
function ShowGroupPanelContainsMembers()
{
$.ajax({
url: "GroupSendAndReadData.php",
type: "post",
async: false,
data: {
"SelectGroupPanel":1
},
success: function(data)
{
  $("#GroupImagePanel").html(data);
}
});
}
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
$(document).ready(function()
{
$("#ShowSend").click(function(){
var SendShow = document.getElementById('ShowSend');
var TextInput = $("#TextInput").val();
var MMInsert = $("#MMInsert").val();
var GMname = $("#GMname").val();
var Mypicture = $("#Mypicture").val();
$.ajax({
url: "GroupSendAndReadData.php",
type: "post",
async: false,
data: {
"doneMe":1,
"Message":TextInput,
"MMInsert":MMInsert,
"GMname":GMname,
"Mypicture":Mypicture
},
success: function(data){
displayDataMessagesFromDatabase();
$("#TextInput").val('');
SendShow.style.display = 'none';
playAudioSend();
}
});
});
});
// Select Group
function displayDataMessagesFromDatabase()
{
$.ajax({
url: "GroupSendAndReadData.php",
type: "POST",
async: false,
data:{
"displayMessages": 1
},
success: function(data){
$("#BodyMessages").html(data);
}
})
}

function ShowMyGroups()
{
$.ajax({
url: "GroupSendAndReadData.php",
type: "POST",
async: false,
data:{
"GroupHistory": 1
},
success: function(data){
$("#MyGroups").html(data);
}
})
}
$.ajax({
url: "GroupSendAndReadData.php",
type: "POST",
async: false,
data:{
"displayMessages": 1
},
success: function(data)
{
$("#BodyMessages").html(data);
}
})
$.ajax({
url: "GroupSendAndReadData.php",
type: "POST",
async: false,
data:{
"displayPatner": 1
},
success: function(data)
{
$("#scrolly").html(data);
}
})
function DisplayMyPatner()
{
$.ajax({
url: "GroupSendAndReadData.php",
type: "POST",
async: false,
data:{
"displayPatner": 1
},
success: function(data)
{
$("#scrolly").html(data);
}
})
}
function ClickBoxToshow()
{
var SendShow = document.getElementById('ShowSend');
SendShow.style.display = 'block';
InsertIsTyping();
}
function ShowGroupcreator()
{
var GroupCreator = document.getElementById('GroupCreator');
GroupCreator.style.marginTop = '10%';
GroupCreator.style.transition = '0.3s';
}
function CloseCRT()
{
var GroupCreator = document.getElementById('GroupCreator');
GroupCreator.style.marginTop = '-36%';
GroupCreator.style.transition = '0.3s';
}
function ShowGroupMembers()
{
var MygroupMembers = document.getElementById('MygroupMembers');
MygroupMembers.style.display = 'block';
MygroupMembers.style.transition = '0.3s';
}
$(function()
{
$('[data-toggle="popover"]').popover();
})
$(document).on('focus', '.TextInput', function(){
var TextInput = $("#TextInput").val();
$.ajax({
url: "GroupSendAndReadData.php",
type: "post",
async: false,
data: {
"Insert1":1
},
success: function(data)
{

}
});
});
$(document).on('blur', '.chat_message', function(){
$.ajax({
url: "GroupSendAndReadData.php",
type: "post",
async: false,
data: {
"Insert0":1
},
success: function(data)
{
ShowTypingAlert();
}
});
});
function ShowTypingAlert(){
var Typing = document.getElementById('IsTyping');
$.ajax({
url: "GroupSendAndReadData.php",
type: "POST",
async: false,
data:
{
"displayAlertTyping": 1
},
success: function(data){
$("#IsTyping").html(data);
Typing.style.transition = '0.5s';
}
})
}
function ShowMyMembers(){
$.ajax({
url: "GroupSendAndReadData.php",
type: "POST",
async: false,
data:
{
"LoadMembers": 1
},
success: function(data){
$("#Members").html(data);
}
})
}
function SaveTheEvent()
{
  var GroupLeader = $("#GroupLeader").val();
  var GroupID = $("#GroupID").val();
  var GroupEvent = $("#GroupEvents").val();
  var GroupEventDay = $("#GroupEventsDate").val();
  var AlertFill = document.getElementById("AlertFill");
  var AlertSuccess = document.getElementById("AlertSuccess");
  if(GroupEvent == '' || GroupEventDay == '')
  {
    AlertFill.style.display = 'block';
    AlertSuccess.style.display = 'none';
    AlertFill.style.transition = '0.5s'
  }
  else
  {
    $.ajax({
    url: "GroupSendAndReadData.php",
    type: "post",
    async: false,
    data: {
    "UpdateGroupEvent":1,
    "GroupLeader":GroupLeader,
    "GroupID":GroupID,
    "GroupEvent":GroupEvent,
    "GroupEventDay":GroupEventDay
    },
    success: function(data)
    {
      $("#GroupEventsDate").val('');
      $("#GroupEvents").val('');
      AlertFill.style.display = 'none';
      AlertSuccess.style.display = 'block';
      AlertSuccess.style.transition = '0.5s';
    }
    });
  }
}
function GroupEventAjax(){
$.ajax({
url: "GroupSendAndReadData.php",
type: "POST",
async: false,
data:
{
"LoadEvents": 1
},
success: function(data){
$("#TheGroupEventWillLoadedHere").html(data);
}
})
}
</script>
<script>
var modal = document.getElementById("myModal");
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];
var AlertFill = document.getElementById("AlertFill");
var AlertSuccess = document.getElementById("AlertSuccess");
btn.onclick = function() {
  modal.style.display = "block";
  AlertFill.style.display = 'none';
  AlertSuccess.style.display = 'none';
}
span.onclick = function() {
  modal.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<script>
var ShowGroupInfo = document.getElementById("ShowGroupInfo");
var GroupInfo = document.getElementById("GroupInfo");
GroupInfo.onclick = function() {
  ShowGroupInfo.style.display = "block";
}

close.onclick = function() {
  ShowGroupInfo.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == ShowGroupInfo) {
    ShowGroupInfo.style.display = "none";
  }
}

</script>
<style >
#scrolly{
width: 69%;
height: 25%;
overflow: auto;
overflow-y: hidden;
margin: 0 auto;
overflow-x: auto;
border-radius: 0px;
white-space: nowrap;
margin-top:-2%;
margin-left: 15%;
padding-left: 0%;
padding-right: 0.6%;
box-shadow: 0px 1px 3px 1px rgba(1,1,1,0.3);
}
.StyleMe
{
width: 120px;
height: 128px;
margin-left:0.5%;
margin-top: 1.7%;
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
.HoverPanelGroup:hover
{
color: #008DFE;
}
.zoom:hover
{
transform: scale(2.1,2.4);
transition: 0.5s;
}
.modal
{
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 50%;
  height:74%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  transition: 0.3s;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
  color:red;
}
.modal-content2 {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 50%;
  height:18%;
  margin-top:8%;
  border-radius:5px;
}
</style>
</html>
