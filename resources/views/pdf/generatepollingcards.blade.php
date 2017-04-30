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

    function createCard($row){
        //Extra info:
        $votewarn = "PLEASE KEEP THIS CARD SAFE.\nDO NOT SHOW THIS CARD TO ANYONE.";
        $voteinfo = "To vote you will need to go to www.voteurl.com before the voting deadline  You will be asked for this code when you cast your ballot.";


        $pdf_name = "pollingcards/" . $row['National Insurance Number'] . ".pdf"; // where to save the files
        $pdf= new FPDF('L', 'mm', 'A5');
        
        //setup PDF
        $pdf->AddPage('L'); 
        $pdf->SetTitle('Polling Card');
        $pdf->SetFont('Helvetica','',14);
        $pdf->SetTextColor(0,0,0);
        
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        
        $addr = $row['first_name'] . " " . $row['last_name'] . "\n" . $row['address'] . ",\n" . $row['city'] . ",\n" . $row['county']  . ",\n"   . $row['post_code'];
    
        //gen votecode
        $votecode = $row['vac'];
        
        
        //Address
        $pdf->MultiCell(70,6, $addr, 1, 'L', false);    
        
        //Vote verification code
        $pdf->SetXY($x + 90, $y);
        $pdf->MultiCell(90,6, $votecode ,1,'L',false);
        
        $pdf->Ln();
        $pdf->SetXY($x, $y+60);
        
        
        
        $pdf->SetXY($x+90, $y+40);
        $pdf->MultiCell(100,6, $votewarn,1,'L',false);

        $pdf->MultiCell(90,8, "How to Vote:",0,'L');
        $pdf->SetFont('Helvetica','B',8); // reduce font size
        $pdf->MultiCell(180,8, $voteinfo ,0,'L',false);
    
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