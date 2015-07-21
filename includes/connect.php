<?php

	 class databaseInterface{

        public $connect;

         public function __construct() {
            $this->connect = mysqli_connect('localhost','root','', 'personal-website');

			if (mysqli_connect_errno()){
			  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
			 }	

			mysqli_select_db($this->connect, 'personal-website');
		}

        function getAll($table) {
            $sql = 'SELECT * FROM '.$table;
            $result = mysqli_query($this->connect, $sql);
            $return_array = array();
            if (mysqli_num_rows($result) > 0) {
			    // output data of each row
			    while($row = mysqli_fetch_assoc($result)) {
			      	$return_array[] = array("id"=>$row["id"],"title"=>$row["title"],"description"=>$row["description"],"author"=>$row["author"],"tags"=>$row["tags"],"date"=>$row["date"],"views"=>$row["views"]);
			    }
			} else {
			}
			return $return_array;
        }

        function getByDate($table) {
            $sql = 'SELECT * FROM '.$table.' ORDER BY date ASC';
            $result = mysqli_query($this->connect, $sql);
            $return_array = array();
            if (mysqli_num_rows($result) > 0) {
			    // output data of each row
			    while($row = mysqli_fetch_assoc($result)) {
			      	$return_array[] = array("id"=>$row["id"],"title"=>$row["title"],"description"=>$row["description"],"author"=>$row["author"],"tags"=>$row["tags"],"date"=>$row["date"],"views"=>$row["views"]);
			    }
			} else {
			}
			return $return_array;
        }

        function getByViews($table){
            $sql = 'SELECT * FROM '.$table.' ORDER BY views DESC';
            $result = mysqli_query($this->connect, $sql);
            $return_array = array();
            if (mysqli_num_rows($result) > 0) {
			    // output data of each row
			    while($row = mysqli_fetch_assoc($result)) {
			      	$return_array[] = array("id"=>$row["id"],"title"=>$row["title"],"description"=>$row["description"],"author"=>$row["author"],"tags"=>$row["tags"],"date"=>$row["date"],"views"=>$row["views"]);
			    }
			} else {
			}
			return $return_array;
        }

         function getByTag($tag, $table, $type){
         	if($type = 'latest')
            	$sql = 'SELECT * FROM '.$table.' ORDER BY date ASC';
            else if($type = 'popular')
            	$sql = 'SELECT * FROM '.$table.' ORDER BY views DESC';
            else
            	$sql = 'SELECT * FROM '.$table.'';
            $result = mysqli_query($this->connect, $sql);
            $return_array = array();
            if (mysqli_num_rows($result) > 0) {
			    // output data of each row
			    while($row = mysqli_fetch_assoc($result)) {
			    	$tags_array = explode(":",strtolower($row["tags"]));
			    	if(in_array(strtolower($tag), $tags_array)){
			      		$return_array[] = array("id"=>$row["id"],"title"=>$row["title"],"description"=>$row["description"],"author"=>$row["author"],"tags"=>$row["tags"],"date"=>$row["date"],"views"=>$row["views"],"source"=>$row["source"]);
			   		}
			    }
			} else {

			}
			return $return_array;
        }

        function getById($id, $table){
        	$sql = "SELECT * FROM `$table` WHERE `id` = '$id'";
            $result = mysqli_query($this->connect, $sql);
            $return_array = array();
            if (mysqli_num_rows($result) > 0) {
            	$row = mysqli_fetch_assoc($result);
			    $return_array[] = array("id"=>$row["id"],"title"=>$row["title"],"description"=>$row["description"],"author"=>$row["author"],"tags"=>$row["tags"],"date"=>$row["date"],"views"=>$row["views"],"source"=>$row["source"]);
			} else {
			}
			return $return_array;
        }

        function addView($id, $table){
        	$article = $this->getById($id, $table);
        	$views = $article[0]['views'];
        	$views = $views+1;
        	$sql = "UPDATE `$table` SET `views`=$views WHERE `id`=$id";
        	mysqli_query($this->connect, $sql);   	
        }
    }
?>