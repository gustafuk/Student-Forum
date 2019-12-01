<?php
include 'Session.php';
$EmailOrPhone = $_SESSION['EmailAddressOrPhoneNumber'];
?>
<?php
include("db.php");
$query = "select * from scholardetails where EmailAddressOrPhoneNumber like '$EmailOrPhone'";
$data = mysqli_query($conn, $query);
$Total = mysqli_num_rows($data);
if ($Total!=0)
{
while ($resultw = mysqli_fetch_assoc($data))
{
$FirstName = $resultw['FirstName'];
$LastName = $resultw['LastName'];
$Level = $resultw['LevelOfEducation'];
$Photo = $resultw['ProfilePhoto'];
$CurrentLocation = $resultw['CurrentLocation'];
$Currentcity = $resultw['CurrentCity'];
$Country = $resultw['Country'];
$DateOfBirth = $resultw['DOB'];
$Gender = $resultw['Gender'];
}
}
?>
<?php if(isset($_POST['UploadProfile']))
{
$file_tmp=$_FILES['Picture']["tmp_name"];
$file_name=$_FILES['Picture']["name"];
$file_type=$_FILES['Picture']["type"];
$path = basename($_FILES['Picture']['name']);
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
$query = "update scholardetails set ProfilePhoto = '$path' where EmailAddressOrPhoneNumber like '$EmailOrPhone'";
$query1 = "update scholaruploadingquestions set ProfilePhoto = '$path' where EmailAddressOrPhoneNumber like '$EmailOrPhone'";
$query2 = "update groups set SenderImage = '$path' where GroupMembers like '$EmailOrPhone'";
mysqli_query($conn, $query);
mysqli_query($conn, $query1);
mysqli_query($conn, $query2);
mysqli_close($conn);
}

}
}
?>
<html>
<header>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-latest.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<link rel="stylesheet" type="text/css" href="RegisterStyleAndLoginStyles.css">
<link rel="stylesheet" type="text/css" href="HomeStyles.css">
<script src="MyJavaScript.js"></script>
</header>
<nav class="nav navbar-fixed-top  NavBarStyle" style="">
</nav>
<body style="background-color:#0F52BA">
<nav id="MySideBar" class="nav navbar-left navbar-fixed-top SidebarStyle">
<div style="width: 100%;height:8%;background-color:#0F52BA;border-bottom-style: solid;border-bottom-width: thin;border-bottom-color: black;">
<img src="Photos/IMG_0796.png" style="height: 96%"/>
</div>
<br/>
<a>
<div id="PictureRound">

</div></a>
<h4 class="card-tittle" style="float:left;margin-Left:2%;margin-top:10%;font-size:15px;font-family:'Cambria';font-weight:bold"><?php echo $FirstName ?></h4><h4 style="font-family: 'Cambria';float: left;margin-left:3%;font-size: 15px;margin-Top:10%;font-weight:bold"><?php echo $LastName ?></h4><br/><br/>
<br/><br/>
<li style="background-color: lightblue">
  <a href="Home.php" style="cursor: pointer;color: navy;border-width:1px;background-color: lightblue;color: navy;border-bottom-style:solid;margin-top:-10%;font-size:95%;font-family:'arial Narrow'"><i class="glyphicon glyphicon-home" style="cursor: pointer ;color:navy;height: 24px;font-size: 17px;float:left"></i><h8 style="margin-left: 4%;">Home Panel</h8></a>
  <a  style="cursor: pointer;color: white;border-width:1px;background-color: navy;border-bottom-style:solid;font-size:95%;font-family:'arial Narrow'"><i class="fas fa-user-graduate" style="cursor: pointer ;color: white;height: 24px;font-size: 17px;float:left"></i><h8 style="margin-left: 4%">Profile</h8></a>
  <a href="MyGroup.php" style="cursor: pointer;color: navy;border-width:1px;border-bottom-style:solid;font-size:95%;font-family:'arial Narrow'"><i class="fas fa-user-friends" style="cursor: pointer ;color: navy;height: 24px;font-size: 17px;float:left"></i><h8 style="margin-left: 4%">My Groups</h8></a>
  <a  style="cursor: pointer;color: navy;border-width:1px;border-bottom-style:solid;font-size:95%;font-family:'arial Narrow'"><i class="fa fa-group" style="cursor: pointer ;color: navy;height: 24px;font-size: 17px;float:left"></i><h8 style="margin-left: 4%">Other Groups</h8></a>
  <a href="ChattingRoom.php" style="cursor: pointer;color: navy;border-width:1px;border-bottom-style:solid;font-size:95%;font-family:'arial Narrow'"><i class="glyphicon glyphicon-comment" style="cursor: pointer ;color: navy;height: 24px;font-size: 17px;float:left"></i><h8 style="margin-left: 4%">Chatting Room</h8></a>
