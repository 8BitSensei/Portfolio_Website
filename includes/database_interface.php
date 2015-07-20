<?php namespace database;

	require_once('connect.php');
	class database_interface{
		

		function getAll(){
			$sql = 'SELECT * FROM blog-item';
			$result = $connect->query($sql);
			return $result;
		}

		function getByDate(){
			$sql = 'SELECT * FROM blog-item ORDER BY Upload ASC';
			$result = $connect->query($sql);
			return $result;
		}

		function getByViews(){
			$sql = 'SELECT * FROM blog-item ORDER BY Views DESC';
			$result = $connect->query($sql);
			return $result;
		}
	}

?>