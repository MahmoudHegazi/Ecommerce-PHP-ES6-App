<?php
include "config.php";
// Create connection
$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}

require('inc/xlsxwriter.class.php');

function generate_excel($data_array, $rowhead, $dir){





$downloadpath = dirname('../excel_sheets/'. $dir) . '/';

echo $downloadpath;

 // handle downloaded excel file name dyanmic rename with dynamic id
 function dynamic_id(){
    $finame= $downloadpath . $dir . '/sheet_id';
    $extension = '.xlsx';
    $file_name = explode("id",$finame)[0] . uniqid() . $extension;
    return $file_name;
  }


$fname = $downloadpath . $dir . '/sheet_id' . uniqid() . '.xlsx';
$counter = 1;
// check if the excel sheet exists
while (file_exists($fname)){
   $fname = dynamic_id($fname);
   $counter += 1;
   if ($counter > 50) {
     $fname = $downloadpath . $dir . '/uniquesheet_id' . uniqid() . '.xlsx';
     break;
   }
}




$header1 = $rowhead;
// $data1 = [ ['2021-04-20', 1, 27, '44.00', 'twig'],
//           ['2021-04-21', 1, '=C1', '-44.00', 'refund'] ]; excel_sheets
$data1 = $data_array;
$data2 = [ ['2','7','ᑌᑎIᑕᗝᗪᗴ ☋†Ϝ-➑'],
           ['4','8','😁'] ];
// $styles2 = array( ['font-size'=>6],['font-size'=>8],['font-size'=>10],['font-size'=>16] );

$writer = new XLSXWriter();
$writer->setAuthor('Your Name Here');
$writer->writeSheet($data1,'MySheet1', $header1);  // with headers
//$writer->writeSheet($data2,'MySheet2');            // no headers
//$writer->writeSheetRow('MySheet2', $rowdata = array(300,234,456,789), $styles2 );

try {
    $writer->writeToFile($fname);
    echo "Downloaded Excel Sheet: $fname (" . filesize($fname)  . " bytes)<br>";
    return true;
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
   // creates XLSX file (in current folder)


// ...or instead of creating the XLSX you can just trigger a 😁 =C1
// download by replacing the last 2 lines with:

// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// header('Content-Disposition: attachment;filename="'.$fname.'"');
// header('Cache-Control: max-age=0');
// $writer->writeToStdOut();
}
