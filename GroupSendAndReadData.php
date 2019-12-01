<html>
<?php
include 'Session.php';
$EmailOrPhone = $_SESSION['EmailAddressOrPhoneNumber'];
$password = $_SESSION['Password'];
include("db.php");
//student profile
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
$query = "select * from groups where GroupReader = '$EmailOrPhone' and Active = '1'";
$data = mysqli_query($conn, $query);
$Total = mysqli_num_rows($data);
if ($Total!=0)
{
  while ($resultLoadGroupID = mysqli_fetch_assoc($data))
  {
    $GroupIDS = $resultLoadGroupID['GroupID'];
    $conn = mysqli_connect("localhost","root","","scholardiscussiondata");
    $query = "select * from scholar_group_members where Group_MemberID = '$GroupIDS'";
    $data = mysqli_query($conn, $query);
    $Total = mysqli_num_rows($data);
    if ($Total!=0)
    {
      while ($Check = mysqli_fetch_assoc($data))
      {
          $CheckMyMembers = $Check['Members'];
      }
    }
  }
}
 ?>
 <?php
 if(isset($_POST['LoadPastpapers']))
 {
   $conn = mysqli_connect("localhost","root","","scholardiscussiondata");
   $query = "select * from scholar_group_members where Members = '$EmailOrPhone' and Active = '1'";
   $data = mysqli_query($conn, $query);
   $Totalaa = mysqli_num_rows($data);
   if ($Totalaa!=0)
   {
     while($resultss = mysqli_fetch_assoc($data))
     {
       $Groupid = $resultss['Group_MemberID'];
       $conn = mysqli_connect("localhost","root","","scholardiscussiondata");
       $querye = "select * from student_group_pastpaper_and_notes";
       $data = mysqli_query($conn, $querye);
       $Total = mysqli_num_rows($data);
        if ($Total!=0)
        {
         while ($results = mysqli_fetch_assoc($data))
         {
           if($Groupid == $results['Group_ID'])
           {
             $GroupImages = $results['Group_Notes_And_PastPapers'];
             ?>
              <img class="thumbnail" src="<?php echo $GroupImages ?>" style="width:15%;height:56%;float:left;margin-left:0.2%">
             <?php
           }
            else
            {
              //
            }
         }
        }
     }
   }
   elseif($Totalaa == 0)
   {
     echo 'No uploaded image';
   }
 }
?>
<?php
include("db.php");
//student profile
$query = "select * from groups where GroupReader != ''";
$data = mysqli_query($conn, $query);
$Total = mysqli_num_rows($data);
if ($Total!=0)
 {
 while ($result = mysqli_fetch_assoc($data))
  {
    $GroupLeaders = $result['GroupReader'];
  }
 }
?>
<?php if(isset($_POST['doneMe']))
{
  $Sdate = date("h:i a");
  $day = date("d M Y");
  $Message = $_POST['Message'];
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
      while ($resultGroupJoinOrCreate = mysqli_fetch_assoc($data))
      {
          $MyGroup = $resultGroupJoinOrCreate['Group_MemberID'];
          $queryis = "Insert into scholar_group_chatting(Sender_Message,Group_ID,Group_Messages,SenderProfile,SenderName,Day_Of_Sent,Time_Of_Sent,Active) values ('$EmailOrPhone','$MyGroup','$Message','$Photo','$FirstName','$day','$Sdate','1')";
          mysqli_query($conn, $queryis);
          mysqli_close($conn);
      }
    }
  }
  exit();
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
    }
    }
  }
}
?>
<?php
if(isset($_POST['displayMessages']))
{
  $conn = mysqli_connect("localhost","root","","scholardiscussiondata");
  $query = "select * from scholar_group_members where Members = '$EmailOrPhone' and Active = '1'";
  $data = mysqli_query($conn, $query);
  $Total = mysqli_num_rows($data);
  if ($Total!=0)
  {
    while ($resultLoadGroupID = mysqli_fetch_assoc($data))
    {
          $MyActiveGroup =  $resultLoadGroupID['Group_MemberID'];
          $query = "select * from scholar_group_chatting where Group_ID = '$MyActiveGroup' and Group_Messages !='' and Active = '1'";
          $data = mysqli_query($conn, $query);
          $Total = mysqli_num_rows($data);
          if ($Total!=0)
          {
            while ($resultMessages = mysqli_fetch_assoc($data))
            {
                if($resultMessages['Sender_Message'] != $EmailOrPhone)
                {
                  ?>
                  <img title="<?php echo  $resultMessages['SenderName'] ?>" src="<?php echo  $resultMessages['SenderProfile'] ?>" style="height:25px;width:25px;border-radius:15px;float:left">
                  <h7 title="<?php echo  $resultMessages['Time_Of_Sent'] ?>" style="float: left;border-radius:20px;background-color:#D9DDDC;font-size:80%;padding:2%;margin-left:1%;max-width: 180px;border-top-left-radius:0px"><?php echo  $resultMessages['Group_Messages']; ?></h7>
                  <br/><br/>
                  <?php
                }
                else
                {
                  ?>
                  <h7  title="Sent at <?php echo  $resultMessages['Time_Of_Sent'] ?>" style="float: right;border-radius:15px;background-color:#008DFE;color:white;font-size:80%;padding:2%;max-width: 180px"><?php echo  $resultMessages['Group_Messages']; ?></h7><br/><br/>
                  <?php
                }
            }
          }
     }
   }
}
?>

