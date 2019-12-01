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
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
   <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
   <link rel="stylesheet" type="text/css" href="RegisterStyleAndLoginStyles.css">
   <link rel="stylesheet" type="text/css" href="HomeStyles.css">
   <script src="MyJavaScript.js"></script>
 </header>
 <div id="MyLoader">
   <center>waiting...</center>
 </div>
<body onload="Loader()" style="background-color:#D9DDDC">
 <nav class="nav navbar-fixed-top  NavBarStyle" style="  border-bottom-style: solid;border-bottom-width: thin;border-bottom-color: black;">
   <form method="post"  enctype="multipart/form-data"><div style="padding-right:0.4%;padding-left:0.4%"><a><input disabled  type="text" name="SeachFriends" id="SearchBox" placeholder="search for friend.." class="search thumbnail" style="padding-left: 1%;float: left;margin-left:16%;margin-top:0.8%;width:20%;height:50%;border-radius:0"/></a>
     <a onclick="onSearch()"><button disabled class="btn-xs btn btn-primary" type="submit"  style="margin-top:-1.2%;height:51%;border-radius:0">search</button></a>
     <i  style="margin-left:5%;margin-top:-0.4%;font-size:120%;color:lightgray;cursor:pointer;padding-top:2%;padding-bottom:1%;padding-left:2%;padding-right:2%;background-color:navy;border-bottom-style:solid;border-bottom-color:white;border-bottom-width:thin" class="fa fa-book-reader BackColor"></i>
     <a href="BirthdayPanel.php"><i  data-container="body" data-toggle="popover" data-trigger ='hover' data- data-placement="bottom" data-content="Students events" style="margin-left:0%;margin-top:-1%;font-size:120%;color:lightgray;cursor:pointer;padding-top:1.5%;padding-bottom:1%;padding-left:2%;padding-right:2%" class="fa fa-birthday-cake BackColor"></i></a>
   </div></form>
 </nav>
 <nav id="MySideBar" class="nav navbar-left navbar-fixed-top SidebarStyle">
   <div style="width: 100%;height:8%;background-color:#0F52BA;border-bottom-style: solid;border-bottom-width: thin;border-bottom-color: black;">
     <img src="Photos/IMG_0796.png" style="height: 96%"/>
   </div>
   <br/>
   <a href="Profile.php"><img  src="<?php
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
   <h4 class="card-tittle" style="float:left;margin-Left:2%;margin-top:10%;font-size:18px;font-size:15px;font-family:'Cambria';font-weight:bold"><?php echo $FirstName ?></h4><h4 style="float: left;margin-Left:2%;margin-top:10%;font-size:15px;font-family:'Cambria';font-weight:bold"><?php echo $LastName ?></h4><br/><br/>
   <br/><br/>
   <li style="background-color: lightblue">
     <a href="Home.php" style="cursor: pointer;color: navy;border-width:1px;color: navy;border-bottom-style:solid;margin-top:-10%;font-size:95%;font-family:'arial Narrow'"><i class="glyphicon glyphicon-home" style="cursor: pointer ;color:navy;height: 24px;font-size: 17px;float:left"></i><h8 style="margin-left: 4%;">Home Panel</h8></a>
     <a href="Profile.php" style="cursor: pointer;color: navy;border-width:1px;border-bottom-style:solid;font-size:95%;font-family:'arial Narrow'"><i class="fas fa-user-graduate" style="cursor: pointer ;color: navy;height: 24px;font-size: 17px;float:left"></i><h8 style="margin-left: 4%">Profile</h8></a>
     <a href="MyGroup.php"style="cursor: pointer;color: navy;border-width:1px;border-bottom-style:solid;font-size:95%;font-family:'arial Narrow'"><i class="fas fa-user-friends" style="cursor: pointer ;color:navy;height: 24px;font-size: 17px;float:left"></i><h8 style="margin-left: 4%">My Groups</h8></a>
     <a  style="cursor: pointer;color: navy;border-width:1px;border-bottom-style:solid;font-size:95%;font-family:'arial Narrow'"><i class="fa fa-group" style="cursor: pointer ;color: navy;height: 24px;font-size: 17px;float:left"></i><h8 style="margin-left: 4%">Other Groups</h8></a>
     <a href="ChattingRoom.php" style="cursor: pointer;color: navy;border-width:1px;border-bottom-style:solid;font-size:95%;font-family:'arial Narrow'"><i class="glyphicon glyphicon-comment" style="cursor: pointer ;color: navy;height: 24px;font-size: 17px;float:left"></i><h8 style="margin-left: 4%">Chatting Room</h8></a>
   </li><br/>
   <div class="thumbnail"><center><i  for="UploadBook" class="fa fa-book" style="margin-left:-2%"></i><a onclick="ShowBookUploader()" id="UploadBook" style="margin-left:2%;cursor:pointer">Upload New book</a></center></div>
   <center><form method="post" action="#" enctype="multipart/form-data">
    <div id="Myexternal" class="thumbnail" style="width:96%;height:2%;margin-left:-195%;border-Radius:5px">
     <div id="Myinternal" style="display:none">
       <div class="div file btn btn-xs btn-default" style="border-radius:2px;margin-top:-0.3%;height:33%;padding-top:2%;padding-bottom:1%;float:left">
         <input title="Select Book" required  class="input" type="file" name="SelectBook" style="cursor: pointer"/><i class="fa fa-file-pdf-o" style="font-size:140%;color:#7C0A02"></i>
       </div>
       <div class="div file btn btn-xs btn-default" style="border-radius:2px;margin-top:-0.3%;height:34%;padding-top:2%;padding-bottom:1%;float:left;margin-left:2%">
         <input title="Choose Cover photo" required  class="input" type="file" name="SelectBookCover" style="cursor: pointer"/><i class="fa fa-file-photo-o" style="font-size:140%;color:navy"></i>
       </div>
       <br/>
       <hr/>
     <button name="UploadBooks" type="submit" class="btn-xs btn btn-default" style="float:left;margin-top:-7%">upload</button>
     <button onclick="HideBookUploader()" class="btn-xs btn btn-danger" style="float:right;margin-top:-7%">close</button>
   </div>
   </div><br/>
   <?php if(isset($_POST['UploadBooks']))
   {
   include("db.php");
   //book pdf Selected
   $file_tmp=$_FILES['SelectBook']["tmp_name"];
   $file_name=$_FILES['SelectBook']["name"];
   $file_type=$_FILES['SelectBook']["type"];
   $fileError = $_FILES['SelectBook']["error"];
   $fileSize = $_FILES['SelectBook']["size"];
   $fileExt = explode('.',$file_name);
   $fileActureExt = strtolower(end($fileExt));
   $Allowed = array('pdf');
   $Book = basename($_FILES['SelectBook']['name']);
   //Cover page SelectBookCover Image
   $file_tmpC=$_FILES['SelectBookCover']["tmp_name"];
   $file_nameC=$_FILES['SelectBookCover']["name"];
   $file_type=$_FILES['SelectBookCover']["type"];
   $fileErrorC = $_FILES['SelectBookCover']["error"];
   $fileSizeC = $_FILES['SelectBookCover']["size"];
   $fileExtC = explode('.',$file_nameC);
   $fileActureExtC = strtolower(end($fileExtC));
   $AllowedC = array('png','jpg','jpeg');
   $Cover = basename($_FILES['SelectBookCover']['name']);
   if($Book == "" or $Cover == "")
   {
   ?><center><label class="alert-danger" style="padding:5px;border-radius: 5px;margin-top:-40px;padding-left: 80px;padding-right: 80px"><?php echo "Please select software to upload and  fill software name" ?></label></center><?php
   }
   else
   {
   if(!$conn)
   {
    die('server not connected');
   }
   else
   {
    if(in_array($fileActureExt,$Allowed) || in_array($fileActureExtC,$AllowedC))
    {
          if($fileError === 0 || $fileErrorC === 0)
          {
              if($fileSize < 20000000 || $fileSizeC < 10000000)
              {
                move_uploaded_file($file_tmp,$Book);
                move_uploaded_file($file_tmpC,$Cover);
                $query = "insert into books(Book,BookCoverImage,BookLevel) values('{$Book}','$Cover','$Level')";
                mysqli_query($conn, $query);
                mysqli_close($conn);
              }
          }
      }
    }
   }
   }
   ?>
   <?php
   if(isset($_POST['AddBookThisBook']))
   {
     include("db.php");
     $Books = $_POST['Book'];
     $BookCoverImage = $_POST['BookCoverImage'];
     if(!$conn)
        {
          die('server not connected');
        }
      else
       {
         $query = "insert into mybooks(BookManager,Book,BookCoverImage) values ('$EmailOrPhone','$Books','$BookCoverImage')";
         mysqli_query($conn, $query);
         mysqli_close($conn);
       }
   }
   ?>
