<!DOCTYPE html>
<html>
 @include('includes.head')
<body>
<?php
 <?php
  $con = mysqli_connect("csmysql.cs.cf.ac.uk", "group8.2016", "dafEvUth5", "group8_2016");
  $query = "SELECT * FROM Candidates WHERE ID = $_GET[	Candidate_ID]";
  $result = mysqli_query($con,$query);
  while($row = mysqli_fetch_assoc($result)){
    echo "<tr>";
    echo "<td>".$cands['Name']."</td>";
    echo "<td>".$cands['Polotical_Party']."</td>";
    echo "<td>".$cands['Info_Long']."</td>";
    echo "<td>";?><img src="<?php echo $cands["cand_img"];?>"height="120" width="120"><?php 
    echo "<td/>";
    echo "<tr/>";
    echo "<a href="candidates" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Back To Main Candidates Page</a>"
  }

  ?>
  </body>
  </html>
