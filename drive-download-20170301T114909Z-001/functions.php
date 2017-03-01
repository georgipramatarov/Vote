<?php

$con = mysqli_connect("csmysql.cs.cf.ac.uk", "c1519251", "UqOHq7Xv", "c1519251");


function getCands() {

	global $con;

	$get_cands = "select * from candidates";

	$run_cands = mysqli_query($con, $get_cands); 

	while ($row_cands=mysqli_fetch_array ($run_cands)) {

		$cand_id = $row_cands['cand_id'];
		$cand_name = $row_cands['cand_name'];

	echo "<li><a href='candidate_details.php?cand=$cand_id'>$cand_name</a></li>";
	} 

}

function getInfo() {

	if(!isset($_GET['info'])){

    global $con;
    $get_info = "select * from candidates order by RAND() LIMIT 0,6";

    $run_info = mysqli_query($con, $get_info);

    while($row_info=mysqli_fetch_array($run_info)){

    	$cand_id = $row_info ['cand_id'];
    	$cand_name = $row_info ['cand_name'];
    	$decription = $row_info ['description'];
    	$cand_img = $row_info ['cand_img'];

        echo "
               <div id='single_product'>
                    
                    <h3>$cand_name</h3>
                    <img src='cand_img/$cand_img' width='180' height='180'/>
                    <p>$description</p>

                
                </div>
        ";
    }
}

?>