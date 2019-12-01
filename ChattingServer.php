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
<?php
// Clear Chatting
if(isset($_POST['deleteChats']))
{
  include("db.php");
  $query = "select * from chatting_connector where Connection = '1' and ((Student1 = '$EmailOrPhone' and Student2 != '$EmailOrPhone') or (Student1 != '$EmailOrPhone' and Student2 = '$EmailOrPhone')) ";
  $data = mysqli_query($conn, $query);
  $Total = mysqli_num_rows($data);
  if ($Total!=0)
  {
    while ($ChackIdToClear = mysqli_fetch_assoc($data))
    {
      $TheClearID = $ChackIdToClear['Chatting_ID'];
      include("db.php");
      $queryClear = "update studentchatting set Clear_ID = '0' where Chatting_ID = '$TheClearID'";
      mysqli_query($conn, $queryClear);
      mysqli_close($conn);
    }
  }
}
//end Clear All chatting
?>
<?php
if(isset($_POST['Online']))
{
  include("db.php");
  $queryi="update scholardetails set Online = '1' where EmailAddressOrPhoneNumber like '$UserEmail'";
  $resulti=mysqli_query($conn,$queryi);
}
?>
<?php
if(isset($_POST['Offline']))
{
  include("db.php");
  $queryi="update scholardetails set Online = '0' where EmailAddressOrPhoneNumber like '$UserEmail'";
  $resulti=mysqli_query($conn,$queryi);
}
?>
<?php
if(isset($_POST['SendTheMessage']))
{
  // Inserts Messages Into database
    include("db.php");
    $ChattingTime = date("h:i a");
    $ChattingDay =  date('d M Y');
    $Message = $_POST['Message'];
    $GMname = $_POST['GMname'];
    $Mypicture = $_POST['Mypicture'];
    $query = "select * from chatting_connector where Connection = '1'";
    $data = mysqli_query($conn, $query);
    $Total = mysqli_num_rows($data);
    if ($Total!=0)
    {
      while ($resultGroup = mysqli_fetch_assoc($data))
      {
        if($resultGroup['Student1'] == $EmailOrPhone and $resultGroup['Student2'] != $EmailOrPhone)
        {
          $TheConnectedID  = $resultGroup['Student2'];
          $ChattID  = $resultGroup['Chatting_ID'];
          $query = "Insert into studentchatting(Student1,Student2,Students_Messages,Chatting_ID,ProfilePhoto,StudentName,ChattingTime,ChattingDay,Alert_Of_Income_text,Clear_ID,Connection) values ('$EmailOrPhone','$TheConnectedID','$Message','$ChattID','$Mypicture','$GMname','$ChattingTime','$ChattingDay','0','1','1')";
          mysqli_query($conn, $query);
          mysqli_close($conn);
        }
        elseif($resultGroup['Student2'] == $EmailOrPhone and $resultGroup['Student1'] != $EmailOrPhone)
        {
          $TheConnectedID  = $resultGroup['Student1'];
          $ChattID  = $resultGroup['Chatting_ID'];
          $query = "Insert into studentchatting(Student1,Student2,Students_Messages,Chatting_ID,ProfilePhoto,StudentName,ChattingTime,ChattingDay,Alert_Of_Income_text,Clear_ID,Connection) values ('$EmailOrPhone','$TheConnectedID','$Message','$ChattID','$Mypicture','$GMname','$ChattingTime','$ChattingDay','0','1','1')";
          mysqli_query($conn, $query);
          mysqli_close($conn);
        }
      }
    }
  //end Inserts Messages Into database
}

