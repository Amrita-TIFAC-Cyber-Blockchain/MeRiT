<?php

/* 
 * Authors      : Swapneel Khandagale
 * Updated Date : 01-JUN-2022
 */
 
include('../config.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>MeRiT : Admin Panel</title>
	<link rel="icon" type="image/png" href="../images/logo.png">
	
	<link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
	<script type="text/javascript" src="../jquery.min.js"></script>
	<script type="text/javascript" src="../bootstrap.min.js"></script>
</head>
<body>
    
	<center>
	<img src="../images/logo.png" width="350">
            <h1>Admin Panel</h1>
	<form action="index.php" method="get">
            <h4>Surface Crawler</h4>
	<input type="submit" class="btn btn-secondary" name="surface_crawl_btn" value="Start Crawler" id="btnstyle2">
        <input type="submit" class="btn btn-secondary" name="surface_crawl_status" value="Check Crawler Status" id="btnstyle2">
        <input type="submit" class="btn btn-secondary" name="surface_crawl_stop" value="Stop Crawler" id="btnstyle2"><br>
        <h4>Deep Web Crawler</h4>
	<input type="submit" class="btn btn-secondary" name="dark_crawl_btn" value="Start Crawler" id="btnstyle2">
        <input type="submit" class="btn btn-secondary" name="dark_crawl_status" value="Check Crawler" id="btnstyle2">
        <input type="submit" class="btn btn-secondary" name="dark_crawl_stop" value="Stop Crawler" id="btnstyle2">
        </form>
            </center>
	<?php
    if( isset( $_GET[ 'surface_crawl_btn' ]  ) ) {
        $sql1 = "SELECT 'surface' from 'pid'";
        $rs1 = mysqli_query($db,$sql1);
        $descriptorspec = [
            0 => ['pipe', 'r'],
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w']
            ];
        $proc = proc_open('php crawle2.php', $descriptorspec, $pipes);
        $proc_details = proc_get_status($proc);
        $pid = $proc_details['pid'];
        echo $pid;
        $sql2 = "UPDATE `pid` SET `surface` = '$pid' WHERE `pid`.`surface` = '$rs1' LIMIT 1";
        $rs2 = mysqli_query($db,$sql2);
        echo "Crawler started";
        unset( $_GET[ 'surface_crawl_btn' ]  );
	//$cmd = shell_exec( 'php crawle2.php');
    }
    if( isset( $_GET[ 'surface_crawl_stop' ]  ) ) {
        $descriptorspec = [
            0 => ['pipe', 'r'],
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w']
            ];
        $proc = proc_open('kill -9 ', $descriptorspec, $pipes);
        /*$proc_details = proc_get_status($proc);
        $pid = $proc_details['pid'];
        echo $pid;*/
        echo "Crawler stopped";
        unset( $_GET[ 'surface_crawl_stop' ]  );
	//$cmd = shell_exec( 'php crawle2.php');
    }
    if( isset( $_GET[ 'surface_crawl_status' ]  ) ) {
        $sql1 = "SELECT surface from pid";
        $rs = mysqli_query($db,$sql1);
        if(file_exists("/proc/".$rs)){
            echo "Crawler running";
        } 
        else{
            echo "Crawler inactive";
        }
        unset( $_GET[ 'surface_crawl_status' ]  );
	//$cmd = shell_exec( 'php crawle2.php');
    }
    if( isset( $_GET[ 'dark_crawl_btn' ]  ) ) {
        $sql1 = "SELECT 'deep' from 'pid'";
        $rs1 = mysqli_query($db,$sql1);
        $descriptorspec = [
            0 => ['pipe', 'r'],
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w']
            ];
        $proc = proc_open('php crawle2_dark.php', $descriptorspec, $pipes);
        $proc_details = proc_get_status($proc);
        $pid = $proc_details['pid'];
        echo $pid;
        $sql2 = "UPDATE `pid` SET `deep` = '$pid' WHERE `pid`.`deep` = '$rs1' LIMIT 1";
        $rs2 = mysqli_query($db,$sql2);
        echo "Crawler started";
        unset( $_GET[ 'dark_crawl_btn' ]  );
	//$cmd = shell_exec( 'php crawle2_dark.php');
    }
    if( isset( $_GET[ 'dark_crawl_stop' ]  ) ) {
        $descriptorspec = [
            0 => ['pipe', 'r'],
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w']
            ];
        $proc = proc_open('kill -9 ', $descriptorspec, $pipes);
        /*$proc_details = proc_get_status($proc);
        $pid = $proc_details['pid'];
        echo $pid;*/
        echo "Crawler stopped";
        unset( $_GET[ 'dark_crawl_stop' ]  );
	//$cmd = shell_exec( 'php crawle2_dark.php');
    }
    if( isset( $_GET[ 'dark_crawl_status' ]  ) ) {
        $sql1 = "SELECT deep from pid";
        $rs = mysqli_query($db,$sql1);
        if(file_exists("/proc/".$rs)){
            echo "Crawler running";
        } 
        else{
            echo "Crawler inactive";
        }
        unset( $_GET[ 'dark_crawl_status' ]  );
	//$cmd = shell_exec( 'php crawle2.php');
    }
	?>
</body>
</html>