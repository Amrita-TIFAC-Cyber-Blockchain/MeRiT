<?php 

/* 
 * Authors      : Swapneel Khandagale
 * Updated Date : 10-MAY-2022
 */

header('X-Frame-Options: DENY'); 
header('X-XSS-Protection: 1; mode=block'); 
header('X-Content-Type-Options: nosniff'); 
header('Content-Security-Policy: upgrade-insecure-requests'); 
?>