</li>
<center><h4 style="font-family: underline;font-family:'Times New Roman';font-size:89%" class="text">Your profile complete result</h4></center>
<?php
if($CurrentLocation == "" || $Currentcity == "" || $DateOfBirth == "")
{
?>
<div data-toggle="tooltip" title="Complete Your Profile" class="progress" style="padding-left:0%;padding-right:0%;width:95%;margin-left:2%;height:2%">
 <div class="progress-bar btn-warning" style="width:50%;background-color:#008DFE;border-radius:5px"><h7 style="font-size:70%;font-weight:bold;float:right;margin-top:-4%;margin-right:5%">50%</h7></div>
</div>
<h7 style="margin-left:26%;font-size:70%;color:red;font-weight:bold">Complete your profile</h7>
<?php
}
else
{
?>
<div data-toggle="tooltip" title="Congratulation Your Profile is Complete" class="progress" style="padding-left:0%;padding-right:0%;width:95%;margin-left:2%;height:2%">
<div class="progress-bar" style="width:100%;background-color:#008DFE;border-radius:5px"><h7 style="font-size:70%;font-weight:bold;float:right;margin-top:-2%;margin-right:46%">100%</h7></div>
</div><?php
}
?>
<br/>
</nav>
<div class="" style="width:70%;height: 60%;margin-left:17%;margin-top: 3.5%;border-radius:5px;padding-bottom:3.1%; border-radius: 5px; display:  inline-block;background-color: white;">
<div id="ProfilePicture" class="">

</div>
<form method="post" action="#" enctype="multipart/form-data">
<div class="div file btn btn-lg btn-primary" id="ButtonPhoto" style="background-image:url('Photos/Photo-Booth-icon.PNG');padding:5%;margin-left: 2%;background-size: 95px 95px;background-attachment: cover;border-radius:55px;background-repeat: no-repeat;border-style:solid;border-width: 5px;border-color:white">
<input title="Choose Profile Picture" class="input" type="file" name="Picture" style="cursor: pointer"/>
</div>
<br/>
<div class="btn-group" style="margin-left:1%;margin-right:1%;width:30%">
  <button name="UploadProfile" class="btn-sm btn btn-primary" type="submit" style="width:50%">Save</button>
  <button  class="btn-sm btn btn-default" type="submit" style="width:50%">Cancel</button>
