
 <?php

//CREATED BY: Monika Gautam
//E-MAIL: monika315gtm@gmail.com

require('fpdf.php');
//Connecting to the database
 $dbhandle = mysqli_connect("localhost", "root", "mysql","cabBills")
       or die("Unable to connect to MySQL");


                     $brdtm1 = $_POST['brdtm1'];
                     $brdtm2 = $_POST['brdtm2'];
                    $amt1 = $_POST['amt1'];
                     $amt2 = $_POST['amt2'];

                      $rate1 = $_POST['rate1'];
                     $rate2 = $_POST['rate2'];

                     $dateval = $_POST['dateval'];



                      $sql1="insert into collectdata values('".$dateval."','".$brdtm1."',".$amt1.",".$rate1.")";
                    // echo $sql;
                                                   mysqli_query($dbhandle,$sql1);
                     $sql2="insert into collectdata values('".$dateval."','".$brdtm2."',".$amt2.",".$rate2.")";
                                                   mysqli_query($dbhandle,$sql2);






 $sql3="select * from employee";

           $sql4="select * from collectdata";

           $result1 =mysqli_query($dbhandle,$sql3);
		   $number_of_rows1 = mysqli_num_rows($result1);
           while ($row1 = mysqli_fetch_array($result1,MYSQLI_NUM))
                                {

                                   $name=$row1{0};

                                   $acc=$row1{1};
                                   $manager=$row1{2};
                                   $exp=$row1{3};
                                   $pmtdt=$row1{4};
           }

		   //Initialize the 9 columns and the total
$column_itemno = "";
$column_date = "";
$column_desc = "";
$column_code = "";
$column_curr = "";
$column_amt = "";
$column_rate = "";
$column_amtAED = "";
//$column_sdt = "";

      $result2=mysqli_query($dbhandle,$sql4);
	  $number_of_rows2 = mysqli_num_rows($result2);
           $item=1;
           $aed=0;
		   $total=0;
		   $pos=0;
//For each row, add the field to the corresponding column
while($row = mysqli_fetch_array($result2,MYSQLI_NUM))
{
    $dbdate=$row{0};

    $dbbrdtm=$row{1};
    $dbamt=$row{2};
    $dbrate=$row{3};

	   if(strcmp($dbbrdtm,"Morning")==0)
		   $cabstr="Cab Pickup Charges";
	    else
			$cabstr="Cab Drop Charges";
	$column_itemno = $column_itemno.$item."\n";
    $column_date = $column_date.$dbdate."\n";
    $column_desc = $column_desc.$cabstr." - ".$dbbrdtm."\n";
    $column_code = $column_code."--- "."\n";
    $column_curr = $column_curr." INR "."\n";
    $column_amt = $column_amt.$dbamt.".00"."\n";
    $column_rate = $column_rate.$dbrate.".00"."\n";

	$aed=  floatval($dbamt)*floatval($dbrate);
	$total=$total+$aed;
    $column_amtAED = $column_amtAED.$aed.".00"."\n";



    $item=$item+1;
}
       $del1="delete from employee";
        mysqli_query($dbhandle,$del1);
		$del2="delete from collectdata";
        mysqli_query($dbhandle,$del2);
 mysqli_close($dbhandle);





//Create a new PDF file
$pdf=new FPDF();
$pdf->AddPage();

$pdf->SetFont('times','B',18);
$pdf->SetY(22);

$pdf->SetTextColor(165,42,42);
$pdf->Cell(0,16,'BUSINESS EXPENSE REPORT',0,0,'C');

$pdf->SetTextColor(255,0,0);
$pdf->SetY(42);
$pdf->SetX(11);

