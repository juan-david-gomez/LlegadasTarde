
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="iso-8859-1">
    <title></title>
</head>
<body>
     <?php


   $path ="ALUMNOS2013.xlsx" ;
  $array = array();

require 'PHPExcel-develop/classes/PHPExcel.php';
require_once 'PHPExcel-develop/classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load($path);
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
    $worksheetTitle     = $worksheet->getTitle();
    $highestRow         = $worksheet->getHighestRow(); // e.g. 14
    $highestColumn      = $worksheet->getHighestColumn(); // e.g 'm'
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
    $nrColumns = ord($highestColumn) - 64;
    echo '<table width="100%" cellpadding="3" cellspacing="0"><tr>';
     $con = mysql_connect("localhost","root","");

             mysql_select_db("colegio", $con);
              $fp = fopen("sql.txt","a");
    for ($row = 2; $row <= $highestRow; ++ $row)
     {

        echo '<tr>';
        for ($col = 1; $col < $highestColumnIndex ; ++ $col)
         {
           
            $cell = $worksheet->getCellByColumnAndRow($col, $row);
            $val = $cell->getCalculatedValue();

                
                $array[$col] = $val;


        }
               $query = "insert into estudiantes values (".$array[1].",'".$array[2]."','".$array[3]."','".$array[4]."',".$array[5].",'".$array[6]."')";
              echo "<br>";
            
           mysql_query($query,$con);
            fwrite($fp, $query.";");
           




        echo '</tr>';
    }

    echo '</table>';
     fclose($fp);  
}
?>

</body>
</html>
 