</form></center>
 </nav>
 <!--- rightBar start -->

 <nav class="nav navbar-right navbar-fixed-top" style="float:right;margin-left: 85%;height: 100%;width:15%;background-color:white;box-shadow:-1px 0px 3px 1px rgba(0,0,0,0.3) ">
   <div style="width: 100%;height:8%;background-color:#0F52BA;border-bottom-style: solid;border-bottom-width: thin;border-bottom-color: black;padding:3%">
     <img src="Photos/IMG_0819.png" style="height: 60%"/><h7 style="color:white;margin-left:3%;font-family:'Times New Roman'">My book list</h7>
   </div>
   <div style="width: 100%;height:5%;background-color:lightgray;padding:2%;border-bottom-style:solid;border-bottom-width:thin;border-bottom-color:gray">
     <input type="search" spellcheck="false"  placeholder="Search..." style="outline:none;padding-left:2%;border-width:thin;width:100%;padding-right:10%"><i title="search" class="fa fa-search" style="margin-left:-11%;cursor: pointer;background-color:lightgray;padding:1.4%"></i>
   </div>
   <div id="MylistBooks" class="nav" style="">

   </div>
 </nav>
<!--- rightBar end -->
 <center>
   <div class="title TopSelection" style="margin-left:0%;height:52%;width:72%;border-radius:0;background-color:white;margin-top:3%;padding-bottom:2%">
     <img src="Photos/IMG_1083.jpg"  style="width:38%;height:83%;">
     <hr/>
      <div style="padding-right:0%;width:50%;padding-left:0%;border-color:transparent;border-style:double;border-width:thin;height:10%;margin-top:-0.6%">
        <input id="BookSearch" class="text" spellcheck="false"  placeholder="Search for books" style="outline:none;width:100%;float: left;padding:1.2%;padding-right:19%"/>
        <button onclick="ShowListOfSearchedBook()" type="submit" style="margin-left:-18.1%;margin-top:0.08%;width:17.9%;padding: 1.5%;border-radius:0" class="btn-sm btn btn-primary">Search</button>
      </div>
   </div>
   <br/>