</div>
</form>
</div>
<div  style="width:70%;height: 49%;margin-left:17%;border-radius:5px;margin-top:1%;padding-bottom:2%;background-color:white">
<div class="thumbnail" style="float:left;width:48%;height:100%;margin-left:1%;margin-top:1%;border-radius:5px">
<i class="fas fa-user-edit" style="font-size:200%;color:#008DFE;margin-left:1%"></i>
<h5 style="font-weight: bold;font-family:'Times New Roman';color:darkblue">Personal Privacy</h5><hr style="margin-top:-1%"/>
<h8 style="margin-left:1%;font-size:70%;margin-top:-2%">FirstName: </h8><h8 class="text-primary" style="font-size:80%;font-weight:bold"><?php echo $FirstName ?></h8>
<h8 style="margin-left:11%;font-size:70%;margin-top:-2%">LastName: </h8><h8 class="text-primary" style="font-size:80%;font-weight:bold"><?php echo $LastName ?></h8><br/>
<hr/>
<img src="Photos/Actions-view-calendar-day-icon.PNG" style="width:6%;float:left;margin-left:2%"/><a onclick="ShowUpdateBirthday()" style="float:right;margin-right:1%;cursor:pointer">Edit</a>
<h5 style="margin-top:5%;margin-left: 10%;font-weight: bold;font-family:'Times New Roman';color:darkblue">Birthday</h5><hr style="margin-top:-1%"/>
<h7 style="float:left;color:orange;font-size: 80%;margin-left:2%">HappyBirthDay: </h7><br/>
<i class="fa fa-birthday-cake" style="float:left;margin-left:2%"></i><h7 id="Mdob" style="font-size:60%;margin-left:1%;margin-top:6%"></h7><br/>
<div id="Birthday" style="display: none">
<input  required id="name" name="name" type="date" placeholder="date of birth"  style="margin-left:1.8%"/>
<button type="submit" id="UpdateDOB" class="btn-xs btn btn-primary" style="display:block;margin-left:2%;float: right;height:9%;width:10%;margin-right:50%">save</button>
</div>
<div>
</div>
</div>
<div  class="thumbnail" style="float:right;width:48%;height:100%;margin-right:1%;margin-top:1%;border-radius:5px" >
<i class="fab fa-expeditedssl" style="font-size:200%;color:#008DFE;margin-left:1%"></i>
<h5 style="font-weight: bold;font-family:'Times New Roman';color:darkblue">Account Security</h5><hr style="margin-top:-1%"/>
<h5 style="margin-top:5%;font-family:'arial';color:gray;font-size:70%">Take actions to make your account more secure</h5>
<div class="nav">
<li  style="cursor: pointer;border-bottom-style: solid;border-bottom-width: 0.1px;border-bottom-color:lightgray"><a><i class="fa fa-user-o" style="float:left"></i><h8 style="margin-left:2%;font-size:70%">Update your personal information</h8></a></li>
<li onclick="ShowUpdate()" style="cursor: pointer;border-bottom-style: solid;border-bottom-width: 0.1px;border-bottom-color:lightgray"><a><i class="fa fa-key" style="float:left"></i><h8 style="margin-left:2%;font-size:70%">Change your password</h8></a></li><br/>
<div id="AccountUpdate" class="thumbnail" style="display:block;width:100%;height:1%;margin-top:-3%">
   <div id="Internals" style="display: none"><h7 style="font-size:70%;font-family:'Cambria';margin-left:2%;color:red">Warning: makesure your password contain special character, numbers and letter</h7><br/><hr style="margin-top:0.5%"/>
   <input id="OldPassword" type="password" class="password" placeholder="Old password" style="outline: none;border-width:0;border-bottom-style: solid;border-bottom-color: lightgray;border-bottom-width:thin;border-width:0;border-bottom-style:solid;border-bottom-width:thin;border-bottom-color:lightgray;padding-left:2%;margin-left:2%">
   <input id="NewPassword" type="password" class="text" placeholder="New password" style="outline: none;border-width:0;border-bottom-style: solid;border-bottom-color: lightgray;border-bottom-width:thin;border-width:0;border-bottom-style:solid;border-bottom-width:thin;border-bottom-color:lightgray;padding-left:2%;margin-left:12%"><br>
   <button id="ClickToUpdate" class="btn-xs btn btn-primary" style="margin-right:1.5%;margin-top:2%;float:right">save</button>
   <button onclick="CloseUpdateAccount()" class="btn-xs btn btn-default" style="margin-right:2%;margin-top:2%;float:right">close</button>
   </div>
