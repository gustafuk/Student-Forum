<html>
 <header>
 	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="RegisterStyleAndLoginStyles.css">
    <script src="MyJavaScript.js"></script>
 </header>
  <body style="background-color:white;background-image: url('Photos/IMG_0992.jpg');background-attachment: fixed;background-size: cover;background-repeat: no-repeat;background-color:white">
 	  <nav class="nav navbar-fixed-top NavBarStyle">
      <img src="Photos/IMG_0796.png" style="height: 96%"/>
    </nav>
      <form action="LoginReader.php" method="post" enctype="multipart/form-data" >
        <center>
           <div id="StudentDetails" class="card " style="padding:35px;width:370px;height:428px;margin-top:5%;border-radius:5px;border-style:solid;border-width:thin;border-color:lightgray"><br/>
              <img src="Photos/Forum_Header1.png" style="width:80%;margin-top:-6%"><br/>
              <input  required name="Username/Email/MobileNumber"  title="Email  Address" id="MyEmail" type="email Mobile" class="form-control text ClickMe()" placeholder="Email Address" style="padding-top:1%;margin-top:2%"/>
              <input required name="Password" title="password" id="MyFname" type="password" class="form-control" placeholder="Password" style="padding-top:1%;margin-top:2%"/>
              <button type="submit" name="StudentStartLogin" class="btn btn-primary" style="width: 100%;font-weight:bold;margin-top:4%">Log in</button><br/>
              <label style="color:lightgray;font-family:'Times New Roman';font-weight:bold">_________________ OR  ________________</label>
              <a href="ForgetPassword.php" style="cursor: pointer">Forgot password?</a>
              <div><label class="text" style="font-family:'Times New Roman';color:gray">Don't have an account?</label><a href="Registration_Panel.php" style="margin-left:4px;cursor: pointer;font-weight:bold">Sin up</a><br/></div>
           </div>
        </center>
      </form>
  </body>
</html>