</div>
<div style="width:100%;height:10%;background-color:navy;border-style:double;border-width:thin;border-color:white">
      <br/><center><h7 style="color:white;margin-left:3%;font-family:'Times New Roman';font-weight:bold;font-size:180%;text-shadow:0px 1px 2px 1px rgba(0,0,0,0.3)">O'LEVEL BOOKS AND JOURNALS</h7></center>
</div><br/>
<div id="ShowBooksO">


</div><br/>
<div style="width:100%;height:10%;background-color:navy;border-style:double;border-width:thin;border-color:white">
      <br/><center><h7 style="color:white;margin-left:3%;font-family:'Times New Roman';font-weight:bold;font-size:180%;text-shadow:0px 1px 2px 1px rgba(0,0,0,0.3)">ADVANCED BOOKS AND JOURNALS</h7></center>
</div><br/>
<div id="ShowBooksA">

</div>
<br/>
<div style="width:100%;height:10%;background-color:navy;border-style:double;border-width:thin;border-color:white">
      <br/><center><h7 style="color:white;margin-left:3%;font-family:'Times New Roman';font-weight:bold;font-size:180%;text-shadow:0px 1px 2px 1px rgba(0,0,0,0.3)">UNIVERSITY BOOKS AND JOURNALS</h7></center>
</div><br/>
<div id="ShowBooksU">

    <br/>
