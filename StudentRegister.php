<html>
 <header>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="Registration_Panel.php">
   <link rel="stylesheet" type="text/css" href="RegisterStyleAndLoginStyles.css">
 </header>
<body>
  <?php if(isset($_POST["InsertMyDetail"]))
  {
  $conn = mysqli_connect('localhost','root','','scholardiscussiondata');
  $MyEmail  = $_POST['MyEmail'];
  $MyFname  = $_POST['MyFname'];
  $MyLname  = $_POST['MyLname'];
  $Gender  = $_POST['Gender'];
  $Country  = $_POST['Country'];
  $MySchool  = $_POST['MySchool'];
  $MyLeducation  = $_POST['MyLeducation'];
  $Password = $_POST['Password'];
  $ConfirmPassword = $_POST['ConfirmPassword'];
  if(!$conn)
     {
       die('server not connected');
     }
  else
    if($Password == $ConfirmPassword)
    {
          $query = "insert into scholardetails(EmailAddressOrPhoneNumber,FirstName,LastName,Gender,Country,CollegeUniversitySchool,LevelOfEducation) values ('$MyEmail','$MyFname','$MyLname','$Gender','$Country','$MySchool','$MyLeducation')";
          $query1 = "insert into scholaraccount(EmailAddressOrPhoneNumber,Password) values ('$MyEmail','$Password')";
          mysqli_query($conn, $query);
          mysqli_query($conn, $query1);
          mysqli_close($conn);
          ?>
         <center>
           <div class="card" style="border-radius: 5px;padding: 20px;width: 400px;margin-top: 180px;box-shadow: 0px 0.5px 2px 1px rgba(0, 0, 0, 0.2)">
              <img src="Photos/IMG_0900.png">
              <h3 style="font-family: 'Agency FB'">Congratulation
              <?php echo "$MyFname"; ?>
              for registration</h3>
              <br/>
              <a href="Login.php"><button type="button" class="btn btn-primary" style="width: 95%">Login</button><a>
           </div>
         </center>
        <?php
   }
   else
   {
     ?><center><br/><br/><h7 class="alert-danger" style="padding:0.6%;border-radius:15px"><?php echo 'password does not match'; ?></h7></center><?php
   }
  }
  ?>
</body>
</html>
