<?php
    require('pdf/fpdf.php');
    $nino = $_GET['nino'] or abort(401, 'Error');


    function createCard($row, $election){
    
        $pdf_name = $row['nino'] . ".pdf"; // filename
        $pdf= new FPDF('L', 'mm', 'A5');
        
        //setup PDF
        $pdf->AddPage('L'); 
        $pdf->SetTitle('Polling Card');
        $pdf->SetFont('Helvetica','',14);
        $pdf->SetTextColor(0,0,0);
        
        //Pointers
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        

        //Prepared Text:
        $votewarn = "Please keep this card safe. You will not be able to vote without your Voting Authentication Code.";
        $voteinfo = "To vote you will need to go to www.voteurl.com before the voting deadline. You will be asked for this code when you cast your ballot.";
        $votedeadline = "Voting Deadline: " . $election->close_date . " 11:59pm";
        //$elecname = "Election: " . $election->name;
        $address = $row['first_name'] . " " . $row['last_name'] . "\n" . $row['address'] . ",\n" . $row['city'] . ",\n" . $row['county']  . ",\n"   . $row['post_code'];
        $votecode = $row['vac'];

        
        
        //Address
        $pdf->SetFillColor(0, 0 , 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(90,10,'Your Details:',0,1,'L',1);
        $pdf->SetTextColor(0,0,0);
        $pdf->MultiCell(90,6, $address, 1, 'L', false);    
        
        //Vote verification code
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(90,10,'Your Voting Authentication Code:',0,1,'L',1);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('courier', 'B'); //for readibility
        $pdf->Cell(90,10,$votecode,1,'L',0);
        $pdf->SetFont('Helvetica','',14); //set font back

        //Postage
        $pdf->SetXY($x + 130, $y);
        $pdf->Cell(60,30,"POSTAGE STAMP",1,0, 'C',0);

        //election
        $pdf->SetXY($x, $y+70);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(190,10,'How to Vote:',0,1,'L',1);

        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Helvetica','','8');
        $pdf->MultiCell(190,10,"$votedeadline \n" . $votewarn . "\n" . $voteinfo, 1, 'L', false);

        //Output to dir
        $pdf->Output($pdf_name,'D');
    }
    

    //Get data
    $connection = mysqli_connect("csmysql.cs.cf.ac.uk","group8.2016","dafEvUth5","group8_2016") or die ("DB connection failed 1");
    $query = "SELECT * FROM electoral_roll WHERE nino='$nino'";
    $result = mysqli_query($connection,$query);

    $elections = DB::table('elections')->where([
          ['close_date', '>', Carbon\Carbon::now()],
          ['start_date', '<=', Carbon\Carbon::now()]]);

    $election = $elections->orderBy('start_date')->first();

    $voter = mysqli_fetch_array($result);

    if ($voter){
        createCard($voter, $election);
    }else{
        $_SESSION['cardError'] = 1;
        session_write_close();
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }



    exit();

?>