</div>
<h7 id="AlertAccountUpdate"></h7>
</div>
</div>
</div>
<div  style="width:70%;height: 45%;margin-left:17%;border-radius:5px;margin-top:1%;padding-bottom:2%;background-color:white">
<div class="thumbnail" style="float:left;width:48%;height:280px;margin-left:1%;margin-top:1%;border-radius:10px" >
<i class="fa fa-map-marker"style="float:left;font-size:200%;color:#008DFE;margin-left:1%"></i><a onclick="ShowLocation()" title="edit " style="cursor:pointer;margin-right:2%;margin-top:2%;float:right">Edit</a><br/>
<h5 style="margin-top:5%;font-weight: bold;font-family:'Times New Roman';color:darkblue">Location</h5><hr style="margin-top:-1%"/>
<i class="fa fa-map-pin" style="color:red;margin-Left:1%;font-size:130%;margin-top:2%"></i><h8 style="margin-left:1%;font-size:70%;margin-top:-2%">Current Location:
 <?php
 if($CurrentLocation == '')
 {
   echo '?';
 }
 else
 {
   echo $CurrentLocation;
 }
  ?></h8><br/>
<i class="fa fa-map-marker" style="color:orange;margin-Left:1%;font-size:130%;margin-top:2%"></i><h8 style="margin-left:1%;font-size:70%;margin-top:-2%">Current city:
<?php
if($Currentcity == '')
{
  echo '?';
}
else
{
  echo $Currentcity;
}
 ?></h8><br/>
