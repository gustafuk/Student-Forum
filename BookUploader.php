<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
</head>
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
    }
 }
 ?>
<?php
if(isset($_POST['ShowBooksO']))
{
include("db.php");
$BookSearch = $_POST['BookSearch'];
if($BookSearch == '')
{
$query = "select * from books where BookLevel = 'Ordinal'";
$data = mysqli_query($conn, $query);
$Total = mysqli_num_rows($data);
if ($Total!=0)
 {
   while ($result = mysqli_fetch_assoc($data))
    {
      ?><div class="StyleMe">
        <img class="zoom" src="<?php echo $result['BookCoverImage'] ?>" style="width:100%;height:84%;cursor:pointer">
        <center><div  style="width:100%;padding:2%"><button class="btn-xs btn btn-primary" style="border-radius:0;width:100%;margin-top:0.5%">Add book to my list</button></div></center>
      </div>
      <?php
    }
  }
}
else
{
  $query = "select * from books where Book like '$BookSearch'";
  $data = mysqli_query($conn, $query);
  $Total = mysqli_num_rows($data);
  if ($Total!=0)
   {
     while ($result = mysqli_fetch_assoc($data))
      {
        ?><div class="StyleMe">
          <img  class="zoom"  src="<?php echo $result['BookCoverImage'] ?>" style="width:100%;height:84%;cursor:pointer">
          <center><div style="width:100%;padding:2%"><button class="btn-xs btn btn-primary" style="border-radius:0;width:100%;margin-top:0.2%">Add book to my list</button></div></center>
        </div>
        <?php
      }
    }
}
}
?>
<?php
if(isset($_POST['ShowBooksA']))
{
include("db.php");
$BookSearch = $_POST['BookSearch'];
if($BookSearch == '')
{
$query = "select * from books where BookLevel = 'Advanced'";
$data = mysqli_query($conn, $query);
$Total = mysqli_num_rows($data);
if ($Total!=0)
 {
   while ($result = mysqli_fetch_assoc($data))
    {
      ?><div  class="StyleMe">
        <img class="zoom"  src="<?php echo $result['BookCoverImage'] ?>" style="width:100%;height:84%;cursor:pointer">
        <center><div style="width:100%;padding:2%"><button class="btn-xs btn btn-primary" style="border-radius:0;width:100%;margin-top:0.5%">Add book to my list</button></div></center>
      </div>
      <?php
    }
  }
}
else
 {
   $query = "select * from books where Book like '$BookSearch'";
   $data = mysqli_query($conn, $query);
   $Total = mysqli_num_rows($data);
   if ($Total!=0)
    {
      while ($result = mysqli_fetch_assoc($data))
       {
         ?><div class="StyleMe">
           <img  class="zoom"  src="<?php echo $result['BookCoverImage'] ?>" style="width:100%;height:84%;cursor:pointer">
           <center><div style="width:100%;padding:2%"><button class="btn-xs btn btn-primary" style="border-radius:0;width:100%;margin-top:0.2%">Add book to my list</button></div></center>
         </div>
         <?php
       }
     }
 }
}
?>
<?php
if(isset($_POST['ShowBooksU']))
{
include("db.php");
$BookSearch = $_POST['BookSearch'];
if($BookSearch == '')
{
  $query = "select * from books where BookLevel = 'University'";
  $data = mysqli_query($conn, $query);
  $Total = mysqli_num_rows($data);
  if ($Total!=0)
   {
     while ($result = mysqli_fetch_assoc($data))
      {
        ?><div class="StyleMe">
        <form method="post" action="#" enctype="multipart/form-data">
          <input name="Book" value="<?php echo $result['Book'] ?>" style="display: none"/>
          <input name="BookCoverImage" value="<?php echo $result['BookCoverImage'] ?>" style="display: none"/>
          <img  class="zoom"  src="<?php echo $result['BookCoverImage'] ?>" style="width:100%;height:84%;cursor:pointer">
          <center>
            <div style="width:100%;padding:2%">
            <button type="submit" name="AddBookThisBook" class="btn-xs btn btn-primary" style="border-radius:0;width:100%;margin-top:0.2%">Add book to my list</button>
           </div>
         </center>
        </form>
        </div>
        <?php
      }
    }
}
else
{
  $query = "select * from books where Book like '$BookSearch'";
  $data = mysqli_query($conn, $query);
  $Total = mysqli_num_rows($data);
  if ($Total!=0)
   {
     while ($result = mysqli_fetch_assoc($data))
      {
        ?>

        <div class="StyleMe">
          <form method="post" action="#" enctype="multipart/form-data">
            <input name="Book" value="<?php echo $result['Book'] ?>" style="display: none"/>
            <input name="BookCoverImage" value="<?php echo $result['BookCoverImage'] ?>" style="display: none"/>
            <img  class="zoom"  src="<?php echo $result['BookCoverImage'] ?>" style="width:100%;height:84%;cursor:pointer">
            <center><div style="width:100%;padding:2%">
            <button type="submit" Name="AddBook"  class="btn-xs btn btn-primary" style="font-weight:bold;border-radius:0;width:100%;margin-top:0.2%">Add book to my list</button>
            </div></center>
          </form>
        </div>
        <?php
      }
    }
}
}
if(isset($_POST['MyBooksList']))
{
  include("db.php");
    $query = "select * from mybooks where BookManager = '$EmailOrPhone'";
    $data = mysqli_query($conn, $query);
    $Total = mysqli_num_rows($data);
    if ($Total!=0)
     {
       while ($MyBooks = mysqli_fetch_assoc($data))
        {
            ?>
            <li><a title="<?php echo $MyBooks['Book'] ?>" style="height:5%;cursor:pointer"><img  class="zoomWE" src="<?php echo $MyBooks['BookCoverImage'] ?>" style="width:10%;height:150%;margin-top: -2%;border-radius:0px;float:left">
              <center><div  class="minimizeLongText"><?php echo $MyBooks['Book'] ?></div></center></a>
            </li>
            <?php
        }
     }
}
?>

<style>
.minimizeLongText
{
  white-space: nowrap;
  width: 135px;
  overflow: hidden;
  text-overflow: ellipsis;
}
.StyleMe
{
    width: 15%;
    height: 90%;
    margin-left:1%;
    margin-top: 1%;
    background-color: white;
    display:  inline-block;
    border-style: solid;
    border-width: thin;
    border-color: black;
    box-shadow:1px 14px 5px -12px rgba(5,2,0,0.9);
}
</style>
<script>
$(function()
{
$('[data-toggle="popover"]').popover()
})
</script>
</html>
