<?php

/* 
 * Authors      : Swapneel Khandagale
 * Updated Date : 10-MAY-2022
 */

   session_start();
   
   if(session_destroy()) {
      header("Location: index.php");
   }
?>