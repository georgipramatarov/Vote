<?php
$con = mysqli_connect("csmysql.cs.cf.ac.uk", "c1519251", "UqOHq7Xv", "c1519251");

$query = 'SELECT * FROM candidates';

$result = mysqli_query($con, $query);

?>

<html>
<head>
<title>Online Voting System</title>

<link rel="stylesheet" href="style.css" media="all" />

</head>

<body>
<h1><br/>Candidate Information <img src="padlock.png" height="50"><br/><br/></h1>


<table style="width:50%" align=center>
<?php

while ($cands = mysqli_fetch_assoc($result)) {

    echo "<tr>";

    echo "<td>".$cands['Name']."</td>";

    echo "<td>".$cands['Political_Party']."</td>";

    echo "<td>".$cands['info']."</td>";

    echo "<td>";?><img src="<?php echo $cands["cand_img"];?>"height="120" width="120"><?php 
    echo "<td/>";
    echo "<td> <a href="details.<php? ID=" . $row['Candidate_ID'];?> . "" class="btn btn-primary"><span class="glyphicon glyphicon-user"></span> More Details</a>
    echo "<tr/>";

}
?>

</table>
</body>
</html>
