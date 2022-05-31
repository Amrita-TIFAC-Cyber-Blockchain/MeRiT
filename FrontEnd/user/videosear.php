<?php

/* 
 * Authors      : Swapneel Khandagale
 * Updated Date : 01-JUN-2022
 */
 
include('../sec_headers.php');
include('../couch_config.php');
include('../config.php');
?>
<!DOCTYPE html>
<html>
      <head>
            <title>MeRiT : Video Search</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link rel="icon" type="image/png" href="../images/logo.png">
            <link rel="stylesheet" href="../css/bootstrap.min.css">
            <script type="text/javascript" src="../js/jquery.min.js"></script>
            <script type="text/javascript" src="../js/bootstrap.min.js"></script>
            <link rel="stylesheet" href="styles.css">
      </head>
      <body onload="ld()">
      <img src="../images/logo.png" width="350"> 
<script type="text/javascript">function ld()
{
    document.search_box.search.focus();
}
</script>
            <div class="container-fluid" id="bg">
            	<form action="videosear.php" method="get">
                     <div class="row" id="bg">
                         <div class="col-sm-1" id="resdoodle">
                             <a href="../index.php"><font color="#FF0000">W</font><font color="#FFA500">e</font><font color="#008000">b</font><font color="#0000FF">s</font><font color="#0000FF">c</font><font color="#0000FF">r</font><font color="#0000FF">a</font><font color="#0000FF">p</font></a>
                         </div>
                         <div class="col-sm-6" id="searchbx2">
                             <div class="input-group">
                                 <input type="text" class="form-control" name="search" id="boxstyle2" required>
                                 <span class="input-group-btn">
                                      <input type="submit" class="btn btn-secondary" name="search_btn" value="GO" id="btnstyle2">
                                 </span>
                             </div>
                         </div>
                     </div>
                </form>
                <nav>
                    <ul>
                    <li><font size='+1' color='#9999ff'><a href='resu.php?search=$search&search_btn=Scrap+Search'>All</a></font></li><li><font size='+1' color='#9999ff'><a href='imagesear.php?search=$search&search_btn=GO'>Images</a></font></li><li><font size='+1' color='#9999ff'><a class='current' href='videosear.php?search=$search&search_btn=GO'>Videos</a></font></li><li><font size='+1' color='#9999ff'><a href='newssear.php?search=$search&search_btn=GO'>News</a></font></li>
                    </ul>
                </nav>
            </div>    
            <div class="result">
            	<table>
                       <tr>
                           <?php
                           $couchurl = 'http://augustoandro:windows@192.168.43.143:5984/hyperledger/_all_docs';
                           $output = file_get_contents($couchurl);
                           //echo $output;
                           $decoded_json = json_decode($output,true);
                           foreach($decoded_json['rows'] as $id) {
                            //echo $id['id'].'<br>';
                            $couchurl2 = 'http://augustoandro:windows@192.168.43.143:5984/hyperledger/'.$id['id'];
                            $output2 = file_get_contents($couchurl2);
                            //echo $output2;
                            $decoded_json2 = json_decode($output2,true);
                            if ($decoded_json2['file_type'] == 'video') {
                                // code...
                                echo "<div class='card'>";
                                echo "<div class='container'>";
                                echo "<a href='".$decoded_json2['link']."'><font size='4' color='#0000cc'> <b>".$decoded_json2['site_head']."</b> </font>";
                                echo "<div class='contp1'><font size='3' color='#006400'> <b>".$decoded_json2['link']."</b></font></div>";
                                echo "<div class='contp2'><font size='3' color='#666666'> <b>".$decoded_json2['description']."</b></font></div></a>";
                                echo "</div>";
                                echo "</div><br>";
                            }
                           }
                           //echo $decoded_json['rows'][0]['id'];
                           //echo "<center><h4><b>Oops! No result found for your query</b></h4></center>";
                           ?> 
                       </tr>
                </table>
            </div>
            <script type="text/javascript">
            	window.onscroll = function() {scrollFunction()};
function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("myBtn").style.display = "block";
  } else {
    document.getElementById("myBtn").style.display = "none";
  }
}
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
} 
            </script>
             <button onclick="topFunction()" id="myBtn" title="Go to top">^</button>
      </body>
</html>