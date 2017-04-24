<html>
 @include('includes.head')
<title>Secure Vote - Administrator</title>
<body>
  <p1>
    <center>
        <table class="table table-hover table-responsive">
          <thead>
            <tr>
              <th></th>
              <th>Votes</th>
              <th>Vote Start Date</th>
              <th>End Date</th>
              <th></th>
              <th><button>+Create New Vote</button></th>
          
            </tr>
           </thead>
          <tbody>
            <?php

              $con = mysqli_connect("csmysql.cs.cf.ac.uk","group8.2016","dafEvUth5","group8_2016");
              if(!$con){
                        die("Cant connect: " . mysql_error());
                    }
               
              $query = "SELECT * FROM elections";
              $today = date("Y-m-d H:i:s");
              $result = mysqli_query($con,$query);
              while($row = mysqli_fetch_assoc($result)){
              $date = $row["end_date"] . " 00:00:00";
              if ($date > $today) {
              echo "<tr><td></td><td>". $row["election_name"] . "</td><td>" . $row["start_date"] . "</td><td>" . $row["end_date"] . "</td><td><ahref=\"".$row["results"] ."\">View Voting Results</a></td></tr>" 
              ;}else{ 
              //this is if the election is the current one
              }
              }
              }

              ?>
          </tbody>
      </table>
      </center>
    </p1>
  </body>
</html>
