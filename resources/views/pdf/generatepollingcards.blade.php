<?php
		
	function genVoteCode($nino){
        //TODO
		return "VOTECODE HERE.";
	}

    function createCard($row){
        $pdf_name = "pollingcards/" . $row['National Insurance Number'] . ".pdf"; // where to save the files
        $pdf= new FPDF('L', 'mm', 'A5');
        
        //setup PDF
        $pdf->AddPage('L'); 
        $pdf->SetTitle('Polling Card');
        $pdf->SetFont('Helvetica','B',14);
        $pdf->SetTextColor(0,0,0);
        
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        
        $addr = $row['first_name'] . " " . $row['last_name'] . "\n" . $row['address'] . ",\n" . $row['city'] . ",\n" . $row['county']  . ",\n"   . $row['post_code'];
    
        //gen votecode
        $votecode = genVoteCode($row['National Insurance Number']) . "\n\n\n";
        
        
        //Address
        $pdf->MultiCell(70,6, $addr, 1, 'L', false);    
        
        //Vote verification code
        $pdf->SetXY($x + 90, $y);
        $pdf->MultiCell(90,6, $votecode ,1,'L',false);
        
        $pdf->Ln();
        $pdf->SetXY($x, $y+60);
        
        //Extra info:
        
        $voteinfo = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna    aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute   irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat  non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
        
        $pdf->MultiCell(90,8, "How to Vote:",0,'L');
        $pdf->SetFont('Helvetica','B',8); // reduce font size
        $pdf->MultiCell(180,8, $voteinfo ,0,'L',false);
    
        //Output to dir
        $pdf->Output($pdf_name,'F');
    }


    $count= 101;

    if (isset($_GET['count'])){ $count = $_GET['count']; }
    if ($count > 100) { $count = 100; }

    require('pdf/fpdf.php');

    if (!file_exists('pollingcards/')) {
        mkdir('pollingcards', 0777, true);
    }

	$connection = mysqli_connect("csmysql.cs.cf.ac.uk","group8.2016","dafEvUth5","group8_2016") or die ("DB connection failed 1");
	$query = "SELECT * FROM electoral_roll";
	$result = mysqli_query($connection,$query);


    if (isset($_GET['limit']) and isset($_GET['count'])){
        $i = 0;

        while(($i < $count) and ($row = mysqli_fetch_assoc($result))){
            $i++;
            createCard($row);
        }
    }else{
        while ($row = mysqli_fetch_assoc($result))
            createCard($row);
    }
    
    echo "Done.";

header('Location: ' . $_SERVER['HTTP_REFERER']);

//TODO zip
?>

