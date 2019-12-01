<html>
<?php
    include 'Session.php';
    $EmailOrPhone = $_SESSION['EmailAddressOrPhoneNumber'];
    $password = $_SESSION['Password'];
    if(isset($_POST['UPDATINGDOB']))
    {
      $conn = mysqli_connect('localhost','root','','scholardiscussiondata');
      $name=$_POST['name'];
      if(!$conn)
         {
           die('server not connected');
         }
       else
        {
          $query = "update scholardetails set DOB = '$name' where EmailAddressOrPhoneNumber like '$EmailOrPhone'";
          mysqli_query($conn, $query);
          mysqli_close($conn);
        }
    }//adding patner
 ?>
 <?php
 if(isset($_POST['showDOB']))
 {
 include("db.php");
 $query = "select * from scholardetails where EmailAddressOrPhoneNumber like '$EmailOrPhone'";
 $data = mysqli_query($conn, $query);
 $Total = mysqli_num_rows($data);
 if ($Total!=0)
  {
    while ($resultw = mysqli_fetch_assoc($data))
     {
       $DOB = $resultw['DOB'];
       echo $DOB; ?><br/><?php
       if($DOB == '')
       {
          echo 'No date';
       }
       else
       {
         $bday  = new DateTime($DOB);
         $today  = new DateTime();
         $b_y = $bday->format('Y');
         $b_d = $bday->format('d');
         $b_m = $bday->format('m');

         if((bool)$bday->format('L') && $b_d == 29 && $b_m == 2){
           if((bool)$today->format('L')){
             $bday_obj = new DateTime(date('Y').'-'.$b_m.'-'.$b_d);
             $diff = $bday_obj->diff($today);
           }else{
             for($i=1;$i++;$i<=3){
               $today->add(new DateInterval('P1Y'));
               if((bool)$today->format('L')){
                 $bday_obj = new DateTime(date('Y').'-'.$b_m.'-'.$b_d);
                 $diff = $bday_obj->diff($today);
                 break ;
               }
             }
           }
         }else{
           $bday_obj = new DateTime(date('Y').'-'.$b_m.'-'.$b_d);
           $diff = $bday_obj->diff($today);
         }

         $now = new DateTime() ;
         if($now > $bday_obj){
            {
             ?><br/><h7 style="margin-left:5%;color:red;font-size:108%"><?php echo 'Your birthday was over '.$diff->format('%a days').' before';?></h7><?php
           }
         }
         else
         {
           if($diff->format('%a') == '0')
           {
               echo 'Today is your HappyBirthDay';
               ?>
                 <img src="Photos/birthday-cake-gif-51.gif" style="float:right;height:30%;margin-top:-12%"/>
               <?php
           }
           else {
             ?><br/><h7 style="margin-left:5%;color:green;font-size:108%"><?php
             echo 'Your birthday is after  '.$diff->format('%a days');?></h7><?php
           }

         }
       }
     }
  }
}
?>
</html>
