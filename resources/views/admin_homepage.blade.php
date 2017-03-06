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

              $con = mysqli_connect("csmysql.cs.cf.ac.uk","c1528155","2fyNstSgt","c1528155");
              if(!$con){
                        die("Cant connect: " . mysql_error());
                    }

              $query = "SELECT * FROM CURRENTVOTE";

              $result = mysqli_query($con,$query);
              while($row = mysqli_fetch_assoc($result)){
              echo "<tr><td>Current Vote...</td><td>". $row["VotingQuestion"] . "</td><td>" . $row["StartDate"] . "</td><td>" . $row["EndDate"] . "</td><td></td></tr>" 
              ;
              }
               
               $query = "SELECT * FROM PREVIOUSVOTES";

              $result = mysqli_query($con,$query);
              while($row = mysqli_fetch_assoc($result)){
              echo "<tr><td></td><td>". $row["VotingQuestion"] . "</td><td>" . $row["StartDate"] . "</td><td>" . $row["EndDate"] . "</td><td><ahref=\"".$row["results"] ."\">View Voting Results</a></td></tr>" 
              ;
              }

              ?>
          </tbody>
      </table>
      </center>
    </p1>
  </body>
</html>