<i class="fa fa-flag" style="margin-Left:1%;font-size:120%;margin-top:2%"></i><h8 style="margin-left:1%;font-size:70%;margin-top:-2%">Country: <?php echo $Country ?></h8><br/>
<div id="EditLocation" class="thumbnail" style="width:100%;height:1%;background-color:;float:right;margin-Top:2.5%">
<form method="post" enctype="multipart/form-data"><div id="InnerEditLocation" style="display: none">
  <label style="width:100%;height:17px;background-color:lightgray;padding:1%;padding-bottom:5%">LOCATION PANEL</label>
  <input name="CL" required title="Current location" type="text" placeholder="Current location" style="outline: none;border-width:0;border-bottom-style: solid;border-bottom-color: lightgray;border-bottom-width:thin;padding-left:1%;width:30%"/>
  <input name="CC" required title="current city" placeholder="Current city" style="outline: none;border-width:0;border-bottom-style: solid;border-bottom-color: lightgray;border-bottom-width:thin;margin-left:1%;padding-left:1%;width:33%"/>
  <select title="country" name="C" id="country" style="outline: none;border-width:0;border-bottom-style: solid;border-bottom-color: lightgray;border-bottom-width:thin;cursor: pointer;padding-left:1%;width:32%;height: 24%">
     <option  style=" color: #ccc">Country</option>
     <option>Afghanistan</option><option>Albania</option><option>Algeria</option><option>Andorra</option><option>Angola</option><option>Antigua and Barbuda</option><option>Argentina</option><option>Armenia</option><option>Australia</option><option>Austria</option><option>Azerbaijan</option><option>Bahamas</option><option>Bahrain</option><option>Bangladesh</option><option>Barbados</option><option>Belarus</option><option>Belgium</option><option>Belize</option><option>Benin</option><option>Bhutan</option><option>Bolivia</option><option>Bosnia and Herzegovina</option><option>Botswana</option><option>Brazil</option><option>Brunei</option><option>Bulgaria</option><option>Burkina Faso</option><option>Burundi</option><option>Côte d'lvoire</option><option>Cabo Verde</option><option>Cambodia</option><option>Cameroon</option><option>Canada</option><option>Central African Republic</option><option>Chad</option><option>Chile</option><option>China</option><option>Colombia</option><option>Comoros</option><option>Congo(Congo-Brazzaville)</option><option>Costa Rica</option><option>Croatia</option><option>Cuba</option><option>Cyprus</option><option>Czechia</option><option>Demeocratic Republic of the Congo</option><option>Denmark</option><option>Djibouti</option><option>Dominica</option><option>Dominican Republic</option><option>Ecuador</option><option>Egypt</option><option>El Salvador</option><option>Equatorial Guinea</option><option>Eritrea</option><option>Estonia</option><option>Ethiopia</option><option>Fiji</option><option>Finland</option><option>France</option><option>Gabon</option><option>Gambia</option><option>Georgia</option><option>Germany</option><option>Ghana</option><option>Greece</option><option>Grenada</option><option>Guatemala</option><option>Guinea</option><option>Guinea-Bissau</option><option>Guyana</option><option>Haiti</option><option>Holy See</option><option>Honduras</option><option>Hungary</option><option>Iceland</option><option>India</option><option>Indonesia</option><option>Iran</option><option>Iraq</option><option>Ireland</option><option>Israel</option><option>Italy</option><option>Jamaica</option><option>Japan</option><option>Jordan</option><option>Kazakhstan</option><option>Kenya</option><option><option>Kiribati</option><option>Kuwait</option><option>Kyrgyzstan</option><option>Laos</option><option>Latvia</option><option>Lebanon</option><option>Lesotho</option><option>liberia</option><option>Libya</option><option>Liechtenstein</option><option>Liechtenstein</option><option>Lithuania</option><option>Luxembourg</option><option>Madagascar</option><option>Malawi</option><option>Malaysia</option><option>Maldives</option><option>Mali</option><option>Malta</option><option>Marshall Islands</option><option>Mauritania</option><option>Mauritius</option><option>Mexico</option><option>Micronesia</option><option>Moldova</option><option>Monaco</option><option>Mongolia</option><option>Montenegro</option><option>Morocco</option><option>Mozambique</option><option>Myanmar(formerly Burma)</option><option>Namibia</option><option>Nauru</option><option>Nepal</option><option>Netherlands</option><option>New Zealand</option><option>Nicaragua</option><option>Niger</option><option>Nigeria</option><option>North Korea</option><option>North Macedonia</option><option>Norway</option><option>Oman</option><option>Pakistan</option><option>Palau</option><option>Palestine State</option><option>Panama</option><option>Papua New Guinea</option><option>Paraguay</option><option>Peru</option><option>Philippines</option><option>Poland</option><option>Portugal</option><option>Qatar</option><option>Romania</option><option>Russia</option><option>Rwanda</option><option>Saint Kitts and Nevis</option><option>Saint Lucia</option><option>Saint Vicent and the Grenadines</option><option>Samoa</option><option>San Marino</option><option>Sao Tume and Principe</option><option>Saudi Arabia</option><option>Senegal</option><option>Serbia</option><option>Seychelles</option><option>Sierra Leone</option><option>Singapore</option><option>Slovakia</option><option>Slovenia</option><option>Solomon Islands</option><option>Somalia</option><option>South Africa</option><option>South Korea</option><option>South Sudan</option><option>Spain</option><option>Sri Lanka</option><option>Sudan</option><option>Suriname</option><option>Swaziland</option><option>Sweden</option><option>Switzerland</option><option>Syria</option><option>Tajikistan</option><option>Tanzania</option><option>Timor-Leste</option><option>Togo</option><option>Tonga</option><option>Trinidad and Tobago</option><option>Tunisia</option><option>Turkey</option><option>Turkmenistan</option><option>Tuvalu</option><option>Turkey</option><option>Turkmenistan</option><option>Tuvalu</option><option>Uganda</option><option>Ukraine</option><option>United Arab Emirates</option><option>United Kingdom</option><option>United States of America</option><option>Uruguay</option><option>Uzbekistan</option><option>Vanuatu</option><option>Venezuela</option><option>Vietnam</option><option>Zambia</option><option>Zimbabwe</option>
  </select>
  <div class="btn-group" style="margin-top:1.5%">
    <button name="EditLoca" type="submit" title="Save" class="btn-xs btn btn-primary" style="height:24%;margin-top:2%;">save</button>
    <button onclick="closeLocation()" title="close" type="button" class="btn-xs btn btn-secondary" style="height:24%;margin-top:2%;">close</button>
  </div>
