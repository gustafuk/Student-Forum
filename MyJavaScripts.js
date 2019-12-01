function Registration()
{
  var StudentDetailForm  = document.getElementById('StudentDetails');
  var StudentAccountForm  = document.getElementById('StudentAccount');
  var MyEmail  = document.getElementById('MyEmail');
  var MyFname  = document.getElementById('MyFname');
  var MyLname  = document.getElementById('MyLname');
  var MySchool  = document.getElementById('MySchool');
  var country  = document.getElementById('country');
  var MyGender  = document.getElementById('MyGender');
  var AlertMessage  = document.getElementById('AlertMessage');
  var MyLeducation  = document.getElementById('MyLeducation');
  if(MyEmail.value == '' && MyFname.value == '' && MyLname.value == '' && MySchool.value == '' && country.value == 'Country' && MyGender.value == 'Gender' && (MyLeducation.value == 'Level Of Education' || MyLeducation.value == 'Middle School and High School' || MyLeducation.value == 'Vocational Training' || MyLeducation.value == 'University Level'))
  {
    MyFname.style.borderWidth = 'thin';
    MyFname.style.borderStyle = 'solid';
    MyFname.style.borderColor = 'Red';
    MyEmail.style.borderWidth = 'thin';
    MyEmail.style.borderStyle = 'solid';
    MyEmail.style.borderColor = 'Red';
    MyLname.style.borderWidth = 'thin';
    MyLname.style.borderStyle = 'solid';
    MyLname.style.borderColor = 'Red';
    country.style.borderWidth = 'thin';
    country.style.borderStyle = 'solid';
    country.style.borderColor = 'Red';
    MyGender.style.borderWidth = 'thin';
    MyGender.style.borderStyle = 'solid';
    MyGender.style.borderColor = 'Red';
    MySchool.style.borderWidth = 'thin';
    MySchool.style.borderStyle = 'solid';
    MySchool.style.borderColor = 'Red';
    MyLeducation.style.borderWidth = 'thin';
    MyLeducation.style.borderStyle = 'solid';
    MyLeducation.style.borderColor = 'Red';
  }
  else if (MyFname.value == '')
  {
    MyFname.style.borderWidth = 'thin';
    MyFname.style.borderStyle = 'solid';
    MyFname.style.borderColor = 'Red';
  }
  else if (MyLname.value == '')
  {
    MyLname.style.borderWidth = 'thin';
    MyLname.style.borderStyle = 'solid';
    MyLname.style.borderColor = 'Red';
  }
  else if (MyEmail.value == '')
  {
    MyEmail.style.borderWidth = 'thin';
    MyEmail.style.borderStyle = 'solid';
    MyEmail.style.borderColor = 'Red';
  }
  else if (MyGender.value == 'Gender')
  {
    MyGender.style.borderWidth = 'thin';
    MyGender.style.borderStyle = 'solid';
    MyGender.style.borderColor = 'Red';
  }
  else if (country.value == 'Country')
  {
    country.style.borderWidth = 'thin';
    country.style.borderStyle = 'solid';
    country.style.borderColor = 'Red';
  }
  else if (MySchool.value == '')
  {
    MySchool.style.borderWidth = 'thin';
    MySchool.style.borderStyle = 'solid';
    MySchool.style.borderColor = 'Red';
  }
  else if (MyLeducation.value == 'Level Of Education' || MyLeducation.value == 'Middle School and High School' || MyLeducation.value == 'Vocational Training' || MyLeducation.value == 'University Level')
  {
    MyLeducation.style.borderWidth = 'thin';
    MyLeducation.style.borderStyle = 'solid';
    MyLeducation.style.borderColor = 'Red';
  }
  else if (country.value == 'Country' && MyGender.value == 'Gender')
  {
    country.style.borderWidth = 'thin';
    country.style.borderStyle = 'solid';
    country.style.borderColor = 'Red';
    MyGender.style.borderWidth = 'thin';
    MyGender.style.borderStyle = 'solid';
    MyGender.style.borderColor = 'Red';
  }
  else
  {
    StudentDetailForm.style.marginLeft = '-1790px';
    StudentAccountForm.style.marginRight = '500px';
    StudentAccountForm.style.transition ='0.6s';
    StudentDetailForm.style.transition ='0.6s';
    StudentAccountForm.style.display = 'block';
  }
}
function Loader()
{
  var MyLoader = document.getElementById('MyLoader');
  MyLoader.style.display = 'none';
}
function AllowMove()
{
  var Allow =  document.getElementById('Allow');
  Allow.style.marginLeft = '42%';
}
