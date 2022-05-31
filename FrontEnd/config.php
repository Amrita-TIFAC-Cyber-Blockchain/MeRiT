<?php

/* 
 * Authors      : Swapneel Khandagale
 * Updated Date : 10-MAY-2022
 */

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'augustoandro');
   define('DB_PASSWORD', 'blackarch');
   define('DB_DATABASE', 'hyperledger');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
?>