</div>
</form>
</div>
</div>
<div  class="thumbnail" style="float:right;width:48%;height:280px;margin-right:1%;margin-top:1%;border-radius:5px" >
<i class="fa fa-graduation-cap" style="float:left;font-size:200%;color:#008DFE;margin-left:1%"></i>
<?php if($Level == 'Grade_12/form Five' || $Level == 'Grade_13/form Six' || $Level == 'University Education')
{
    ?><a onclick="ShowEditEducation()" title="edit" style="margin-right:2%;margin-top:2%;float:right;cursor:pointer">Edit</a><?php
}
else
{

}
?>
<br/>
<h5 style="margin-top:5%;font-weight: bold;font-family:'Times New Roman';color:darkblue">Education</h5><hr style="margin-top:-1%"/>
<i class="fa fa-frown-o" style="margin-Left:1%;font-size:110%;margin-top:2%"></i><h8 style="margin-left:1%;font-size:70%;margin-top:-2%">Ordinal Level: <?php
if($Level == 'Grade_8/form One' || $Level == 'Grade_9/form Two' || $Level == 'Grade_10/form Three' || $Level == 'Grade_11/form Four')
{
?><img src="Photos/tick-icon.png" style="height:4%"><?php
}
else
{
?><i class="fa fa-close" style="color:red"></i><?php
}
?></h8><br/>
<i class="fa fa-bed" style="margin-Left:1%;font-size:100%;margin-top:2%"></i><h8 style="margin-left:1%;font-size:70%">Advanced Level:
<?php if($Level == 'Grade_12/form Five' || $Level == 'Grade_12/form Six')
{
  ?><img src="Photos/tick-icon.png" style="height:4%"><?php
}
else {
  ?><i class="fa fa-close" style="color:red"></i><?php
}
?>
</h8><br/>
<i class="fa fa-graduation-cap" style="margin-Left:1%;font-size:100%;margin-top:2%"></i><h8 style="margin-left:0.2%;font-size:70%">University Level:
<?php if($Level == 'University Education')
  {
    ?><img src="Photos/tick-icon.png" style="height:4%"><?php
  }
  else
  {
    ?><i class="fa fa-close" style="color:red"></i><?php
  }
  ?>
</h8><br/>
<div id="EditEducationEducationLevel" class="thumbnail" style="width:100%;height:1%;float:right;margin-Top:4%">
<form method="post" enctype="multipart/form-data">
  <?php if($Level == 'Grade 12/form Five' || $Level == 'Grade 13/form Six' || $Level == 'University Education')
  {
    ?>
    <div id="InnerEditEducation" style="display: none">
    <label style="width:100%;height:17px;background-color:lightgray;padding:1%;padding-bottom:5%">EDUCATION PANEL</label>
    <select title="Select Your Level" name="NewLevel" id="MyLeducation" style="outline: none;border-width:0;border-bottom-style: solid;border-bottom-color: lightgray;border-bottom-width:thin;padding-left:1%;width:80%;height:24%">
      <?php
        if($Level == 'Grade 12/form Five' || $Level == 'Grade 13/form Six')
        {?>
          <option>PCM</option>
          <option>PCB</option>
          <option>PGM</option>
          <option>CBG</option>
          <option>EGM</option>
          <option>HGL</option>
          <option>HKL</option>
          <option>ECA</option>
          <option>CBA</option>
          <?php
        }
        elseif($Level == 'University Education')
        {?>
          <option>PETROLIUM ENGINEERING</option>
          <option>GAS PROCESSING ENGINEERING</option>
          <option>MINING ENGINEERING</option>
          <option>TELECUMUNICATION ENGINEERING(TE)</option>
          <option>MECHANICAL ENGINEERING</option>
          <option>ELECTRICAL ENGINEERING</option>
          <option>COMPUTER ENGINEERING</option>
          <option>MINERAL PROCESSING ENGINEERING</option>
          <option>HEALTH INFORMATION SYSTEM(HIS)</option>
          <option>BUSSINESS INFORMATION SYSTEM(BIS)</option>
          <option>INFORMATION SYSTEM(IS)</option>
          <option>MULTIMEDIA</option>
          <option>DOCTOR OF MEDICINE</option>
          <option>NURSING</option>
          <option>TEACHER OF MATHEMATICS</option>
          <option>TEACHER OF CHEMISTRY</option>
          <option>TEACHER OF PHYSICS</option>
          <option>TEACHER OF BIOLOGY</option>
          <option>TEACHER OF KISWAHILI</option>
          <option>TEACHER OF HISTORY</option>
          <option>TEACHER OF ACCOUNTANT</option>
          <option>TEACHER OF GEOGRAPHY</option>
          <option>TEACHER OF CIVICS</option>
          <option>TEACHER OF CYCHOLOGY</option>
          <?php
        }
       ?>
    </select><br/>
    <div class="btn-group" style="margin-top:1.5%">
    <button name="EditLevel" type="submit" title="Save" class="btn-xs btn btn-primary" style="height:24%;margin-top:2%;">save</button>
    <button onclick="closeEducation()" title="close" type="button" class="btn-xs btn btn-secondary" style="height:24%;margin-top:2%;">close</button>
    </div>
  </div>
    <?php
  }
  else
  {

  }
  ?>
