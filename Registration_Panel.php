<html>
 <header>
 	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="RegisterStyleAndLoginStyles.css">
    <link rel="stylesheet" type="text/css" href="StudentRegister.php">
    <script src="MyJavaScripts.js"></script>
 </header>
  <body onload="Loader()" style="background-color:white;background-image: url('Photos/IMG_0992.jpg');background-attachment: fixed;background-size: cover;background-repeat: no-repeat;background-color: black;">
 	  <nav class="nav navbar-fixed-top NavBarStyle" style="padding: 5px" >
       <img src="Photos/IMG_0796.png" style="height: 120%;margin-top:-0.4%;margin-left:-0.4%"/>
    </nav>
    <div id="MyLoader">

    </div>
    <div class="card">
      <center>
      <form method="post" action="StudentRegister.php"  enctype="multipart/form-data" >
           <div id="StudentDetails" class="card PanelRegister" style="padding:35px;width:400px;height:520px">
              <img src="Photos/Forum_Header1.png" style="width:80%;margin-top:-6%"><br/>
              <label style="color:lightgray;font-family:'Agency FB'">Sign up now to learning and share Ideas</label><br/>
              <label style="color:lightgray;font-family:'Agency FB';margin-top:-1%">with Other fellow students from different countries</label><br/>
              <hr style="margin-top:-2%"/><h7 id="AlertMessage" style="font-size:70%;color:red;margin-top:-2%;display:none">Make sure there is no empty space</h7>
              <input  title="Student Email" name="MyEmail" id="MyEmail" type="email" class="form-control" placeholder="Email address"/>
              <input title="Student First Name" name="MyFname" maxlength="20" id="MyFname" type="text" class="form-control" placeholder="First Name" style="margin-top:2%"/>
              <input title="Student Last Name" name="MyLname" id="MyLname" maxlength="20" type="text" class="form-control" placeholder="Last Name" style="margin-top:2%"/>
              <select title="Select Your Gender" name="Gender" id="MyGender" class="form-control" style="cursor: pointer;margin-top:2%">
                <option style="color: lightgray">Gender</option>
                <option>Male</option>
                <option>Female</option>
              </select>
              <select title="Select Country" name="Country" id="country" class="form-control" style="cursor: pointer;margin-top:2%">
                 <option  style=" color: #ccc">Country</option>
                 <option>Afghanistan</option><option>Albania</option><option>Algeria</option><option>Andorra</option><option>Angola</option><option>Antigua and Barbuda</option><option>Argentina</option><option>Armenia</option><option>Australia</option><option>Austria</option><option>Azerbaijan</option><option>Bahamas</option><option>Bahrain</option><option>Bangladesh</option><option>Barbados</option><option>Belarus</option><option>Belgium</option><option>Belize</option><option>Benin</option><option>Bhutan</option><option>Bolivia</option><option>Bosnia and Herzegovina</option><option>Botswana</option><option>Brazil</option><option>Brunei</option><option>Bulgaria</option><option>Burkina Faso</option><option>Burundi</option><option>Côte d'lvoire</option><option>Cabo Verde</option><option>Cambodia</option><option>Cameroon</option><option>Canada</option><option>Central African Republic</option><option>Chad</option><option>Chile</option><option>China</option><option>Colombia</option><option>Comoros</option><option>Congo(Congo-Brazzaville)</option><option>Costa Rica</option><option>Croatia</option><option>Cuba</option><option>Cyprus</option><option>Czechia</option><option>Demeocratic Republic of the Congo</option><option>Denmark</option><option>Djibouti</option><option>Dominica</option><option>Dominican Republic</option><option>Ecuador</option><option>Egypt</option><option>El Salvador</option><option>Equatorial Guinea</option><option>Eritrea</option><option>Estonia</option><option>Ethiopia</option><option>Fiji</option><option>Finland</option><option>France</option><option>Gabon</option><option>Gambia</option><option>Georgia</option><option>Germany</option><option>Ghana</option><option>Greece</option><option>Grenada</option><option>Guatemala</option><option>Guinea</option><option>Guinea-Bissau</option><option>Guyana</option><option>Haiti</option><option>Holy See</option><option>Honduras</option><option>Hungary</option><option>Iceland</option><option>India</option><option>Indonesia</option><option>Iran</option><option>Iraq</option><option>Ireland</option><option>Israel</option><option>Italy</option><option>Jamaica</option><option>Japan</option><option>Jordan</option><option>Kazakhstan</option><option>Kenya</option><option><option>Kiribati</option><option>Kuwait</option><option>Kyrgyzstan</option><option>Laos</option><option>Latvia</option><option>Lebanon</option><option>Lesotho</option><option>liberia</option><option>Libya</option><option>Liechtenstein</option><option>Liechtenstein</option><option>Lithuania</option><option>Luxembourg</option><option>Madagascar</option><option>Malawi</option><option>Malaysia</option><option>Maldives</option><option>Mali</option><option>Malta</option><option>Marshall Islands</option><option>Mauritania</option><option>Mauritius</option><option>Mexico</option><option>Micronesia</option><option>Moldova</option><option>Monaco</option><option>Mongolia</option><option>Montenegro</option><option>Morocco</option><option>Mozambique</option><option>Myanmar(formerly Burma)</option><option>Namibia</option><option>Nauru</option><option>Nepal</option><option>Netherlands</option><option>New Zealand</option><option>Nicaragua</option><option>Niger</option><option>Nigeria</option><option>North Korea</option><option>North Macedonia</option><option>Norway</option><option>Oman</option><option>Pakistan</option><option>Palau</option><option>Palestine State</option><option>Panama</option><option>Papua New Guinea</option><option>Paraguay</option><option>Peru</option><option>Philippines</option><option>Poland</option><option>Portugal</option><option>Qatar</option><option>Romania</option><option>Russia</option><option>Rwanda</option><option>Saint Kitts and Nevis</option><option>Saint Lucia</option><option>Saint Vicent and the Grenadines</option><option>Samoa</option><option>San Marino</option><option>Sao Tume and Principe</option><option>Saudi Arabia</option><option>Senegal</option><option>Serbia</option><option>Seychelles</option><option>Sierra Leone</option><option>Singapore</option><option>Slovakia</option><option>Slovenia</option><option>Solomon Islands</option><option>Somalia</option><option>South Africa</option><option>South Korea</option><option>South Sudan</option><option>Spain</option><option>Sri Lanka</option><option>Sudan</option><option>Suriname</option><option>Swaziland</option><option>Sweden</option><option>Switzerland</option><option>Syria</option><option>Tajikistan</option><option>Tanzania</option><option>Timor-Leste</option><option>Togo</option><option>Tonga</option><option>Trinidad and Tobago</option><option>Tunisia</option><option>Turkey</option><option>Turkmenistan</option><option>Tuvalu</option><option>Turkey</option><option>Turkmenistan</option><option>Tuvalu</option><option>Uganda</option><option>Ukraine</option><option>United Arab Emirates</option><option>United Kingdom</option><option>United States of America</option><option>Uruguay</option><option>Uzbekistan</option><option>Vanuatu</option><option>Venezuela</option><option>Vietnam</option><option>Zambia</option><option>Zimbabwe</option>
              </select>
              <input name="MySchool" title="Name Of Student College/University/School" maxlength="15" id="MySchool" type="text" class="form-control" placeholder="Name Of College/University/School" style="margin-top:2%"/>
              <select title="Select Your Level" name="MyLeducation" id="MyLeducation" class="form-control" style="cursor: pointer;margin-top:2%">
                <option style="color: lightgray">Level Of Education</option>
                <option style="color:Orange;font-weight:bold">Middle School and High School</option>
                <option style="color:#0D8DFE">Grade_8/form One</option>
                <option style="color:#0D8DFE">Grade_9/form Two</option>
                <option style="color:#0D8DFE">Grade_10/form Three</option>
                <option style="color:#0D8DFE">Grade_11/form Four</option>
                <option style="color:#0D8DFE">Grade_12/form Five</option>
                <option style="color:#0D8DFE">Grade_13/form Six</option>
                <option style="color:Orange;font-weight:bold;border-style:solid;border-width:thin;border-color:black">Vocational Training</option>
                <option style="color:#0D8DFE">Vocational Education</option>
                <option style="color:Orange;font-weight:bold;border-style:solid;border-width:thin;border-color:black">University Level</option>
                <option style="color:#0D8DFE">University Education</option>
              </select>
              <button type="button" onclick="Registration()" class="btn btn-primary" style="width: 100%;font-weight:bold;margin-top:4%">Get Account</button><br/>
           </div>
           <div id="StudentAccount" class="card PanelAccount" style="margin-top:-38.1%;display:none;width:400px;padding:35px">
              <img src="Photos/Forum_Header1.png" style="width:80%;margin-top:-6%"><br/>
              <label style="color:lightgray;font-family:'Agency FB'">Sign up now to learning and share Ideas</label><br/>
              <label style="color:lightgray;font-family:'Agency FB'">with Other fellow students from different countries</label><br/>
              <button class="btn btn-primary" style="width:100%;font-weight:bold;border-radius: 5px">Login</button><br/>
              <label style="color:lightgray;font-family:'Times New Roman';font-weight:bold;margin-top:5%">_____________________  OR  ____________________</label><br/>
              <input title="Student Password" maxlength="10" name="Password" required type="password" class="form-control" placeholder="Password" style="margin-top:5%"/>
              <input title="Confirm Password" maxlength="10" name="ConfirmPassword" required type="password" class="form-control" placeholder="Confirm Password" style="margin-top:2%"/>
              <button type="submit" name="InsertMyDetail" class="btn btn-primary"  style="width: 100%;font-weight:bold;margin-top:4%">Sinup</button>
              <label></label>
            </div>
      </form>
    </center>
    </div>
  </body>
</html>