</div><br/>
<div style="width:100%;height:10%;background-color:navy;border-style:double;border-width:thin;border-color:white">
      <br/><center><h7 style="color:white;margin-left:3%;font-family:'Times New Roman';font-weight:bold;font-size:180%;text-shadow:0px 1px 2px 1px rgba(0,0,0,0.3)">World Scientist And Famous</h7></center>
</div><br/>
<div style="width: 80%;height: 45%;margin-left:0%;margin-top: 1%;background-color: white;display:  inline-block;border-style: solid;border-width: thin;border-color: black">
  <div class="container" style="margin-top:0%;margin-left:-1%">
   <div id="myCarousel" class="carousel slide" data-ride="carousel" >
   <div class="carousel-inner" style="width: 40%">
     <div class="item active" style="width:80%;height:100%;margin-left:-6%">
         <img class="thumbnail" src="Photos/British-scientist-Stephen-Hawking-past-away.jpg"  style="width:130%;height: 100%;background-attachment:fixed;background-size: cover">
         <div class="carousel-caption">
             <h3 style=" margin-top: 2px;font-size: 25px;color: White;font-family: 'Times New Roman';margin-left: auto;margin-bottom:-8%">Stephen Hawking</h3>
         </div>
     </div>
     <div class="item" style="width:80%;height:100%;margin-left:-6%">
         <img class="thumbnail" src="Photos/zxbkwacxwyvz.jpg" style="width:130%;height: 100%;background-attachment:fixed;background-size: cover">
         <div class="carousel-caption">
             <h3 style=" margin-top: 2px;font-size: 25px;color: white;font-family: 'Times New Roman';margin-left: auto;margin-bottom:-8%">Nikola Tesla</h3>
         </div>
     </div>
     <div class="item" style="width:80%;height:100%;margin-left:-6%">
         <img class="thumbnail" src="Photos/Charles de Coulomb.jpg" style="width:130%;height: 100%;background-attachment:fixed;background-size: cover">
         <div class="carousel-caption">
             <h3 style=" margin-top: 2px;font-size: 25px;color: white;font-family: 'Times New Roman';margin-left: auto;margin-bottom:-8%">Charles de Coulomb</h3>
         </div>
     </div>
     <div class="item" style="width:80%;height:100%;margin-left:-6%">
         <img class="thumbnail" src="Photos/Karl Paul Link in famous Scientist on Campus.jpg" style="width:130%;height: 100%;background-attachment:fixed;background-size: cover">
         <div class="carousel-caption">
             <h3 style=" margin-top: 2px;font-size: 25px;color: white;font-family: 'Times New Roman';margin-left: auto;margin-bottom:-8%">Karl Paul</h3>
         </div>
     </div>
     <div class="item" style="width:80%;height:100%;margin-left:-6%">
         <img class="thumbnail" src="Photos/Alexander Fleming.jpg"  style="width:130%;height: 100%;background-attachment:fixed;background-size: cover">
         <div class="carousel-caption">
             <h3 style=" margin-top: 2px;font-size: 25px;color: white;font-family: 'Times New Roman';margin-left: auto">Alexander Fleming</h3>
         </div>
     </div>
   </div>

   <!-- Left and right controls -->
   <a class="left carousel-control" href="#myCarousel" data-slide="prev">
     <span class="glyphicon glyphicon-chevron-left"></span>
     <span class="sr-only">Previous</span>
   </a>
   <a class="right carousel-control" href="#myCarousel" data-slide="next" >
     <span class="glyphicon glyphicon-chevron-right" ></span>
     <span class="sr-only">Next</span>
   </a>
 </div>
</div>
</div>
<br/><br/>
  </body>
