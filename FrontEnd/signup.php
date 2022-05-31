<?php

/* 
 * Authors      : Swapneel Khandagale
 * Updated Date : 10-MAY-2022
 */

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myemail = mysqli_real_escape_string($db,$_POST['email']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']);
      $sql="INSERT INTO `users` (`email`, `password`) VALUES ('$myemail', '$mypassword')";
      $result = mysqli_query($db,$sql);
      $sql2 = "INSERT INTO `s3config` (`id`, `email`, `access_key_id`, `secret_key`, `bucket_name`) VALUES (NULL, 'samplemail@mail.test', 'qwertyuiop', 'qqwertyuiop', 'qwertyuio')";
   }
   //$message = "Successfully signed up, proceed to login";
   $_SESSION['message'] = "Successfully signed up, proceed to login";
   header('Location: index.php');
?>