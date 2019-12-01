<?php
$conn=mysqli_connect('localhost','root','','scholardiscussiondata');
session_start();
if (!isset($_SESSION['Codes']))
{
    //header("location:../");
}
?>
