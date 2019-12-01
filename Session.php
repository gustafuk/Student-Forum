<?php
$conn=mysqli_connect('localhost','root','','scholardiscussiondata');
session_start();
if (!isset($_SESSION['EmailAddressOrPhoneNumber']))
{
    header("location:Home.php");
}
?>
