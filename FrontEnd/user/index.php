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
            <title>MeRiT : Search</title>
            <link rel="stylesheet" href="../css/bootstrap.min.css">
			<link rel="icon" type="image/png" href="../images/logo.png">
            <script type="text/javascript" src="../js/jquery.min.js"></script>
            <script type="text/javascript" src="../js/bootstrap.min.js"></script>
            <link rel="stylesheet" href="styles.css">
      </head>
      <body onload="ld()">
	  <img src="../images/logo.png" width="350">
      	<script type="text/javascript">
            function ld() {
                document.search_box.search.focus();
            }
        </script>
            <div class="container-fluid" id="bg">
                <form action="index.php" method="get">
                     <div class="row" id="bg">
                         <div class="col-sm-1" id="resdoodle">
                             <a href="../index.php"><font color="#FF0000">M</font><font color="#FFA500">e</font><font color="#008000">R</font><font color="#0000FF">i</font><font color="#0000FF">T</font></a>
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
                    <li><font size='+1' color='#9999ff'><a class='current' href='index.php?search=$search&search_btn=Scrap+Search'>All</a></font></li><li><font size='+1' color='#9999ff'><a href='imagesear.php?search=$search&search_btn=GO'>Images</a></font></li><li><font size='+1' color='#9999ff'><a href='videosear.php?search=$search&search_btn=GO'>Videos</a></font></li><li><font size='+1' color='#9999ff'><a href='newssear.php?search=$search&search_btn=GO'>Articles</a><a href='s3_config.php'>S3 Config</a></font></li>
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
                            echo "<div class='card'>";
                            echo "<div class='container'>";
                            echo "<a href='".$decoded_json2['link']."'><font size='4' color='#0000cc'> <b>".$decoded_json2['site_head']."</b> </font>";
                            echo "<div class='contp1'><font size='3' color='#006400'> <b>".$decoded_json2['link']."</b></font></div>";
                            echo "<div class='contp2'><font size='3' color='#666666'> <b>".$decoded_json2['description']."</b></font></div></a>";
                            echo "</div>";
                            echo "</div><br>";
                           }
                           //echo $decoded_json['rows'][0]['id'];
                           //echo "<center><h4><b>Oops! No result found for your query</b></h4></center>";
                           ?> 
                       </tr>
                </table>
                
                <?php
                /*                if(isset($_GET['search_btn']))
                                {
                                 $search=mysqli_real_escape_string($_con,$_GET['search']);
                    echo "<a href='imagesear.php?search=$search&search_btn=GO'><font size='+1' color='#1a1aff'>More Images for $search</font></a>";
                     echo "<hr>";
                     $results_per_page=12;
                     $_sql2="select * from surface_crawl where site_head like '%".$search."%' limit 0,156";
                     $rs2=mysqli_query($db,$_sql2);
                     $number_of_results=mysqli_num_rows($rs2);
                     $number_of_pages=ceil($number_of_results/$results_per_page);
                     if(!isset($_GET['page'])){
                     	$page=1;
                     }
                     else{
                     	$page=$_GET['page'];
                     }
                     $this_page_first_result=($page-1)*$results_per_page;
                     $_sql4="select * from surface_crawl where site_head like '%".$search."%' limit ".$this_page_first_result.",".$results_per_page;
                     $rs4=mysqli_query($_con,$_sql4);
                     while($resul=mysqli_fetch_assoc($rs4))
                     {
                      echo "<div class='card'>";
                      echo "<div class='container'>";
                      echo "<a href='".$resul['slink']."'><font size='4' color='#0000cc'> <b>".$resul['stitle']."</b> </font>";
                      echo "<div class='contp1'><font size='3' color='#006400'> <b>".$resul['slink']."</b></font></div>";
                      echo "<div class='contp2'><font size='3' color='#666666'> <b>".$resul['sdesc']."</b></font></div></a>";
                      echo "</div>";
                      echo "</div>";
                     }
                     echo "<br><div class='more'>Search more</div>";
                     if($_GET['page']>1){
                     	$page=$page-1;
                     	echo "<a href='index.php?search=$search&search_btn=GO&page=".$page."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Previous</a>";
                     }
                     for($page=1;$page<=$number_of_pages;$page++){
                     	echo "<a href='index.php?search=$search&search_btn=GO&page=".$page."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$page."</a>";
                     }
                     if(!isset($_GET['page']))
                     {
                     	$page=1;
                     	$page=$page+1;
                     	echo "<a href='index.php?search=$search&search_btn=GO&page=".$page."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Next</a>";
                     }
                     else if($_GET['page']!=13){
                     	$page=$_GET['page']+1;
                     	echo "<a href='index.php?search=$search&search_btn=GO&page=".$page."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Next</a>";
                     }
                     }*/
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