</center>
<script>
//Auto reflesh
setInterval(function(){
ShowListOfSearchedBook();
BookA();
BookO();
LoadingMylist();
}, 50);
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
$(function()
{
$('[data-toggle="popover"]').popover()
})
function ShowBookUploader()
{
var Myinternal = document.getElementById('Myinternal');
var Myexternal = document.getElementById('Myexternal');
if(Myexternal.style.marginLeft == '-195%')
{
Myexternal.style.marginLeft = '0%';
Myinternal.style.display = 'block';
Myexternal.style.height = '12%';
Myinternal.style.transition = '0.4s';
Myexternal.style.transition = '0.4s';
Myexternal.style.borderRadius = '5px';
}
}
function HideBookUploader()
{
Myexternal.style.marginLeft = '-195%';
Myinternal.style.display = 'none';
Myexternal.style.height = '0%';
Myinternal.style.transition = '0.4s';
Myexternal.style.transition = '0.4s';
Myexternal.style.borderRadius = '80%';
}
</script>
<script>
var BookSearch  = $("#BookSearch").val();
$.ajax({
  url: "BookUploader.php",
  type: "POST",
  async: false,
  data:{
    "ShowBooksO": 1,
    "BookSearch": BookSearch
  },
   success: function(data){
      $("#ShowBooksO").html(data);
  }
})
function BookO()
{
  var BookSearch  = $("#BookSearch").val();
  $.ajax({
    url: "BookUploader.php",
    type: "POST",
    async: false,
    data:{
      "ShowBooksO": 1,
      "BookSearch": BookSearch
    },
     success: function(data){
        $("#ShowBooksO").html(data);
    }
  })
}
</script>
<script>
var BookSearch  = $("#BookSearch").val();
$.ajax({
  url: "BookUploader.php",
  type: "POST",
  async: false,
  data:{
    "ShowBooksA": 1,
    "BookSearch": BookSearch
  },
   success: function(data){
      $("#ShowBooksA").html(data);
  }
})
function BookA()
{
  var BookSearch  = $("#BookSearch").val();
  $.ajax({
    url: "BookUploader.php",
    type: "POST",
    async: false,
    data:{
      "ShowBooksA": 1,
      "BookSearch": BookSearch
    },
     success: function(data){
        $("#ShowBooksA").html(data);
    }
  })
}
</script>
<script>
var BookSearch  = $("#BookSearch").val();
$.ajax({
  url: "BookUploader.php",
  type: "POST",
  async: false,
  data:{
    "ShowBooksU": 1,
    "BookSearch": BookSearch
  },
   success: function(data){
      $("#ShowBooksU").html(data);
  }
})
function ShowListOfSearchedBook()
{
  var BookSearch  = $("#BookSearch").val();
  $.ajax({
    url: "BookUploader.php",
    type: "POST",
    async: false,
    data:{
      "ShowBooksU": 1,
      "BookSearch": BookSearch
    },
     success: function(data){
        $("#ShowBooksU").html(data);
        BookA();
        BookO();
    }
  })
}
function LoadingMylist()
{
  $.ajax({
    url: "BookUploader.php",
    type: "POST",
    async: false,
    data:{
      "MyBooksList": 1
    },
     success: function(data){
        $("#MylistBooks").html(data);
    }
  })
}
</script>
<style >
#ShowBooksO{
  width: 70%;
  height: 34%;
  overflow: auto;
  overflow-y: hidden;
  margin: 0 auto;
  overflow-x: auto;
  border-top-style: solid;
  border-top-width: thin;
  border-top-color:blue;
  white-space: nowrap;
  margin-top:1%;
  margin-left: 15%;
  padding-left: 0.3%;
  padding-right: 1%;
  background-color: white;
  box-shadow: 0px 5px 6px 1px rgba(1,1,1,0.8);
}
#ShowBooksA{
  width: 70%;
  height: 34%;
  overflow: auto;
  overflow-y: hidden;
  margin: 0 auto;
  overflow-x: auto;
  border-top-style: solid;
  border-top-width: thin;
  border-top-color:blue;
  white-space: nowrap;
  margin-top:1%;
  margin-left: 15%;
  padding-left: 0.3%;
  padding-right: 1%;
  background-color: white;
  box-shadow: 0px 5px 6px 1px rgba(1,1,1,0.8);
}
#ShowBooksU{
  width: 70%;
  height: 34%;
  overflow: auto;
  overflow-y: hidden;
  margin: 0 auto;
  overflow-x: auto;
  border-top-style: solid;
  border-top-width: thin;
  border-top-color:blue;
  white-space: nowrap;
  margin-top:1%;
  margin-left: 15%;
  padding-left: 0.3%;
  padding-right: 1%;
  background-color: white;
  box-shadow: 0px 5px 6px 1px rgba(1,1,1,0.8);
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
