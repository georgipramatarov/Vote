<?php
ob_start();
    
    //Function to remove all files from a directory.
    function emptyDir($dir) {
        if (is_dir($dir)) {
            $scn = scandir($dir);
            foreach ($scn as $files) {
                if ($files !== '.') {
                    if ($files !== '..') {
                        if (!is_dir($dir . '/' . $files)) {
                            unlink($dir . '/' . $files);
                        } else {
                            emptyDir($dir . '/' . $files);
                            rmdir($dir . '/' . $files);
                        }
                    }
                }
            }
        }
    }

    function createCard($row, $election){
 
        $pdf_name = "pollingcards/" . $row['nino'] . ".pdf"; // where to save the files
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
        $pdf->Output($pdf_name,'F');
    }


    require('pdf/fpdf.php');


    $count= 101;
    if (isset($_GET['count'])){ $count = $_GET['count']; }
    if ($count > 100) { $count = 100; }

    //clean previous directory
    if (file_exists('pollingcards/')) {
        emptyDir('pollingcards');
    }else{
        mkdir('pollingcards', 0777, true); //make dir
    }
    

    //Get data
	$connection = mysqli_connect("csmysql.cs.cf.ac.uk","group8.2016","dafEvUth5","group8_2016") or die ("DB connection failed 1");
	$query = "SELECT * FROM electoral_roll";
	$result = mysqli_query($connection,$query);

    $elections = DB::table('elections')->where([
          ['close_date', '>', Carbon\Carbon::now()],
          ['start_date', '<=', Carbon\Carbon::now()]]);
    $election = $elections->orderBy('start_date')->first();


    if (isset($_GET['limit']) and isset($_GET['count'])){
        $i = 0;

        while(($i < $count) and ($row = mysqli_fetch_assoc($result))){
            $i++;
            createCard($row, $election);
        }
    }else{
        while ($row = mysqli_fetch_assoc($result))
            createCard($row, $election);
    }


    
    //
    // Polling cards generated
    //

    if (isset($_GET['zip']) and $_GET['zip'] == '1'){  
        //Create Zip archive of pollingcards folder and download
        $zip =  new ZipArchive();
        $zip->open('pollingcards.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $rootPath = realpath('pollingcards');
    
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($rootPath),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);

                $zip->addFile($filePath, $relativePath);
            }
        }

        $zip->close();

        $file_url = 'pollingcards.zip';
        header("Content-type: application/zip"); 
        header("Content-Disposition: attachment; filename=pollingcards.zip");
        header("Content-length: " . filesize($file_url));
        header("Pragma: no-cache"); 
        header("Expires: 0"); 
        readfile($file_url);
    }else{
        //checkout
        session_start();
        $_SESSION['cardsCreated'] = 1;
        session_write_close();
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }

    exit();

?>