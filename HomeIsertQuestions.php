<html>
<?php
include 'Session.php';
$EmailOrPhone = $_SESSION['EmailAddressOrPhoneNumber'];
$password = $_SESSION['Password'];
?>
<head>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
</head>
<?php
include("db.php");
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
    }
 }
 ?>
 <?php
 include("db.php");
 $query = "select * from scholardetails where EmailAddressOrPhoneNumber != '$EmailOrPhone' and LevelOfEducation like '$Level' and DOB != ''";
 $data = mysqli_query($conn, $query);
 $Total = mysqli_num_rows($data);
 if ($Total!=0)
  {
    while ($result = mysqli_fetch_assoc($data))
     {
       $DateOfB = $result['DOB'];

     }
  }
  ?>
  <?php
  include("db.php");
  $query = "select * from scholardetails where EmailAddressOrPhoneNumber = '$EmailOrPhone' and LevelOfEducation like '$Level'";
  $data = mysqli_query($conn, $query);
  $Total = mysqli_num_rows($data);
  if ($Total!=0)
   {
     while ($result = mysqli_fetch_assoc($data))
      {
        $Genderii = $result['Gender'];
      }
   }
   ?>
   <?php
   if(isset($_POST['LoadsCommens']))
   {
     include("db.php");
     $query = "select * from scholaruploadingquestions where Level = '$Level'";
     $data = mysqli_query($conn, $query);
     $Total = mysqli_num_rows($data);
     if ($Total!=0)
      {
        while ($resultM = mysqli_fetch_assoc($data))
         {
           $SenderQID = $resultM['EmailAddressOrPhoneNumber'];
           $Descriptions = $resultM['Descriptions'];
           $Qphoto = $resultM['QuestionsPhotos'];
           $Pphoto = $resultM['ProfilePhoto'];
           $Fname = $resultM['FirstName'];
           $Lname = $resultM['LastName'];
           $Lev = $resultM['Level'];
           $QuestionID = $resultM['ID'];
         }
       }
     $query = "select * from comments where CommentedID = '$SenderQID' and QuestionID = '$QuestionID'";
     $data = mysqli_query($conn, $query);
     $Total = mysqli_num_rows($data);
     if ($Total!=0)
      {
        while ($result = mysqli_fetch_assoc($data))
         {
                 if($result['QuestionPhoto'] == '')
                 {
                   ?>
                   <div style="padding:2%;padding-bottom:4%">
                       <div style="width:100%;padding:0">
                          <img class="thumbnail" src="<?php echo $result['Profile'] ?>" style="width:56px;height:8%;float:left;border-radius:40px">
                          <h7 class="text-primary" style="float:left;margin-left:1%;font-size:80%"><?php echo $result['FirstName'] ?></h7>
                          <h7 class="text-primary" style="float:left;margin-left:0.5%;font-size:80%"><?php echo $result['LastName']?></h7><br/>
                          <div class="thumbnail" style="width:10%;float:left;margin-left:1%">
                            <a href="ChattingRoom.php"><i title="Start Chatting with <?php echo $result['FirstName'] ?>" class="fa fa-comments" style="float:left;cursor:pointer"></i></a>
                            <i title="Adding <?php echo $result['FirstName'] ?> To My group" class="fa fa-plus-square" style="float:left;cursor:pointer;margin-left:8%"></i>
                          </div>
                       </div><br/>
                       <div class="thumbnail" style="float:left;margin-left:2%;padding:1%;border-radius: 10px;margin-top:-2%;background-color:navy;color:white;font-size:80%">
                           <?php echo $result['Comments'] ?>
                       </div>
                   </div><br/>
                   <?php
                 }
                 else
                 {
                   ?>
                   <div style="padding:2%">
                       <div style="width:100%;padding:0">
                          <img class="thumbnail" src="<?php echo $result['Profile'] ?>" style="width:56px;height:8%;float:left;border-radius:40px">
                          <h7 class="text-primary" style="float:left;margin-left:1%;font-size:80%"><?php echo $result['FirstName'] ?></h7>
                          <h7 class="text-primary" style="float:left;margin-left:0.5%;font-size:80%"><?php echo $result['LastName']?></h7><br/>
                          <div class="thumbnail" style="width:10%;float:left;margin-left:1%">
                            <a href="ChattingRoom.php"><i title="Start Chatting with <?php echo $result['FirstName'] ?>" class="fa fa-comments" style="float:left;cursor:pointer"></i></a>
                            <i title="Adding <?php echo $result['FirstName'] ?> To My group" class="fa fa-plus-square" style="float:left;cursor:pointer;margin-left:8%"></i>
                          </div>
                       </div><br/><br/><br/>
                       <img class="thumbnail" src="<?php echo $result['QuestionPhoto'] ?>" style="float:left;margin-top:-1%;width:40%"/>
                       <div class="thumbnail" style="float:left;margin-left:2%;padding:1%;border-radius: 10px;margin-top:-1%;background-color:navy;color:white;font-size:80%">
                           <?php echo $result['Comments'] ?>
                       </div>
                       <br/><br/>
                       <hr style="margin-top:18%"/>
                   </div>
                   <?php
                 }
        }
    }
  }
  ?>
  <?php
  if(isset($_POST['LoadsCommens2']))
  {
    include("db.php");
    $query = "select * from scholaruploadingquestions where Level = '$Level'";
    $data = mysqli_query($conn, $query);
    $Total = mysqli_num_rows($data);
    if ($Total!=0)
     {
       while ($resultM = mysqli_fetch_assoc($data))
        {
          $SenderQID = $resultM['EmailAddressOrPhoneNumber'];
          $Descriptions = $resultM['Descriptions'];
          $Qphoto = $resultM['QuestionsPhotos'];
          $Pphoto = $resultM['ProfilePhoto'];
          $Fname = $resultM['FirstName'];
          $Lname = $resultM['LastName'];
          $Lev = $resultM['Level'];
          $QuestionID = $resultM['ID'];
          include("db.php");
                $query = "select * from comments where CommentedID = '$SenderQID' and Comments != '' ";
                $data = mysqli_query($conn, $query);
                $Totalaa = mysqli_num_rows($data);
                if ($Totalaa!=0)
                 {
                   while ($result = mysqli_fetch_assoc($data))
                    {

                    if($result['QuestionPhoto'] == '')
                    {
                      ?>
                      <div style="padding:2%">
                          <div style="width:100%;padding:0">
                             <img class="thumbnail" src="<?php echo $result['Profile'] ?>" style="width:56px;height:8%;float:left;border-radius:40px">
                             <h7 class="text-primary" style="float:left;margin-left:1%;font-size:80%"><?php echo $result['FirstName'] ?></h7>
                             <h7 class="text-primary" style="float:left;margin-left:0.5%;font-size:80%"><?php echo $result['LastName']?></h7><br/>
                             <div class="thumbnail" style="width:10%;float:left;margin-left:1%">
                               <a href="ChattingRoom.php"><i title="Start Chatting with <?php echo $result['FirstName'] ?>" class="fa fa-comments" style="float:left;cursor:pointer"></i></a>
                               <i title="Adding <?php echo $result['FirstName'] ?> To My group" class="fa fa-plus-square" style="float:left;cursor:pointer;margin-left:8%"></i>
                             </div>
                          </div><br/>
                          <div class="thumbnail" style="float:left;margin-left:2%;padding:1%;border-radius: 10px;margin-top:-2%;background-color:navy;color:white;font-size:80%">
                              <?php echo $result['Comments'] ?>
                          </div>
                      </div><br/>
                        <h7 style="background-color:lightgray;width:100%;height:2px"></h7>
                      <?php
                    }
                    else
                    {
                      ?>
                      <div style="padding:2%">
                          <hr/>
                          <div style="width:100%;padding:0">
                             <img class="thumbnail" src="<?php echo $result['Profile'] ?>" style="width:50px;height:8%;float:left;border-radius:40px">
                             <h7 class="text-primary" style="float:left;margin-left:1%;font-size:80%"><?php echo $result['FirstName'] ?></h7>
                             <h7 class="text-primary" style="float:left;margin-left:0.5%;font-size:80%"><?php echo $result['LastName']?></h7><br/>
                             <div class="thumbnail" style="width:10%;float:left;margin-left:1%">
                               <a href="ChattingRoom.php"><i title="Start Chatting with <?php echo $result['FirstName'] ?>" class="fa fa-comments" style="float:left;cursor:pointer"></i></a>
                               <i title="Adding <?php echo $result['FirstName'] ?> To My group" class="fa fa-plus-square" style="float:left;cursor:pointer;margin-left:8%"></i>
                             </div>
                          </div><br/><br/>
                          <img class="thumbnail" src="<?php echo $result['QuestionPhoto'] ?>" style="float:left;margin-top:-1%;width:40%"/>
                          <div class="thumbnail" style="float:left;margin-left:2%;padding:0.5%;border-radius:20px">
                              <?php echo $result['Comments'] ?>
                          </div>
                          <br/><br/>
                          <hr style="margin-top:18%"/>
                      </div>
                      <?php
                    }
                }
            }
         }
      }

 }
 ?>
