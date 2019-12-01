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
      $Genderii = $result['Gender'];
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
 <?php if(isset($_POST['SendQuestion']))
 {
   //insert question
   $file_tmp=$_FILES['QPicture']["tmp_name"];
   $file_name=$_FILES['QPicture']["name"];
   $file_type=$_FILES['QPicture']["type"];
   $path = basename($_FILES['QPicture']['name']);
   $Descriptions = $_POST['QuestionDescription'];
   $PostTime = date('H:ia');
   $PostDay = date('M d');
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
     $query = "insert into scholaruploadingquestions(EmailAddressOrPhoneNumber,Descriptions,QuestionsPhotos,ProfilePhoto,FirstName,LastName,Level,PostTime,PostDay) values ('$EmailOrPhone','$Descriptions','$path','$Photo','$FirstName','$LastName','$Level','$PostTime','$PostDay')";
     mysqli_query($conn, $query);
     mysqli_close($conn);
   }

   }
 }
 ?>
 <?php if(isset($_POST['SendComment']))
 {
   //insert comments
   $file_tmp=$_FILES['Qcomment']["tmp_name"];
   $file_name=$_FILES['Qcomment']["name"];
   $file_type=$_FILES['Qcomment']["type"];
   $path = basename($_FILES['Qcomment']['name']);
   $Descriptions = $_POST['CommentMe'];
   $IDS = $_POST['IDS'];
   $PostTime = date('H:ia');
   $PostDay = date('M d');
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

   }
   else
   {
     $query = "insert into scholaruploadingquestions(EmailAddressOrPhoneNumber,StudentReplyID,Descriptions,Comments,ProfilePhoto,FirstName,LastName,Level,PostTime,PostDay) values ('$IDS','$EmailOrPhone','$Descriptions','$path','$Photo','$FirstName','$LastName','$Level','$PostTime','$PostDay')";
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
   <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
   <link rel="stylesheet" type="text/css" href="RegisterStyleAndLoginStyles.css">
   <link rel="stylesheet" type="text/css" href="HomeStyles.css">
   <script src="MyJavaScript.js"></script>
 </header>
<body style="background-image:url('Photos/IMG_0980.jpg');background-size:cover;background-attachment: fixed">
 <nav class="nav navbar-fixed-top  NavBarStyle" style="  border-bottom-style: solid;border-bottom-width: thin;border-bottom-color: black;">
   <form method="post"  enctype="multipart/form-data"><div style="padding-right:0.4%;padding-left:0.4%"><a><input  type="text" name="SeachFriends" id="SearchBox" placeholder="search for friend.." class="search thumbnail" style="outline:none;padding-left: 1%;float: left;margin-left:16%;margin-top:0.8%;width:20%;height:50%;border-radius:0"/></a>
     <a onclick="onSearch()"><button class="btn-xs btn btn-primary" type="submit"  style="margin-top:-1.2%;height:51%;border-radius:0">search</button></a>
     <a href="Library.php"><i data-container="body" data-toggle="popover" data-trigger ='hover' data- data-placement="bottom" data-content="Universal Library" style="margin-left:5%;margin-top:-0.4%;font-size:120%;color:lightgray;cursor:pointer;padding-top:2%;padding-bottom:1%;padding-left:2%;padding-right:2%" class="fa fa-book-reader BackColor"></i></a>
     <i  data-container="body" data-toggle="popover" data-trigger ='hover' data- data-placement="bottom" data-content="Students events" style="margin-left:0%;margin-top:-1%;font-size:120%;color:lightgray;cursor:pointer;padding-top:1.5%;padding-bottom:1%;padding-left:2%;padding-right:2%;background-color:navy;border-bottom-style:solid;border-bottom-color:white;border-bottom-width:thin" class="fa fa-birthday-cake BackColor"></i>
   </div></form>
   <i id="AllowUpload" onclick="onclickMe()" class="fa fa-sort-desc" style="float:right;margin-right:4%;margin-top:-3.5%;cursor:pointer"></i><br/></br/><br/>
   <div id="Downshow" style="display: none;width:13%;background-color: white;padding-left: 0.3%;padding-right: 0.3%;height:238%;float: right;margin-right:1%;padding-bottom:6%; box-shadow: 0px 1px 3px 1px rgba(1,1,1,0.3);border-radius:3px;margin-top:-5.2%;border-style:solid;border-width:thin;border-color:navy">
     <div  class="arrow-up" style="width: 0;height:0;position: absolute;border-left: 10px solid transparent;border-right:10px solid transparent;border-bottom:15px solid white;right: 3.5%;bottom:-10%;border-top-color:black"></div>
     <i class="fa fa-signing" style="float: left;margin-top:2%"></i><h4 style="font-size:80%;font-family: 'cambria';font-weight:bold;margin-left:2%">Action center</h4><hr style="margin-top:-4%"/>
     <a class="thumbnail"><h8  style="margin-left:1%;font-size:100%;color:black;font-family:'Times New Roman'">close</h8></a><br/>
     <a href="LogOut.php" class="thumbnail" style="margin-top:-20%"><h8 class="HoverClose" style="margin-left:2%;font-size:100%;color:black;font-family:'Times New Roman'">logout</a></li>
   </div>
 </nav>
 <nav id="MySideBar" class="nav navbar-left navbar-fixed-top SidebarStyle">
   <div style="width: 100%;height:8%;background-color:#0F52BA;border-bottom-style: solid;border-bottom-width: thin;border-bottom-color: black;">
     <img src="Photos/IMG_0796.png" style="height: 96%"/>
   </div>
   <br/>
   <a href="Profile.php"><img  src="<?php
   if($Photo == '')
   {
     if($Genderii == 'Male')
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
   <h4 class="card-tittle" style="float:left;margin-Left:2%;margin-top:10%;font-size:18px;font-size:15px;font-family:'Cambria';font-weight:bold"><?php echo $FirstName ?></h4><h4 style="float: left;margin-Left:2%;margin-top:10%;font-size:15px;font-family:'Cambria';font-weight:bold"><?php echo $LastName ?></h4><br/><br/>
   <br/><br/>
   <li style="background-color: lightblue">
     <a href="Home.php" style="cursor: pointer;color: navy;border-width:1px;color: navy;border-bottom-style:solid;margin-top:-10%;font-size:95%;font-family:'arial Narrow'"><i class="glyphicon glyphicon-home" style="cursor: pointer ;color:navy;height: 24px;font-size: 17px;float:left"></i><h8 style="margin-left: 4%;">Home Panel</h8></a>
     <a href="Profile.php" style="cursor: pointer;color: navy;border-width:1px;border-bottom-style:solid;font-size:95%;font-family:'arial Narrow'"><i class="fas fa-user-graduate" style="cursor: pointer ;color: navy;height: 24px;font-size: 17px;float:left"></i><h8 style="margin-left: 4%">Profile</h8></a>
     <a href="MyGroup.php"style="cursor: pointer;color: navy;border-width:1px;border-bottom-style:solid;font-size:95%;font-family:'arial Narrow'"><i class="fas fa-user-friends" style="cursor: pointer ;color:navy;height: 24px;font-size: 17px;float:left"></i><h8 style="margin-left: 4%">My Groups</h8></a>
     <a  style="cursor: pointer;color: navy;border-width:1px;border-bottom-style:solid;font-size:95%;font-family:'arial Narrow'"><i class="fa fa-group" style="cursor: pointer ;color: navy;height: 24px;font-size: 17px;float:left"></i><h8 style="margin-left: 4%">Other Groups</h8></a>
     <a href="ChattingRoom.php" style="cursor: pointer;color: navy;border-width:1px;border-bottom-style:solid;font-size:95%;font-family:'arial Narrow'"><i class="glyphicon glyphicon-comment" style="cursor: pointer ;color: navy;height: 24px;font-size: 17px;float:left"></i><h8 style="margin-left: 4%">Chatting Room</h8></a>
   </li>
 </nav>
 <center>
   <div class="title TopSelection" style="margin-left:2%;height:35%;border-radius:0;background-color:white;margin-top:2%;border-bottom-left-radius:5px;border-bottom-right-radius:5px;padding-bottom:1.3%">
     <img src="Photos/wp2714638-happy-birthday-background-hd.jpg" style="height: 138%;width:100%;margin-top: -3%;border-left-style:solid;border-left-width:thin;border-left-color:white;border-right-style:solid;border-right-width:thin;border-right-color:white"><br/>
   </div><br/><br/>
<div id='scrolly'>

 <br/>
</div>
<br/>
<br/>
 </body>
</center>
<script>
$(document).ready(function()
{
  //Auto reflesh
  setInterval(function(){
    DisplayThePatner();
  }, 500);
  //auto reflesh end
  function onclickMe()
  {
    var Downshow = document.getElementById('Downshow');
    var AllowUpload = document.getElementById('AllowUpload');
    if(Downshow.style.display == 'none')
    {
      Downshow.style.display = 'block';
      AllowUpload.style.color = 'white';
    }
    else {
      Downshow.style.display = 'none';
      AllowUpload.style.color = 'black';
    }

  }
})
  $(function()
{
  $('[data-toggle="popover"]').popover()
})
function RemoveBirthdayAlert()
{
  var RemoveThis = document.getElementById('RemoveThis');
  RemoveThis.style.display = 'none';
}
function DisplayThePatner()
{
  $.ajax({
    url: "BirthdayPanelLoadData.php",
    type: "POST",
    async: false,
    data:{
      "LoadBirthdayPanel": 1
    },
     success: function(data){
        $("#scrolly").html(data);
    }
  })
}
$.ajax({
  url: "BirthdayPanelLoadData.php",
  type: "POST",
  async: false,
  data:{
    "LoadBirthdayPanel": 1
  },
   success: function(data){
      $("#scrolly").html(data);
  }
})
</script>
<style >
   #scrolly{
       width: 68%;
       height: 26%;
       overflow: auto;
       overflow-y: hidden;
       margin: 0 auto;
       overflow-x: auto;
       border-width:0;
       white-space: nowrap;
       margin-top:1%;
       margin-left: 17%;
       padding-left: 0.3%;
       padding-right: 1%;
       border-bottom-color: white;
       border-bottom-style: solid;
       border-bottom-width: medium;
   }
   .StyleMe
   {
       width: 15%;
       height: 90%;
       margin-left:1%;
       margin-top: 1%;
       border-radius: 5px;
       display:  inline-block;
       border-color: white;
       border-style: solid;
       border-width: thin;
       box-shadow: 0px 1px 3px 1px rgba(1,1,1,0.3);
       padding-bottom: 2%;
   }
   .StyleFriend
   {
       width: 100%;
       height: 85%;
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
   .BackColor:hover
   {
     background-color: navy;
   }
.closeMe:hover
{
  opacity: 8;
}
</style>
</html>