<?php
if(isset($_POST['displayPatner']))
{
$conn = mysqli_connect("localhost","root","","scholardiscussiondata");
$query = "select * from scholardetails where EmailAddressOrPhoneNumber != '$EmailOrPhone' and LevelOfEducation = '$Level'";
$data = mysqli_query($conn, $query);
$Total = mysqli_num_rows($data);
if ($Total!=0)
{
while ($resulti = mysqli_fetch_assoc($data))
{
$GenderI = $resulti['Gender'];
$ToS =  $resulti['EmailAddressOrPhoneNumber'];
?>
<div class="StyleMe">
 <img class="StyleFriend" src="<?php
 if($resulti['ProfilePhoto']=='')
 {
   if($GenderI == 'Male')
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
   echo $resulti['ProfilePhoto'];
 }
 ?>
 "
  style="color:lightgray;border-top-left-radius: 4px;border-top-right-radius: 4px;width:100%"/><br/>
  <form method="post" action="#" enctype="multipart/form-data">
    <input name="PatnerEmail" type="text" value="<?php echo  $resulti['EmailAddressOrPhoneNumber'] ?>" style="display: none">
    <input name="GroupMemberName" type="text" value="<?php echo  $resulti['FirstName'] ?>" style="display: none">
    <input name="GroupMemberProfilePhoto" type="text" value="<?php echo  $resulti['ProfilePhoto'] ?>" style="display: none">
   <button type="submit" name="AddToMyGroup"  title="Add <?php echo $resulti['FirstName'];?> to my group" style="border-width:0;float:right;color:navy;margin-right:4%;margin-top:3%;background-color:transparent;outline: none">
     <i class="fa fa-user-plus" style="float:right;color:navy;margin-right:4%;margin-top:3%"></i>
   </button>
  </form>
   <h8 class="text-primary" style="float:left;margin-left:4%;font-size:88%;margin-top:-8%;font-family: 'Arial Narrow';font-weight: bold"><?php echo $resulti['FirstName'];?></h8><br/>
  <?php
    if($resulti['Online']=='1')
    {
      ?><h6 title="active now" class="thumbnail" style="height:7%;width: 7%;float:left;margin-top:-10%;border-radius:100px;background-color:#50C878;margin-left:4%"></h6><?php
    }
    else
    {
      ?><h6 title="Not active" class="thumbnail" style="height:7%;width: 7%;float:left;margin-top:-10%;border-radius:100px;background-color:orangered;margin-left:4%"></h6><?php
    }
  ?>
 <br/>
</div>
<?php
}
}
}
?>
<?php
if(isset($_POST['LoadMembers']))
{
  //Load Group Members
$conn = mysqli_connect("localhost","root","","scholardiscussiondata");
$query = "select * from scholar_group_members where Group_MemberID = '$GroupIDii' and Active = '1'";
$data = mysqli_query($conn, $query);
$Total = mysqli_num_rows($data);
if ($Total!=0)
 {
   ?><h7 class="thumbnail" style="float:left;margin-left:0.5%;font-size:90%;color:green;border-color:green"><?php echo $Total; ?>  Members</h7><br/>
   <a  id="LeaveFromMygroup"  title="Leave from group" style="color:red;float:right;margin-top:-2%;margin-right:1%;font-size:70%;font-family:'Cambria';cursor:pointer">Leave group</a>
   <br/>
   <div style="width:100%;height:2%;background-color:orange;margin-top:-1%;border-bottom-style:solid;border-bottom-width:thin;border-bottom-color:black"></div><br/>
   <?php
   while ($resultGroupsMembers = mysqli_fetch_assoc($data))
    {
       ?>
          <img  src="<?php
          if($resultGroupsMembers['Members_Profile_picture'] == '')
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
            echo $resultGroupsMembers['Members_Profile_picture'];
          }
          ?>" style="height:12%;width:43px;margin-top:0%;margin-left:1%;float: left;border-style: solid;border-width: medium;border-color:white;border-radius:40px"/><h7 style="font-size:80%;margin-left:2%;float:left;margin-top:3%;font-weight:bold">
          <?php
             if($resultGroupsMembers['Members'] == $EmailOrPhone)
             {
               ?><h8 style="color:orange;font-weight:bold"><?php echo 'Me'; ?></h8><?php
             }
             else
             {
                echo $resultGroupsMembers['Members_Names'];
             }
          ?></h7>
          <br/>
          <hr/>
        <?php
    }
    ?>
    <hr/>
    <center>
      <h7 style="font-size:70%;font-style:oblique;font-weight:bold;color:red;font-family:'Cambria';text-shadow:1px 1px 5px 1px rgba(1,1,1,0.3)">--- Members ended ---</h7>
    </center>
    <?php
  }
}
?>
<?php if(isset($_POST['Insert1']))
{
  $IsTyping = '1';
  $conn = mysqli_connect('localhost','root','','scholardiscussiondata');
  if(!$conn)
   {
     die('server not connected');
   }
  else
  {
      $queryis = "update scholardetails set Is_typing = '$IsTyping' where EmailAddressOrPhoneNumber like '$EmailOrPhone'";
      mysqli_query($conn, $queryis);
      mysqli_close($conn);
  }
}
?>
<?php if(isset($_POST['Insert0']))
{
  $IsTyping = '0';
  $conn = mysqli_connect('localhost','root','','scholardiscussiondata');
  if(!$conn)
   {
     die('server not connected');
   }
  else
  {
      $queryis = "update scholardetails set Is_typing = '$IsTyping' where EmailAddressOrPhoneNumber like '$EmailOrPhone'";
      mysqli_query($conn, $queryis);
      mysqli_close($conn);
  }
}
?>
<?php
if(isset($_POST['displayAlertTyping']))
{
//Load Group typing Alert
$conn = mysqli_connect("localhost","root","","scholardiscussiondata");
$query = "select * from scholardetails where EmailAddressOrPhoneNumber != '$EmailOrPhone' and Is_typing = '1'";
$data = mysqli_query($conn, $query);
$Total = mysqli_num_rows($data);
if ($Total!=0)
{
    while ($resulti = mysqli_fetch_assoc($data))
    {
      ?><h7 style="font-style:oblique;font-size:72%;margin-left:2%;color:green;font-weight:bold;margin-top:-2%"><?php echo $resulti['FirstName']; ?> typing..</h7>
      <?php
    }
}
}
?>
<?php
//Load Group History
if(isset($_POST['GroupHistory']))
{
$conn = mysqli_connect("localhost","root","","scholardiscussiondata");
$query = "select * from scholar_group_members where Members = '$EmailOrPhone'";
$data = mysqli_query($conn, $query);
$Total = mysqli_num_rows($data);
if ($Total!=0)
{
  while ($resultLoadGroupID = mysqli_fetch_assoc($data))
  {
      ?>
      <form method="post" action="#" enctype="multipart/form-data">
            <div  style="margin-top:-6.1%">
              <a>
                <input name="ID" value="<?php echo $resultLoadGroupID['Group_MemberID'] ?>" style="display:none">
                <button  type="submit" name="SelectMyGroup" class="btn btn-secondary" style="height:5%;border-radius:0;border-width:0;margin-top:0%;border-top-style:solid;border-top-width:thin;border-top-color:navy"><img src="<?php echo $resultLoadGroupID['GroupImage'] ?>" style="float: left;height:108%;width:10%"/>
                <h8 style="margin-right:12%"><?php echo $resultLoadGroupID['GroupName'] ?></h8></button></a>
            </div>
      </form>

    <?php
  }
}
}
?>
<?php
if(isset($_POST['ShowChattingArea']))
{
$conn = mysqli_connect("localhost","root","","scholardiscussiondata");
$query = "select * from scholar_group_members where Active = '1' and Members = '$EmailOrPhone'";
$data = mysqli_query($conn, $query);
$Total = mysqli_num_rows($data);
if ($Total!=0)
{
  while ($resultLoadGroupID = mysqli_fetch_assoc($data))
  {
    if(($resultLoadGroupID['Members'] != $EmailOrPhone))
    {

      ?>
      <center><br/><h7 class="thumbnail" style="color:red;border-bottom-style:solid;border-bottom-width:thin;border-bottom-color:red;border-top-style:solid;border-top-width:thin;border-top-color:red;box-shadow:1px 1px 6px 1px rgba(1,1,1,0.7)">You don't have any Jonned or created group</h7>
      <img class="thumbnail" src="Photos/AFFG_logo02_1.png" style="width:20%;height:20%;background-color:transparent;padding-right:2%"><br/>
      <h7 style="font-family:'Cambria';font-weight:bold">Groups help you to share ideas with fellow students of different countries about studies</h7>
      </center>
      <?php
    }
    else
    {
          ?>
          <div id="ChattingArea"  style="border-radius:24px;width:370px;height:70%;margin-left:15.6%;margin-top:0.3%;border-style:solid;border-color:white;border-width:thin">
          <div id="HeaderPicture" style="width:100%;height:20%;background-color:#0F52BA;padding-left:2%;padding-right:2%;border-top-right-radius:23px;border-top-left-radius:23px;background-image: url('<?php echo $resultLoadGroupID['GroupImage'] ?>');background-attachment: fixed;background-size:49%,100%;background-repeat:repeat"><br/>
          <center><h3  style=";padding:0.03%;margin-top:-0.01%;color:white;text-shadow: 1px 1px 1px 1px rgba(0,0,0,0.3);font-weight:bold"><?php echo $resultLoadGroupID['GroupName'] ?></h3></center>
          <div id="ShowPanel" class="thumbnail" style="height:35%;margin-top:5%;border-color:black;border-width:2px;border-style:solid;border-radius:10px;border-bottom-left-radius:0;border-bottom-right-radius:0">
          <i onclick="ShowGroupMembers()" data-toggle="tooltip" title="Group members"class="fa fa-users HoverPanelGroup" style="cursor:pointer;margin-top:-2%;border-radius: 20px;margin-left:1%;font-size:110%"></i>
          <i id="myBtn" data-toggle="tooltip" title="Group calendar" class="fa fa-calendar HoverPanelGroup" style="cursor:pointer;margin-top:-2%;border-radius: 20px;margin-left:1%;font-size:110%"></i>
          <i id="GroupInfo" data-toggle="tooltip" title="Group info" class ="fa fa-info-circle HoverPanelGroup" style="cursor:pointer;margin-top:1.5%;border-radius: 20px;margin-left:1%;font-size:125%"></i>
          <i onclick="OpenGroupPastPapers()"  id="GroupInfo" data-toggle="tooltip" title="Group notes and Pastpapers" class ="fa fa-sticky-note HoverPanelGroup" style="cursor:pointer;margin-top:1.5%;border-radius: 20px;margin-left:1%;font-size:120%"></i>
          <h7  id="IsTyping" style="margin-top:-6%"></h7>
          </div>

          </div>
          <div id="BodyMessages" style="width:100%;height:70%;background-color:white;border-bottom-style: solid;border-bottom-width: thin;border-bottom-color: black;border-top-style: solid;border-top-width:2px;border-top-color: black;overflow-y: auto;padding:2%">

          </div>
          <div id="WrittingArea" class="" style="width:100%;height:10%;background-color:#0F52BA;padding:0.2%;padding-left: 0.5%;padding-right: 0.5%;border-bottom-right-radius:23px;border-bottom-left-radius:23px;margin-Top:0">
          <center><input onclick="ClickBoxToshow()" class="TextInput" name="Mytext" spellcheck="off" id="TextInput" autocomplete="off"  placeholder="Text Me..." style="outline:none;text-align: left;width:100%;padding-left:10%;padding-right:10%;float: left;height:98%;border-radius:50px;border-style:solid;border-width:0.2%;"/>
          <div class="div file btn btn-xs btn-default" style="border-radius:2px;margin-top:-4%;height:10%;float:left;background-color:transparent;border-width:0;cursor:pointer;color:#0F52BA;font-size:120%;margin-left:3%;margin-top:-8%;float:left;padding-bottom:4.1%">
            <input title="Adding Picture" required  class="input" type="file" style="cursor: pointer"/><i title="Picture" class="fa fa-camera" style="cursor:pointer;color:#0F52BA"></i>
          </div>
          <i data-toggle="tooltip" title="Send Your Text" id="ShowSend" onclick="UpdateIsNotTyping()" class="fa fa-send" style="cursor:pointer;color:black;font-size:155%;float: right;margin-right:4%;margin-top:-8.5%;color:#0F52BA;display: none;padding:0.3%;border-radius:5px"></i></center>
          </div>
          </div>
        <?php
    }
  }
}
}
?>
<?php
if(isset($_POST['SelectGroupPanel']))
{
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
      ?>
      <div style="width:100%;height:25%;border-radius: 0px;background-color:pink;padding-top:1%;border-top-left-radius:8px;border-top-right-radius:8px;background-image:url('<?php echo $GroupImage ?>')">
        <i onclick="HideGroupMembers()" title="close" class="fa fa-remove" style="float:right;margin-right:1%;border-radius:5px;padding:0.4%;font-size:130%;cursor:pointer"></i>
      <center>
      <br/>
      <h7 style="font-size:210%;text-shadow:1px 1px 5px 1px rgba(1,1,1,0.3);font-family:'cambria';font-weight:bold"><?php echo $GroupName;?>'s  group members</h7>
      <br/>
      <h7 style="font-size:100%;font-family:'Times New Roman';font-weight:bold"><?php echo $GroupDescription ?></h7><br/>
      </center>
      <?php
      $conn = mysqli_connect("localhost","root","","scholardiscussiondata");
      $query = "select * from scholardetails where EmailAddressOrPhoneNumber like '$GroupLeader'";
      $data = mysqli_query($conn, $query);
      $Total = mysqli_num_rows($data);
      if ($Total!=0)
      {
       while ($resultGroupsMembers = mysqli_fetch_assoc($data))
        {
            ?>
              <img src="<?php echo $resultGroupsMembers['ProfilePhoto'] ?>" style="height:38%;margin-left:1%;float: left;border-style: solid;border-width: medium;border-color:white;width:50px;margin-left:0.5%;border-radius:4px"/>
              <?php
                if ($resultGroupsMembers['EmailAddressOrPhoneNumber'] != $EmailOrPhone )
                {
                  ?>
                  <div>
                  <h7 class="thumbnail" style="font-size:60%;float:left;margin-left:0.5%;margin-top:1.5%;background-color:transparent"><h7 style="margin-left:1%;font-size:110%">Admin</h7>
                  </div>
                 <?php
                }
                else
                {
                  ?>
                  <div>
                  <h7 class="thumbnail" style="font-size:70%;float:left;margin-left:0.5%;margin-top:2%;font-weight:bold;background-color:transparent;border-radius:5px;border-color:gray">Me</h7>
                    <img src="Photos/Photo-2-icon (1).png" title="Edit Profile picture" style="height:30%;float:right;margin-right:2%;cursor:pointer"></i>
                  </div>
                 <?php
              }
         }
      }
      ?>
      </div>
      <?php
    }
    }
  }
}
}
?>
<?php if(isset($_POST['UpdateGroupEvent']))
{
  //Update group events
  include("db.php");
  $GroupLeader = $_POST['GroupLeader'];
  $GroupID = $_POST['GroupID'];
  $GroupEvent = $_POST['GroupEvent'];
  $GroupEventDay = $_POST['GroupEventDay'];
  if(!$conn)
   {
     die('server not connected');
   }
  else
  {
      $queryGroupEvent = "insert into Student_Groups_Event(GroupID,Group_Leader,Event,Day_Of_Event) value ('$GroupID','$GroupLeader','$GroupEvent','$GroupEventDay')";
      mysqli_query($conn, $queryGroupEvent);
      mysqli_close($conn);
  }
}
//End update group event
?>
<?php
// Load Group Events
if(isset($_POST['LoadEvents']))
{
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
          $GroupIDis = $resultw['GroupID'];
          $query = "select * from Student_Groups_Event where GroupID = '$GroupIDis' and Event != '' ";
          $data = mysqli_query($conn, $query);
          $Total = mysqli_num_rows($data);
          if ($Total!=0)
          {
            while ($resultEvent = mysqli_fetch_assoc($data))
            {
              $EventDay = $resultEvent['Day_Of_Event'];
              $Today = date('Y-m-d');
                if($EventDay ==  $Today)
                {
                  ?>
                   <table class="table">
                      <td style="background-color:green;color:white;padding:0.1px;padding-left:4%;padding-right: 4%;border-left-style:solid;border-left-width:medium;border-left-color:gray;border-right-style:solid;border-right-width:medium;border-right-color:gray">
                        <h6 style="float:left;margin-left:4%;padding:0.05%;font-weight:bold"><i class="fa fa-bullhorn" style="font-size:120%"></i> <?php echo $resultEvent['Event'] ?></h6>
                        <h6 style="float:right;margin-right:4%;font-weight:bold"><i  class="fa fa-bell-o" style="font-size:120%;color:orange;"></i> <?php echo $resultEvent['Day_Of_Event']?></h6>
                      </td>
                   </table>
                  <?php
                }
                else
                {
                  ?>
                  <table class="table">
                    <td style="padding:0.1px;padding-left:4%;padding-right: 4%;border-left-style:solid;border-left-width:medium;border-left-color:gray;border-right-style:solid;border-right-width:medium;border-right-color:gray">
                      <h6 style="float:left;margin-left:4%"><i class="fa fa-binoculars" style="font-size:120%"></i> <?php echo $resultEvent['Event'] ?></h6>
                      <h6 style="float:right;margin-right:4%;"><i class="fa fa-bell-o" style="font-size:120%"></i> <?php echo $resultEvent['Day_Of_Event']?></h6>
                    </td>
                  </table>
                  <?php
                }
            }
          }
      }
    }
  }
}
}
//End Load group event
?>
<script>
$("#LeaveFromMygroup").click(function(){
$.ajax({
url: "GroupSendAndReadData.php",
type: "post",
async: false,
data: {
"LeaveToGroup":1
},
success: function(data){
HideGroupMembers();
CloseTheGroup();
}
});
});
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

function SelectGroup()
{
var SelectedGroup = $('#ID').val();
$.ajax({
url: "GroupSendAndReadData.php",
type: "post",
async: false,
data: {
"SelectMyGroup":1,
"SelectedGroup":SelectedGroup
},
success: function(data)
{
  ShowSelectGroup();
}
});
}
function CloseTheGroup()
{
  var ChattingArea = document.getElementById('ChattingArea');
  ChattingArea.style.display = 'none';
  alert('Your No longer a participant on this group');
}
function HideGroupMembers()
{
var MygroupMembers = document.getElementById('MygroupMembers');
MygroupMembers.style.display = 'none';
MygroupMembers.style.transition = '0.3s';
}
</script>
</html>
