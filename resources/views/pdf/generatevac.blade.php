<?php
ob_start();
	function genCode(){
    	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    	$charactersLength = strlen($characters);
    	$randomString = '';
    	$length = 10;
    	
    	for ($i = 0; $i < $length; $i++) {
        	$randomString .= $characters[rand(0, $charactersLength - 1)];
    	}

    	return $randomString;
	}



	$connection = mysqli_connect("csmysql.cs.cf.ac.uk","group8.2016","dafEvUth5","group8_2016") or die ("DB connection failed 1");
	$query = "SELECT COUNT(id) as count FROM electoral_roll;";
	$result = mysqli_fetch_array(mysqli_query($connection,$query));

	$count = 1;
	
	while ($count <=  $result['count']){
		$vac = genCode();
		$query = "UPDATE `electoral_roll` SET `vac`='$vac' WHERE `id`=$count";

		if ( ! mysqli_query($connection, $query)) {
    		die(mysqli_error($conn));
		}

		$count++;
	}

	//Done, checkout
	session_start();
    $_SESSION['codesCreated'] = 1;
    session_write_close();
    header('Location:' . $_SERVER['HTTP_REFERER']);
    exit();
	

?>