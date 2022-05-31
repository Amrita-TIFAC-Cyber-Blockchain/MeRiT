<?php

/* 
 * Authors      : Swapneel Khandagale
 * Updated Date : 01-JUN-2022
 */
 
include('../sec_headers.php');
include('../couch_config.php');
?>
<!DOCTYPE html>
<html>
      <head>
            <title>MeRiT : Image Search</title>
            <link rel="stylesheet" href="../css/bootstrap.min.css">
			<link rel="icon" type="image/png" href="../images/logo.png">
            <script type="text/javascript" src="../js/jquery.min.js"></script>
            <script type="text/javascript" src="../js/bootstrap.min.js"></script>
            <link rel="stylesheet" href="image_styles.css">
      </head>
      <body onload="ld()">
	  <img src="../images/logo.png" width="350">
<script type="text/javascript">
function ld()
{
  document.search_box.search.focus();
}
</script>

<script type="text/javascript">

	/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
} 
</script>
            <div class="container-fluid" id="bg">
            	<form action="imagesear.php" method="get">
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
                    <li><font size='+1' color='#9999ff'><a href='index.php?search=$search&search_btn=Scrap+Search'>All</a></font></li><li><font size='+1' color='#9999ff'><a class='current' href='imagesear.php?search=$search&search_btn=GO'>Images</a></font></li><li><font size='+1' color='#9999ff'><a href='videosear.php?search=$search&search_btn=GO'>Videos</a></font></li><li><font size='+1' color='#9999ff'><a href='newssear.php?search=$search&search_btn=GO'>News</a></font></li>
                    </ul>
                </nav>
            </div>
            <div class="result">    
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
                	if(@getimagesize($decoded_json2['link']))
                	{
                	echo "<div class='gallery'>
                	          <div class='imgp'>
                                  <img src='".$decoded_json2['visual_file']."' onclick='myFunction()' class='dropbtn'>
                              </div>
                              <div class='desc'>
                                  <center><div class='imgt contp1'><a href=".$decoded_json2['link'].">".$decoded_json2['site_head']."</a></div>
                                  <div class='imgd contp1'>".$decoded_json2['link']."</div></center>
                              </div>
                          </div>";
                      }
                echo "<div class='dropdown'>
                <div id='myDropdown' class='dropdown-content'>
                          <div class='imge'>
                              <a href='#'><img src='".$decoded_json2['visual_file']."'></a>
                          </div></div>
                      </div>";
                echo "<br><br><div class='footer'>";      
                echo "<br><br><div class='more'>Search more</div>";
                /*if($_GET['page']>1){
                     	$page=$page-1;
                     	echo "<a href='imagesear.php?search=$search&search_btn=GO&page=".$page."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Previous</a>";
                     }
                     for($page=1;$page<=$number_of_pages;$page++){
                     	echo "<a href='imagesear.php?search=$search&search_btn=GO&page=".$page."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$page."</a>";
                     }
                     if(!isset($_GET['page']))
                     {
                     	$page=1;
                     	$page=$page+1;
                     	echo "<a href='imagesear.php?search=$search&search_btn=GO&page=".$page."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Next</a>";
                     }
                     else if($_GET['page']!=13){
                     	$page=$_GET['page']+1;
                     	echo "<a href='imagesear.php?search=$search&search_btn=GO&page=".$page."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Next</a>";
                     }*/
                echo "</div>";
              }
                ?>
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