<?php
if(isset($_POST['SelectQuestionPhotos']))
{
  //load questions
  include("db.php");
  $query = "select * from scholaruploadingquestions where Level = '$Level'";
  $data = mysqli_query($conn, $query);
  $Total = mysqli_num_rows($data);
  if ($Total!=0)
   {
     while ($resultM = mysqli_fetch_assoc($data))
      {
        $SenderQID = $resultM['EmailAddressOrPhoneNumber'];
        $Descriptions = $resultM['Descriptions'];
        $Qphoto = $resultM['QuestionsPhotos'];
        $Pphoto = $resultM['ProfilePhoto'];
        $Fname = $resultM['FirstName'];
        $Lname = $resultM['LastName'];
        $Lev = $resultM['Level'];
        $QuestionID = $resultM['ID'];
        if($Descriptions != ''  and $Qphoto !='')
        {
          ?>
          <div class="card-body" style="width:68%;padding-bottom: 10px;height:auto;height:auto;border-radius:10px;border-style: solid;border-width: thin;border-color:lightgray;margin-Left:2%;background-color:white;margin-top:0.5%">
            <div style="padding:2%">
                <img  src="<?php
              if($Pphoto == '')
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
                echo $Pphoto;
              }
               ?>" style="float: left;width: 50px;height:50px;border-radius:100px;background-color:lightgray"/>
              <a style="float:right;margin-right:-1%"><i class="glyphicon glyphicon-option-vertical" style="float: right;cursor: pointer;font-size:110%;color:black"></i></a>
              <h4 class="text-primary" style="border-radius:20px;padding-left: 1%;padding-right: 2%;float:left;margin-Left:1%;margin-top:2%;font-size:83%;font-weight:bold"><?php echo $Fname ?></h4><h4 class="text-primary" style="float:left;margin-top:2%;margin-left:-1%;font-size:83%;font-weight:bold">
              <?php echo $Lname ?></h4><br/><br/><br/>
              <h4 style="float:left;color:gray;font-size:83%;margin-left:0%"><?php echo $resultM['PostDay'] ?> at <?php echo $resultM['PostTime'] ?></h4>
              <br/>
              <hr/>
              <h4 style="font-family:'';float:left;margin-top:-2%;font-size:100%"><?php echo $Descriptions ?></h4>
            </div>
            <a href="<?php echo $Qphoto; ?>"><img  title="Click to see question" src="<?php echo $Qphoto; ?>"  style="cursor:pointer;width: 100%;margin-top: 0px;height:58%"/></a><br/><br/>
             <h4 style="cursor:pointer;float:left;margin-top:-1.5%;margin-left: 2%;font-family:'Berlin Sans FB Demi'"></h4><h4 style="cursor:pointer;float:right;margin-right: 2%;margin-top:-1.5%;font-family:'Berlin Sans FB Demi'"></h4>
          <div style="padding:2%;margin-top:-2%">
             <h4 data-toggle="tooltip" title="See Your fellow replies" onclick="LoadTheComments1()" style="cursor:pointer;float:right;margin-top:-1.2%;font-family:'Berlin Sans FB Demi';font-weight:bold"><i class="fa fa-sort-desc" style="margin-left:-2%"></i>  replies</h4>
           </div>
           <div style="">
             <hr/>
           </div>
           <div style="padding:2%">
             <div id="TheReplies1" class="thumbnail" style="display: none;height:auto;margin-top:-2%;padding:0%;border-radius:8px;border-left-style:solid;border-left-width:5px;border-left-color:#0F52BA;border-right-style:solid;border-right-width:5px;border-right-color:#0F52BA">

             </div>
             <center>
             <div>
              <form method="post" action="#" enctype="multipart/form-data">
                <input name="SenderID" value="<?php echo $resultM['EmailAddressOrPhoneNumber'] ?>" style="display: none"><input name="SenderPid" value="<?php echo $resultM['ID'] ?>" style="display: none">
                <input name="AnswerComments" type="text"  placeholder="Writting answer here.. to help <?php echo $Fname ?>" style="outline:none;width:66%;border-radius:30px;float:left;padding-left:2%;height:6%;border-style:solid;border-width:thin;border-color:gray;padding-right:9%">
                <div class="div file btn btn-lg btn-default" style="width:5%;border-radius:10px;padding:0%;padding-left:0%;margin-top:-1%;margin-left:-46%;border-width:0;background-color:transparent">
                  <input name="AnswerComments" title="Choose Question Photo" class="input" type="file" style="cursor: pointer"/><i class="fa fa-file-photo-o" style="font-size:130%;color:gray"></i>
                </div>
                <button type="submit" name="SendMyComment" style="border-width:0;background-color:transparent;font-size:110%;outline: none;cursor:pointer;margin-left:-0.5%;margin-top:1%" ><i id = "SendCommentss" title="Send answer" class="fa fa-paper-plane" style="font-size:160%;cursor:pointer;margin-left:-0.5%;color:gray;margin-top:1%"></i></button>
              </form>
            </div>
          </center>
        </div>
          </div>
          <?php
        }
        elseif($Descriptions != '' and $Qphoto =='')
        {
          ?>
          <div  class="card-body" style="width:68%;padding:1%;padding-bottom:1%;height:auto ;border-radius:5px;box-shadow: 0px 1px 3px 1px rgba(1,1,1,0.3);margin-Left:2%;background-color:white;margin-top:0.5%;border-bottom-style:solid;border-bottom-width:thin;border-bottom-color:black">
            <img src="<?php echo $Pphoto; ?>" style="float: left;width: 45px;height:7%;border-radius:100px;background-color:lightgray"/>
            <i class="glyphicon glyphicon-option-vertical" style="float: right;cursor: pointer;margin-right:-1%;font-size:150%;color:black"></i>
            <h4 class="text-primary" style="border-radius:20px;padding-left: 1%;padding-right: 2%;float:left;margin-Left:1%;margin-top:2%;font-size:83%;font-weight:bold"><?php echo $Fname ?></h4><h4 class="text-primary" style="float:left;margin-top:2%;margin-left:-1.5%;font-size:83%;font-weight:bold">
            <?php echo $Lname ?></h4><br/><br/><br/><br/><br/>
            <h4 style="float:left;color:gray;font-size:83%;margin-top:-4%;margin-left:0%"><?php echo $resultM['PostDay'] ?> at <?php echo $resultM['PostTime'] ?></h4>
            <hr style="margin-Top:-1%"/>
            <h4 style="font-family:'Berlin Sans FB Demi';float:left;margin-top:-2%;font-size:120%"><?php echo $Descriptions ?></h4><br/>
            <center>
             <h4 title="See friends replies" onclick="LoadTheComments2()" style="cursor:pointer;float:right;margin-top:1.5%;font-family:'Berlin Sans FB Demi';color:navy;font-weight:bold">replies</h4>
            <input id="SenderID" value="<?php echo $resultM['EmailAddressOrPhoneNumber'] ?>" style="display: none"><input id="SenderPid" value="<?php echo $resultM['ID'] ?>" style="display: none">
              </center><br/><br/><hr/>
            <br/>
            <div id="TheReplies2" class="thumbnail" style="display: none;height:auto;margin-top:-6%;padding:0%;border-radius:8px;border-left-style:solid;border-left-width:5px;border-left-color:#0F52BA;border-right-style:solid;border-right-width:5px;border-right-color:#0F52BA">

            </div>
            <center>
             <div>
               <form method="post" action="#" enctype="multipart/form-data">
                 <input name="SenderID" value="<?php echo $resultM['EmailAddressOrPhoneNumber'] ?>" style="display: none"><input name="SenderPid" value="<?php echo $resultM['ID'] ?>" style="display: none">
                <input name="AnswerComments" type="text"  placeholder="Writting answer here.. to help <?php echo $Fname ?>" style="outline:none;width:66%;border-radius:30px;float:left;padding-left:2%;height:6%;border-style:solid;border-width:thin;border-color:gray;padding-right:9%">
                <div class="div file btn btn-lg btn-default" style="width:5%;border-radius:10px;padding:0%;padding-left:0%;margin-top:-1%;margin-left:-46%;border-width:0;background-color:transparent">
                  <input name="AnswerPicture" title="Choose Question Photo" class="input" type="file"  style="cursor: pointer"/><i class="fa fa-file-photo-o" style="font-size:130%;color:gray"></i>
                </div>
                <button type="submit" name="SendMyComment" style="border-width:0;background-color:transparent;font-size:110%;outline: none;cursor:pointer;margin-left:-0.5%;margin-top:1%" ><i title="Send answer" class="fa fa-paper-plane" style="font-size:160%;cursor:pointer;margin-left:-0.5%;color:gray;margin-top:1%"></i></button>
              </form>
             </div>
          </center>
        </div><br/>
          <?php
        }
      }
   }
}
?>
<?php
if(isset($_POST['ShowBirthdayAlert']))
{
  if($DateOfB == '')
  {

  }
  else
  {
   $bday  = new DateTime($DateOfB);
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
   $Days  = $diff->format('%a');
   if($Days < '0')
   {
       include("db.php");
       $query = "select * from scholardetails where DOB != ''";
       $data = mysqli_query($conn, $query);
       $Total = mysqli_num_rows($data);
       if ($Total!=0)
        {
          while ($resultM = mysqli_fetch_assoc($data))
           {
             include 'Session.php';
             $query = "update scholardetails set BirthDay_Alert = '0' where EmailAddressOrPhoneNumber != '$EmailOrPhone' and DOB != ''";
             mysqli_query($conn, $query);
             mysqli_close($conn);
           }
        }
   }
   else
   {
      $Days  = $diff->format('%a');
     if(($Days == '0') || ($Days > '0'))
     {
       include("db.php");
       $query = "select * from scholardetails where DOB != ''";
       $data = mysqli_query($conn, $query);
       $Total = mysqli_num_rows($data);
       if ($Total!=0)
        {
          while ($resultM = mysqli_fetch_assoc($data))
           {
             include 'Session.php';
             $query = "update scholardetails set BirthDay_Alert = '1' where EmailAddressOrPhoneNumber != '$EmailOrPhone'";
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
if(isset($_POST['LoadBirthDay']))
{
$conn = mysqli_connect("localhost","root","","scholardiscussiondata");
$query = "select * from scholardetails where DOB !='' and EmailAddressOrPhoneNumber != '$EmailOrPhone' and LevelOfEducation like '$Level' and BirthDay_Alert = '1'";
$data = mysqli_query($conn, $query);
$Total2 = mysqli_num_rows($data);
 if($Total2!=0)
  {
    ?><h7 id="AleertBirthday" style="font-size:80%;border-radius:100px;background-color:red;color:white;padding-left:22%;padding-right:54%;padding-top:3.4%;padding-bottom:8.5%;float:right;margin-top:-1%;margin-right:-58%"><?php echo  $Total2;?></h7><?php
  }
}
?>
<audio id="myAudio2" preload="auto">
    <source src="Photos/shut-your-mouth.mp3"> </source>
</audio>
<script>
    var x = document.getElementById("myAudio2");
    function playAudio2()
    {
     x.play();
    }
</script>
<script>
$(document).ready(function()
{
  setInterval(function(){
    LoadComments();
    LoadComments2();
  }, 300);
      $("#LikesMe").click(function(){
        var SenderID = $("#SenderID").val();
        var SenderPid = $("#SenderPid").val();
        $.ajax({
            url: "GetLikes.php",
            type: "post",
            async: false,
            data:{
            "InsertLikes": 1,
            "SenderID": SenderID,
            "SenderPid": SenderPid
            },
            success: function(data)
            {
              playAudio2();
            }
        });
      });
  });
  function LoadComments()
  {
    $.ajax({
        url: "HomeIsertQuestions.php",
        type: "post",
        async: false,
        data:{
        "LoadsCommens": 1,
        },
        success: function(data)
        {
          $("#TheReplies1").html(data);
        }
    });
  }
  function LoadComments2()
  {
    $.ajax({
        url: "HomeIsertQuestions.php",
        type: "post",
        async: false,
        data:{
        "LoadsCommens2": 1,
        },
        success: function(data)
        {
          $("#TheReplies2").html(data);
        }
    });
  }
</script>
<style>
.HoverLikeAndAnswer:hover
{
  color:blue;
  border-radius:70px;
  transition: 0.6s;
}
.HoverComment:hover
{
  color:orange;
  border-radius:70px;
  transition: 0.6s;
}
</style>
<style>
</script>
</html>
