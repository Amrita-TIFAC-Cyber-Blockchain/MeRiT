<?php

/* 
 * Authors      : Swapneel Khandagale
 * Updated Date : 10-MAY-2022
 */

   include('config.php');
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myemail = mysqli_real_escape_string($db,$_POST['email']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT id FROM users WHERE email = '$myemail' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count > 0) {
         if($myemail == 'admin@beta.test'){
             header("location: ./admin/");
         }
         else{
             header("location: ./user/");
         }
      }else {
         $error = "Your Email or Password is incorrect";
      }
   }
?>