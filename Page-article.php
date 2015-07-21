<?php

	 include('includes/connect.php');
     include_once("includes/analyticstracking.php");

	 $interface = new databaseInterface();

	 if(isset($_GET['art_id'])){
        if(isset($_GET['typ'])){
            $typ = htmlspecialchars($_GET['typ']);
        }

	 	$art_id = htmlspecialchars($_GET['art_id']);

        if($typ == 'blog'){
            $typ = 'blog_items';
        }

        else if($typ == 'project'){
            $typ = 'project_items';
        }

	 	$article = $interface->getById($art_id, $typ);
	 	$tags_array = explode(":",$article[0]["tags"]);
        $interface->addView($art_id, $typ);
	 }
     if(isset($_GET['typ'])){
        $typ = htmlspecialchars($_GET['typ']);
     }


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title></title>
        <meta name="generator" content="Responsive Web Css (www.responsivewebcss.com)" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="Stylesheet" href="Page 1.css" />
        <link rel="Stylesheet" href="Page-article.css" />
        <link href='http://fonts.googleapis.com/css?family=Armata' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <script type="text/javascript">
            var fileNumber = Math.floor((Math.random() * 2) + 0); 
            var body = document.getElementsByTagName('body')[0];
            body.style.backgroundImage = 'url(img_res/bg-'+fileNumber+'.jpeg)';

            function redirectToCv(){
                    window.location.replace("Page-cv.htm");
                }
            function redirectToLog(){
                    window.location.replace("Page-blog.php?search=latest");
                }
            function redirectToProjects(){
                    window.location.replace("Page-projects.php?search=latest");
                }
            function redirectToHome(){
                    window.location.replace("Index.html");
                }

        </script>
        <div id='root'>            
            <div class='box' id='box4'>
                 <div id ='title'>
                    <p class = 'title'>Charlie Tizzard</p>
                </div>
                <div class='box' id='box6'>
                     <form method="get" action="Page-blog.php?search=latest&" id="tag">
                        <input name="tag" type="text" size="40" placeholder="Search..." />
                    </form>
                    <p class='menu_item' id='item_0' onclick='redirectToCv()' >CV</p>
                    <p class='menu_item' id='item_1' onclick='redirectToLog()' >Log</p>
                    <p class='menu_item' id='item_2' onclick='redirectToProjects()' >Projects</p>
                    <p class='menu_item' id='item_3' onclick='redirectToHome()' >Home</p>
                </div>
                	<div class='box' id='box8'>
                		<div class='article'>
                			<?php
                			$link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                			echo"<span id='art-title'><b>
                				 ".$article[0]['title']."</b>
                			</span>
                			<div id='art-details'>
                				 ".$article[0]['author']." - ".$article[0]['date']." - ";
                				 foreach ($tags_array as $key) {
                                    if($_GET['typ'] == 'blog')
                                 	  echo"<a href='Page-blog.php?search=latest&tag=$key'>#$key,</a> ";
                                    else
                                         echo"<a href='Page-projects.php?search=latest&tag=$key'>#$key,</a> ";
                                 }
                            echo "</div>
                			<div id='art-content'>";
                			$file = file_get_contents($article[0]['source'], true);
                			echo $file;
                			echo"</div>";
                			echo'</br>
                			<!-- I got these buttons from simplesharebuttons.com -->
							<div id="share-buttons">
							 
							    <!-- Facebook -->
							    <a class="link" href="http://www.facebook.com/sharer.php?u='.$link.'" target="_blank">
							        <img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />
							    </a>
							    
							    <!-- Google+ -->
							    <a class="link" href="https://plus.google.com/share?url='.$link.'" target="_blank">
							        <img src="https://simplesharebuttons.com/images/somacro/google.png" alt="Google" />
							    </a>
							    
							    <!-- LinkedIn -->
							    <a class="link" href="http://www.linkedin.com/shareArticle?mini=true&amp;url='.$link.'" target="_blank">
							        <img src="https://simplesharebuttons.com/images/somacro/linkedin.png" alt="LinkedIn" />
							    </a>
							    
							    <!-- Reddit -->
							    <a class="link" href="http://reddit.com/submit?url='.$link.'&amp;title='.$article[0]['title'].'" target="_blank">
							        <img src="https://simplesharebuttons.com/images/somacro/reddit.png" alt="Reddit" />
							    </a>
							    
							    <!-- Tumblr-->
							    <a class="link" href="http://www.tumblr.com/share/link?url='.$link.'&amp;title='.$article[0]['title'].'" target="_blank">
							        <img src="https://simplesharebuttons.com/images/somacro/tumblr.png" alt="Tumblr" />
							    </a>
							     
							    <!-- Twitter -->
							    <a class="link" href="https://twitter.com/share?url='.$link.'&amp;name='.$article[0]['title'].'&amp;" target="_blank">
							        <img src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />
							    </a>
							</div>
                            <div id="views">
                            <b> - '.$article[0]['views'].' Views </b>
                            </div>';
                			?>
                			
                		</div>
                	</div>
            </div>
        </div>
    </body>
</html>