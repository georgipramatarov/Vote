<!DOCTYPE html>
<html>
 @include('includes.head')
<body>
<?php
 
  $query = "SELECT * FROM candidates WHERE ID = $_GET[ID]";
  $result = mysqli_query($con,$query);
  while($row = mysqli_fetch_assoc($result)){
    echo "<tr>";
    echo "<td>".$cands['cand_id']."</td>";
    echo "<td>".$cands['cand_name']."</td>";
    echo "<td>".$cands['longdescription']."</td>";
    echo "<td>";?><img src="<?php echo $cands["cand_img"];?>"height="120" width="120"><?php 
    echo "<td/>";
    echo "<tr/>";
    echo "<a href="#" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Back To Main Candidates Page</a>"
  }

  ?>
  </body>
  </html>