if(isset($_POST['displayChatting']))
{
  //Display All my chattings
  $query = "select * from chatting_connector where Connection = '1' and ((Student1 = '$EmailOrPhone' and Student2 != '$EmailOrPhone') or (Student1 != '$EmailOrPhone' and Student2 = '$EmailOrPhone')) ";
  $data = mysqli_query($conn, $query);
  $Total = mysqli_num_rows($data);
  if ($Total!=0)
  {
    while ($LoadChattingConn = mysqli_fetch_assoc($data))
    {
        $ChattingID = $LoadChattingConn['Chatting_ID'];
        $query = "select * from studentchatting where Chatting_ID = '$ChattingID' and Students_Messages != '' and Clear_ID = '1'";
        $data = mysqli_query($conn, $query);
        $Total = mysqli_num_rows($data);
        if ($Total!=0)
        {
          while ($resultGroup = mysqli_fetch_assoc($data))
          {
              if(($resultGroup['Student1'] == $EmailOrPhone))
              {
                ?>
                 <h7 title="Sent at <?php echo  $resultGroup['ChattingTime'] ?>" style="float: right;border-radius:15px;background-color:#008DFE;color:white;font-size:81%;padding:1.5%;padding-left:2%;padding-right:2%;font-weight:Bold;max-width: 150px"><?php echo  $resultGroup['Students_Messages'] ?></h7><br/><br/>
                <?php
              }
              else
              {
                ?>
                <img title="<?php echo  $resultGroup['StudentName'] ?>" src="<?php echo  $resultGroup['ProfilePhoto'];  ?>" style="height:10%;width:8.9%;border-radius:15px;float:left">
                <h7 style="float: left;border-radius:20px;max-width: 180px;background-color:#D9DDDC;font-size:86%;padding:1.2%;margin-left:1%"><?php echo  $resultGroup['Students_Messages'] ?></h7>
                <br/><br/><h7 style="float:left;font-size:65%"><?php echo  $resultGroup['ChattingTime'] ?></h7><br/>
                <?php
              }
          }
        }
    }
  }
  //End Display All my chattings
}
?>
<?php
if(isset($_POST['displayPatner']))
{
//Display All patner that you wants to chatting
  $conn = mysqli_connect("localhost","root","","scholardiscussiondata");
  $query = "select * from scholardetails where LevelOfEducation = '$Level' and EmailAddressOrPhoneNumber != '$EmailOrPhone'";
  $data = mysqli_query($conn, $query);
  $Total = mysqli_num_rows($data);
  if ($Total!=0)
  {
  while ($resulti = mysqli_fetch_assoc($data))
  {
  $Gender = $resulti['Gender'];
  $ToS =  $resulti['EmailAddressOrPhoneNumber'];
  ?>
  <div class="StyleMe">
   <img class="StyleFriend" src="<?php
   if($resulti['ProfilePhoto']=='')
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
     echo $resulti['ProfilePhoto'];
   }
   ?>
   "style="color:lightgray;border-top-left-radius: 4px;border-top-right-radius: 4px;width:100%;border-top-width:0;height:86%;margin-top:-1%"/><br/>
    <form  method="post" action="#" enctype="multipart/form-data">
            <input name="PatnerName" value="<?php echo $resulti['FirstName'] ?>" style="display: none"/>
            <input name="LastName" value="<?php echo $resulti['LastName'] ?>" style="display: none"/>
            <input name="PatnerEmail" value="<?php echo $resulti['EmailAddressOrPhoneNumber'] ?>" style="display: none"/>
            <input name="PProfilePhoto" value="<?php echo $resulti['ProfilePhoto'] ?>" style="display: none"/>
            <button name="AddChatting" type="submit"  style="float:right;background-color:transparent;border-width:0;outline: none"><i title="Add <?php echo $resulti['FirstName']?> To My chatting History" class="fab fa-weixin" style="cursor:pointer;color:navy;float:right;margin-right:4%;font-size:160%"></i></button>
    </form>
     <h8 class="text-primary" style="float:left;margin-left:4%;font-size:94%;margin-top:-12%;font-family: 'Arial Narrow';font-weight: bold"><?php echo $resulti['FirstName'];?></h8><br/>
    <?php
      if($resulti['Online']=='1')
      {
        ?><h6 title="active now" class="thumbnail" style="height:6%;width: 5%;float:left;margin-top:-11%;border-radius:100px;background-color:#50C878;margin-left:4%"></h6><?php
      }
      else
      {

      }
    ?>
   <br/>
  </div>
  <?php
  }
}
}
//Display All patner that you wants to chatting
?>
<?php
 // Open Chatting Panel
 if(isset($_POST['OpenChattingPanel']))
 {
   $query = "select * from chatting_connector where Connection = '1' and (Student1 like '$EmailOrPhone' or Student2 = '$EmailOrPhone')";
   $data = mysqli_query($conn, $query);
   $Total = mysqli_num_rows($data);
   if ($Total!=0)
   {
     while ($resultTheID = mysqli_fetch_assoc($data))
     {
        $ChattingID = $resultTheID['Chatting_ID'];
        $query = "select * from studentchatting";
        $data = mysqli_query($conn, $query);
        $Total = mysqli_num_rows($data);
        if ($Total!=0)
        {
        while ($resultChating = mysqli_fetch_assoc($data))
        {
        if($resultChating['Chatting_ID'] == $ChattingID)
        {
        ?><div id="ChattingArea"  style="border-radius:25px ;width:340px;height:67%;margin-left:15.6%;margin-top:0.3%;border-style:solid;border-width:thin;border-color:black;padding-bottom:-5%;border-top-left-radius:10px;border-top-right-radius:8px">
        <div id="HeaderPicture" style="width:100%;height:18%;background-color:#0F52BA;padding-left:2%;border-top-right-radius:10px;border-top-left-radius:10px;padding-right:2%;padding-bottom:3%;background-image:url('Photos/IMG_1078.png')">
         <br/>
         <div class="thumbnail" style="padding:1%;padding-bottom:6%;margin-top:-4%;border-radius:40px;border-style:solid;border-width:thin;border-color:black">
           <i onclick="DeleteThisChatting()" data-toggle = "tooltip" title="Clear Chatting for Two side<?php ?>" class="fa fa-trash" style="float:left;margin-left:1%;margin-top:0.4%;font-size:100%;color:black;cursor:pointer"></i>
           <img onclick="ClosePanel()" data-toggle="tooltip" title="Close Chatting" src="Photos/cancel.png"  style="float:right;margin-right:1%;margin-top:0.8%;height:15%;font-weight:bold;cursor:pointer">
           <i data-toggle = "tooltip" title="Start video Call" class="fas fa-video" style="float:right;margin-right:3%;font-size:90%;margin-top:0.5%;cursor:pointer;color:black"></i>
           <i data-toggle="tooltip" title="Start Voice Call" class="glyphicon glyphicon-earphone"  style="float:right;margin-right:3%;margin-top:0.5%;font-size:90%;cursor:pointer;color:black"></i>
         </div>
         </center>
        <div style="padding:5%;margin-top:-1%;border-radius:40px">
        <?php
        $query = "select * from studentchatting where Chatting_ID = '$ChattingID'";
        $data = mysqli_query($conn, $query);
        $Total = mysqli_num_rows($data);
        if ($Total!=0)
        {
          while ($resultGroup = mysqli_fetch_assoc($data))
          {
            if($resultGroup['Student1'] !=  $EmailOrPhone  and $resultGroup['Student2'] =  $EmailOrPhone)
            {
              $ToID = $resultGroup['Student1'];
              if($ToID != '')
              {
                $query = "select * from scholardetails where EmailAddressOrPhoneNumber like '$ToID'";
                $data = mysqli_query($conn, $query);
                $Total = mysqli_num_rows($data);
                if ($Total!=0)
                {
                  while ($resultPhoto = mysqli_fetch_assoc($data))
                  {
                    if($resultPhoto['Online'] == 1)
                    {
                      ?><h7 id="CheckConnection"></h7><?php
                    }
                    ?>
                    <img class="zoomPicture" title="<?php echo $resultPhoto['FirstName']?> <?php echo $resultPhoto['LastName']?>" src="<?php
                    if($resultPhoto['ProfilePhoto']=='')
                    {
                      if($resultPhoto['Gender'] == 'Male')
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
                      echo $resultPhoto['ProfilePhoto'];
                    }
                     ?>"
                      style="float: left;height: 53%;width:12.6%;border-style: solid;border-width: 2px;border-color:#008DFE;border-radius:100px;margin-top:-9%;margin-left:-4%"/>
                     <h7 id="ShowTypingAlert" style="margin-left:2%;font-size:70%;font-style:oblique"></h7>
                     <?php
                  }
                }
              }
              else
              {
                ?>
                  <img src="Photos/Misc-User-icon.png" class="zoomPicture" style="float: left;height: 45%;width:9%;border-style: solid;border-width: 2px;border-color:#008DFE;border-radius:100px;margin-top:-9%;margin-left:-4%"/>
                <?php
              }
            }
            else
            {
              $ToID = $resultGroup['Student2'];
              if($ToID != '')
              {
                $query = "select * from scholardetails where EmailAddressOrPhoneNumber like '$ToID'";
                $data = mysqli_query($conn, $query);
                $Total = mysqli_num_rows($data);
                if ($Total!=0)
                {
                  while ($resultPhoto = mysqli_fetch_assoc($data))
                  {
                    if($resultPhoto['Online'] == 1)
                    {
                      ?><h7 id="CheckConnection"></h7><?php
                    }
                    ?>
                    <img class="zoomPicture" title="<?php echo $resultPhoto['FirstName']?> <?php echo $resultPhoto['LastName']?>" src="<?php
                    if($resultPhoto['ProfilePhoto']=='')
                    {
                      if($resultPhoto['Gender'] == 'Male')
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
                      echo $resultPhoto['ProfilePhoto'];
                    }
                     ?>"
                      style="float: left;height: 53%;width:12.6%;border-style: solid;border-width: 2px;border-color:#008DFE;border-radius:100px;margin-top:-9%;margin-left:-4%"/>
                     <h7 id="ShowTypingAlert" style="margin-left:2%;font-size:70%;font-style:oblique"></h7>
                     <?php
                  }
                }
              }
              else
              {
                ?>
                  <img src="Photos/Misc-User-icon.png" class="zoomPicture" style="float: left;height: 45%;width:9%;border-style: solid;border-width: 2px;border-color:#008DFE;border-radius:100px;margin-top:-9%;margin-left:-4%"/>
                <?php
              }
            }

          }
        }
         ?>

          <img class="zoomPicture" title="Me" src="<?php
          if($Photo == '')
          {
            if($Gendary == 'Male')
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
           ?>" style="float: right;height: 53%;width:12.6%;border-style: solid;border-width: 2px;border-color:#008DFE;border-radius:100px;margin-top:-9%;margin-right:-4%"/>

         </div>

        </div>
        <div id="Body" style="width:100%;height:72%;background-color:white;border-bottom-style: solid;border-bottom-width: thin;border-bottom-color: black;border-top-style: solid;border-top-width: thin;border-top-color: black;overflow-y: auto;padding:2%">

        </div>
        <input name="MMInsert" id="MMInsert" value="<?php echo $GroupMId?>" style="display: none"/>
        <input name="picture" id="Mypicture" value="
        <?php
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
        ?>" style="display: none"/>
        <input name="GMname" id="GMname" value="<?php echo $FirstName?>" style="display: none"/>
        <div id="WrittingArea" class="" style="width:100%;height:10%;background-color:#0F52BA;padding:0.2%;border-bottom-right-radius:22px;padding-left: 0.5%;padding-right: 0.5%;border-bottom-left-radius:22px;margin-Top:0">
        <center><input class="TextInput" onclick="ClickBoxToshow()" name="Mytext" autocomplete="off" id="TextInput" type="text" placeholder="Text Me..." style="outline:none;text-align: left;width:100%;padding-left:10%;padding-right:12%;float: left;;height:98%;border-radius:50px;border-style:solid;border-width:0.5%;"/>
        <button data-toggle='tooltip' title="Send Text" type="submit" id="ShowSend" style="border-width:0;background-color:transparent;cursor:pointer;color:black;float: right;outline: none;margin-right:4%;margin-top:-9%;display: none;padding:0.3%;border-radius:5px"><i class="fa fa-send" style="cursor:pointer;color:#0F52BA;font-size:155%;float: right;margin-right:4%;margin-top:-9%;padding:0.3%;border-radius:5px"></i></button></center>
        </div>
        </div>
        <?php
        }
      }
    }
   }
  }
}
 //end Open Chatting Panel
?>
<?php
//Loading Chatting HISTORY
  if(isset($_POST['loadingChattingHistory']))
  {
    include("db.php");
    $query = "select * from chatting_connector";
    $data = mysqli_query($conn, $query);
    $Total = mysqli_num_rows($data);
    if ($Total!=0)
    {
      while ($ChattingHistory = mysqli_fetch_assoc($data))
      {
        if($ChattingHistory['Student1'] == $EmailOrPhone)
        {
            ?>
            <form method="post" action="#" enctype="multipart/form-data">
              <Input name="StudentID" Type="text" value="<?php  echo $ChattingHistory['Student2'] ?>" style="display: none">
              <Input name="StudentPicture" Type="text" value="<?php  echo $ChattingHistory['ProfilePhoto'] ?>" style="display: none">
              <Input name="StudentFirstName" Type="text" value="<?php  echo $ChattingHistory['FirstName'] ?>" style="display: none">
              <Input name="Chatting_ID" Type="text" value="<?php  echo $ChattingHistory['Chatting_ID'] ?>" style="display: none">
              <button type="submit" name="StartChatting" class="btn btn-secondary" style="width:100%;border-radius:0;margin-top:-8%;outline: none"><img src="<?php
                    if($ChattingHistory['ProfilePhoto'] == '')
                    {
                      ?>Photos/default-profile-img.png<?php
                    }
                    else
                    {
                      echo $ChattingHistory['ProfilePhoto'];
                    }
                   ?>" style="height:25px;width:25px;float:left">
                    <h7 class="text-primary" style="float:left;margin-left:5%;font-size:85%;font-family:'Cambria';margin-top:1%;font-weight:bold"><?php echo $ChattingHistory['FirstName'] ?></h7>
                    <h7 class="text-primary" style="float:left;margin-left:2%;font-size:85%;font-family:'Cambria';margin-top:1%;font-weight:bold"><?php echo $ChattingHistory['LastName'] ?></h7>
              </button>
            </form>
            <?php
        }
        elseif($ChattingHistory['Student2'] == $EmailOrPhone)
        {
          ?>
          <form method="post" action="#" enctype="multipart/form-data">
            <Input name="StudentID" Type="text" value="<?php  echo $ChattingHistory['Student1'] ?>" style="display: none">
            <Input name="StudentPicture" Type="text" value="<?php  echo $ChattingHistory['ProfilePhoto2'] ?>" style="display: none">
            <Input name="StudentFirstName" Type="text" value="<?php  echo $ChattingHistory['ConnectorFirstName'] ?>" style="display: none">
            <Input name="Chatting_ID" Type="text" value="<?php  echo $ChattingHistory['Chatting_ID'] ?>" style="display: none">
            <button type="submit" name="StartChatting" class="btn btn-secondary" style="width:100%;border-radius:0;margin-top:-8%;outline: none"><img src="<?php
                  if($ChattingHistory['ProfilePhoto'] == '')
                  {
                    ?>Photos/default-profile-img.png<?php
                  }
                  else
                  {
                    echo $ChattingHistory['ProfilePhoto2'];
                  }
                 ?>" style="height:25px;width:25px;float:left">
                  <h7 class="text-primary" style="float:left;margin-left:5%;font-size:85%;font-family:'Cambria';margin-top:1%;font-weight:bold"><?php echo $ChattingHistory['ConnectorFirstName'] ?></h7>
                  <h7 class="text-primary" style="float:left;margin-left:2%;font-size:85%;font-family:'Cambria';margin-top:1%;font-weight:bold"><?php echo $ChattingHistory['ConnectorLastName'] ?></h7>
            </button>
          </form>
          <?php
        }

      }
    }
  }

//end Of Loaing HISTORY
?>
 <script>
 $(document).ready(function(){
   $('[data-toggle="tooltip"]').tooltip();
 });
    function ClosePanel()
    {
      var ChattingArea = document.getElementById('ChattingArea');
      ChattingArea.style.display = 'none';
    }
 </script>