$pdf->SetFont('Times','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(0, 4, "Employee Name:",0,0, 'L');

$pdf->SetX(43);
$pdf->SetTextColor(0,0,255);
$pdf->Cell(0,4, $name, 0,0,'L');
$pdf->SetX(109);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(0,4,'Claim Submission Date:',0,0,'L');
$pdf->SetX(150);
$pdf->SetTextColor(0,0,255);
$pdf->Cell(0,4, $pmtdt, 0,0,'L');

$pdf->SetY(48);
$pdf->SetX(11);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(0,4,"Payment:", 0,0,'L');
$pdf->SetX(43);
$pdf->SetTextColor(0,0,255);
$pdf->Cell(0,4, "Transportation", 0,0,'L');
$pdf->SetX(109);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(0,4,'Manager:',0,0,'L');
$pdf->SetX(150);
$pdf->SetTextColor(0,0,255);
$pdf->Cell(0,4, $manager, 0,0,'L');

$pdf->SetY(54);
$pdf->SetX(11);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(0,4,"Expenses Nature:", 0,0,'L');
$pdf->SetX(43);
$pdf->SetTextColor(0,0,255);
$pdf->Cell(0,4, "Cab Charges - ".$exp, 0,0,'L');
$pdf->SetX(109);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(0,4,'Bank Account Number:',0,0,'L');
$pdf->SetX(150);
$pdf->SetTextColor(0,0,255);
$pdf->Cell(0,4, $acc, 0,0,'L');

$pdf->SetY(60);
$pdf->SetX(11);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(0,4,"Expenses Total:", 0,0,'L');
$pdf->SetX(43);
$pdf->SetTextColor(0,0,255);
$pdf->Cell(0,4, "Rs ".$total.".00", 0,0,'L');
$pdf->SetX(109);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(0,4,'Finance:',0,0,'L');
$pdf->SetX(150);
$pdf->SetTextColor(0,0,255);
$pdf->Cell(0,4, "---", 0,0,'L');





$pdf->SetTextColor(0,0,0);
//Fields Name position
$Y_Fields_Name_position = 75;
//Table position, under Fields Name
$Y_Table_Position = 81;
//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(232,232,232);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',8);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5);
$pdf->Cell(8,6,'Item',1,0,'C',1);
$pdf->SetX(13);
$pdf->Cell(25,6,'Date',1,0,'C',1);
$pdf->SetX(38);
$pdf->Cell(65,6,'Description',1,0,'C',1);

$pdf->SetX(103);
$pdf->Cell(15,6,'Item Code',1,0,'C',1);
$pdf->SetX(118);
$pdf->Cell(10,6,'Curr.',1,0,'C',1);
$pdf->SetX(128);
$pdf->Cell(35,6,'Amount',1,0,'C',1);
$pdf->SetX(163);
$pdf->Cell(8,6,"Rate",1,0,'C',1);
$pdf->SetX(171);
$pdf->Cell(35,6,"Amount AED",1,0,'C',1);
$pdf->Ln();
//Now show the 3 columns
$pdf->SetFillColor(255,255,255);

$pdf->SetFont('Arial','',8);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(5);
$pdf->MultiCell(8,6,$column_itemno,1,'C');
$pdf->SetY($Y_Table_Position);
$pdf->SetX(13);
$pdf->MultiCell(25,6,$column_date,1,'C');
$pdf->SetY($Y_Table_Position);
$pdf->SetX(38);
$pdf->MultiCell(65,6,$column_desc,1,'C');
$pdf->SetY($Y_Table_Position);

$pdf->SetX(103);
$pdf->MultiCell(15,6,$column_code,1,'C');
$pdf->SetY($Y_Table_Position);
$pdf->SetX(118);
$pdf->MultiCell(10,6,$column_curr,1,'C');
$pdf->SetY($Y_Table_Position);
$pdf->SetX(128);
$pdf->MultiCell(35,6,$column_amt,1,'C');
$pdf->SetY($Y_Table_Position);
$pdf->SetX(163);
$pdf->MultiCell(8,6,$column_rate,1,'C');
$pdf->SetY($Y_Table_Position);
$pdf->SetX(171);
$pdf->MultiCell(35,6,$column_amtAED,1,'C');


//Creating lines (boxes) for each ROW (Product)
//If we don't use the following code, you don't create the lines separating each row
$j = 0;
$pdf->SetY($Y_Table_Position);
while ($j < $number_of_rows2)
{
    $pdf->SetX(5);
    $pdf->MultiCell(201,6,'',1);
    $j = $j +1;
}


$pdf->SetX(157);
$pdf->SetFont('Arial','B',10);


$pdf->Cell(0,6,"TOTAL = ". $total.".00", 0,0,'C');
$pdf->SetFont('Times','B',10);
$pdf->SetY(260);
$pdf->SetX(140);

$pdf->Cell(50,6,'['.$name.']',0,0,'C');
$pdf->Output($name.'-'.$pmtdt.'_Expense Claim-Cab Charges.pdf','D');
?>
