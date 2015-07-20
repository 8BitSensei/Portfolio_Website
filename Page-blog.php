<?php

   include('includes/connect.php');

 

    class ListObject {
        public $title;
        public $description;
        public $author;
        public $date;
        public $tags = array();

        public function __construct($title, $description, $author, $date) {
            $this->title = $title;
            $this->description = $description;
            $this->author = $author;
            $this->date = $date;
        }
    
    }

    $interface = new databaseInterface();

    if(isset($_GET['search'])){
        if($_GET['search']=='latest'){

              if(isset($_GET['tag'])){
                $result = $interface->getByTag(htmlspecialchars($_GET['tag']),'blog_items','date');
              }
              else{
                $result = $interface->getByDate('blog_items');
              }
        }
        else if($_GET['search']=='popular'){
             if(isset($_GET['tag']))
                $result = $interface->getByTag(htmlspecialchars($_GET['tag']),'blog_items','popular');
             else
                $result = $interface->getByViews('blog_items');
        }
        else{
             $result = $interface->getAll('blog_items');
        }
    }
    else{
        header( "Location: Page-blog.php?search=latest&tag=".$_GET['tag'] );
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <meta charset="utf-8">
        <title></title>
        <meta name="generator" content="Responsive Web Css (www.responsivewebcss.com)" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="Stylesheet" href="Page 1.css" />
        <link rel="Stylesheet" href="Page-blog.css" />
        <link href='http://fonts.googleapis.com/css?family=Armata' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
       
        <!-- Arrow icons made by Freepik from www.flaticon.com is licensed by CC BY 3.0 -->
    </head>
    <body>
        <script type="text/javascript">

            var fileNumber = Math.floor((Math.random() * 2) + 0); 
            var body = document.getElementsByTagName('body')[0];
            body.style.backgroundImage = 'url(img_res/bg-'+fileNumber+'.jpeg)';

            function redirectToArticle(id){
                    window.location.replace("Page-article.php?art_id="+id+"&typ=blog");
                }

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

            $(document).ready(function(){

                var $_GET = {};
                document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
                    function decode(s) {
                        return decodeURIComponent(s.split("+").join(" "));
                    }

                    $_GET[decode(arguments[1])] = decode(arguments[2]);
                });


                if($_GET['search'] == 'latest')
                    $('#a').addClass('selected');

                 if($_GET['search'] == 'popular')
                    $('#b').addClass('selected');
 
                var $sidebar = $(".left-column"), 
                $window = $(window),
                offset = $sidebar.offset(),
                topPadding = 15;

                $window.scroll(function() {
                    if ($window.scrollTop() > offset.top) {
                        $sidebar.stop().animate({
                            marginTop: $window.scrollTop() - offset.top + topPadding
                        });
                    } else {
                        $sidebar.stop().animate({
                            marginTop: 0
                        });
                    }
                });

              
                $('#a').click(function(){
                        window.location = 'Page-blog.php?search=latest';
                });
                  $('#b').click(function(){
                        window.location = 'Page-blog.php?search=popular';
                });

                


            });

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
                    <div class='left-column' id='sticky'>
                        <div class='side-menu'>
                            <div id='tab-list'>
                                <ul style="list-style-type:none" >
                                    <li class='menu-tab' id='a'>Latest</li>
                                    <li class='menu-tab' id='b'>Popular</li>
                                    <li class='menu-tab' id='c'><div class='tags'>
                                        <a href='Page-blog.php?search=latest&tag=Mobile'>#Mobile,</a> 
                                        <a href='Page-blog.php?search=latest&tag=Web'>#Web,</a> 
                                        <a href='Page-blog.php?search=latest&tag=Security'>#Security,</a> 
                                        <a href='Page-blog.php?search=latest&tag=Hardware'>#Hardware,</a> 
                                        <a href='Page-blog.php?search=latest&tag=Virtual Reality'>#Virtual Reality</a>
                                    </div></li>
                                    
                                </ul> 
                            </div>
                        </div>        
                    </div>
                    <div id='right-column'>
                        <?php
                           for($i = 0; $i < sizeof($result); $i++){
                                $tags_array = explode(":",$result[$i]["tags"]);
                                echo "<div class='list-item' style='box-shadow: 0px 0px 3px #888;' onclick='redirectToArticle(".$result[$i]['id'].");'>
                                        <ul style='list-style-type:none' class='item-li'>
                                            <li><b><p class='item-title'>".$result[$i]['title']."</p></b></li>
                                            <li><p class='description'>".$result[$i]['description']."</p></li>
                                            <li><p class='details'>".$result[$i]['author']." - ".$result[$i]['date']." - ";
                                            foreach ($tags_array as $key) {
                                                echo"<a href='Page-blog.php?search=latest&tag=$key'>
                                                #$key,</a> ";
                                            }

                                            echo"</p></li>
                                            </ul> 
                                            </div>";
                                }
                            
                        ?>
                    </div>
                </div>
            </div>
            
        </div>
       
    </body>
</html>