</form>
</div>
</div>
</div>
<div   style="float:left;width:34%;height:22%;margin-right:1%;margin-left: 17%;margin-top:0.3%;border-radius:5px;background-color:white;padding:1%" >
<i class="fa fa-language" style="margin-Left:1%;font-size:130%;margin-top:2%"></i>
<h5 style="font-weight: bold;font-family:'Times New Roman';color:darkblue">language</h5>
<a style="color:lightgray">English</a>-<a style="cursor:pointer">Kiswahili</a>
</div><br/><br/><br/><br/>
<div data-toggle="tooltip" title="End" class="progress" style="width:15px;height:15px;float: right;margin-right:30%;border-radius:100px;background-color:#0F52BA"></div>
<br/>
<style>
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
.HoverClose:hover
{
color: orangered;
}
#ButtonPhoto:hover
{
  background-color: black;
  transition: 0.8s;
}
</style>

<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
$(document).ready(function()
{
$("#ClickToUpdate").click(function() {
  var OldPassword = $("#OldPassword").val();
  var NewPassword = $("#NewPassword").val();
  var Internals = document.getElementById('Internals');
  var AccountUpdate = document.getElementById('AccountUpdate');
  $.ajax({
      url: "ProfileUpdater.php",
      type: "post",
      async: false,
      data:{
      "AccountUpdater": 1,
      "OldPassword": OldPassword,
      "NewPassword": NewPassword
      },
      success: function(data)
      {
        $("#OldPassword").val('');
        $("#NewPassword").val('');
        Internals.style.display = 'none';
        AccountUpdate.style.height = '5%';
        AccountUpdate.style.transition = '0.5s';
        alert('Your password successfull updated');
      }
  });
});
});
function CloseUpdateAccount()
{
  var Internals = document.getElementById('Internals');
  var AccountUpdate = document.getElementById('AccountUpdate');
    Internals.style.display = 'none';
    AccountUpdate.style.height = '1%';
    AccountUpdate.style.transition = '0.5s';
}
</script>
<script>
function ShowUpdate()
{
var AccountUpdate = document.getElementById('AccountUpdate');
var Internals = document.getElementById('Internals');
if(AccountUpdate.style.height == '1%')
{
AccountUpdate.style.height = '35%';
AccountUpdate.style.transition = '0.5s';
Internals.style.display = 'block';
Internals.style.transition = '0.5s';
}
else {
  AccountUpdate.style.height = '1%';
  AccountUpdate.style.transition = '0.5s';
  Internals.style.display = 'none';
  Internals.style.transition = '0.5s';
  }
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
function ShowEditEducation()
{
var EditEducationEducationLevel = document.getElementById('EditEducationEducationLevel');
var InnerEditEducation = document.getElementById('InnerEditEducation');
EditEducationEducationLevel.style.height = '35%';
EditEducationEducationLevel.style.transition ='0.5s';
InnerEditEducation.style.display = 'block';
}
function closeLocation()
{
var EditLocation = document.getElementById('EditLocation');
var InnerEditLocation = document.getElementById('InnerEditLocation');
EditLocation.style.height = '1%';
EditLocation.style.transition ='0.5s';
InnerEditLocation.style.display = 'none';
}
function closeEducation()
{
  var EditEducationEducationLevel = document.getElementById('EditEducationEducationLevel');
  var InnerEditEducation = document.getElementById('InnerEditEducation');
  EditEducationEducationLevel.style.height = '1%';
  EditEducationEducationLevel.style.transition ='0.5s';
  InnerEditEducation.style.display = 'none';
}
function ShowLocation()
{
var EditLocation = document.getElementById('EditLocation');
var InnerEditLocation = document.getElementById('InnerEditLocation');
EditLocation.style.height = '35%';
EditLocation.style.transition ='0.5s';
InnerEditLocation.style.display = 'block';
}
function ShowUpdateBirthday()
{
var Birthday = document.getElementById('Birthday');
Birthday.style.display = 'block';
}
</script>
<script>
$(document).ready(function()
{
  //Auto reflesh
  setInterval(function(){
   LoadProfile();
 }, 50);
 setInterval(function(){
  ShowPictureProfile();
}, 50);
  //auto reflesh end
$("#UpdateDOB").click(function() {
  var name = $("#name").val();
  $.ajax({
      url: "UpdateDOB.php",
      type: "post",
      async: false,
      data:{
      "UPDATINGDOB": 1,
      "name": name
      },
      success: function(data)
      {
        displayDataFromDatabase();
        $("#name").val('');
        HideUpdateBirthday();
      }
  });
});
});
function displayDataFromDatabase(){
  $.ajax({
    url: "UpdateDOB.php",
    type: "POST",
    async: false,
    data:{
      "showDOB": 1
    },
     success: function(data){
        $("#Mdob").html(data);
    }
  })
}
$.ajax({
  url: "UpdateDOB.php",
  type: "POST",
  async: false,
  data:{
    "showDOB": 1
  },
   success: function(data){
      $("#Mdob").html(data);
  }
})
function HideUpdateBirthday()
{
  var Birthday = document.getElementById('Birthday');
  Birthday.style.display = 'none';
}
function LoadProfile(){
  $.ajax({
    url: "ProfileUpdater.php",
    type: "POST",
    async: false,
    data:{
      "LoadProfilePicture": 1
    },
     success: function(data){
        $("#ProfilePicture").html(data);
    }
  })
}
function LoadProfile1(){
  $.ajax({
    url: "ProfileUpdater.php",
    type: "POST",
    async: false,
    data:{
      "LoadProfilePicture": 1
    },
     success: function(data){
        $("#ProfilePicture1").html(data);
    }
  })
}
$.ajax({
  url: "ProfileUpdater.php",
  type: "POST",
  async: false,
  data:{
    "LoadProfilePicture": 1
  },
   success: function(data){
      $("#ProfilePicture").html(data);
  }
})

function ShowPictureProfile()
{
$.ajax({
  url: "ProfileUpdater.php",
  type: "POST",
  async: false,
  data:{
    "ShowTheProfileRound": 1
  },
   success: function(data){
      $("#PictureRound").html(data);
  }
})
}
</script>
<?php if(isset($_POST['EditLoca']))
{
$conn = mysqli_connect('localhost','root','','scholardiscussiondata');
$CL  = $_POST['CL'];
$CC  = $_POST['CC'];
$C  = $_POST['C'];
if(!$conn)
{
die('server not connected');
}
else
{
$query = "update  scholardetails set CurrentLocation = '$CL', CurrentCity = '$CC' , Country = '$C' where EmailAddressOrPhoneNumber like '$EmailOrPhone' ";
mysqli_query($conn, $query);
mysqli_close($conn);
}
}
if(isset($_POST['EditLevel']))
{
$conn = mysqli_connect('localhost','root','','scholardiscussiondata');
$NewLevel  = $_POST['NewLevel'];
if(!$conn)
{
die('server not connected');
}
else
{
$query = "update  scholardetails set LevelOfEducation = '$NewLevel' where EmailAddressOrPhoneNumber like '$EmailOrPhone' ";
mysqli_query($conn, $query);
mysqli_close($conn);
}
}
?>
</body>
</html>
