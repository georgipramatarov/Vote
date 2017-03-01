<?php
include ("functions.php")
?> 


<html>
<head>
<title>Online Voting System</title>

<link rel="stylesheet" href="style.css" media="all" />
<h1><br/>Candidate Details <img src="padlock.png" height="50"><br/><br/></h1>

</head>

<div id="products_box">

		    	<?php getCands(); ?>
		    	<?php getInfo(); ?>


		    </div>


</html>
