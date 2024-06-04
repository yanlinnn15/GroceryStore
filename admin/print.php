<?php
    include('../config/connect.php');

    require('fpdf/fpdf.php');

    class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Logo
        $this->Image('assets/images/head.png',7,6,70);

        // Arial bold 15
        $this->SetFont('Arial','B',15);

        // Move to the right
        $this->Cell(80);

        // Line break
        $this->Ln(12);

    }
}


    if(isset($_GET['id'])){

        $arr=explode(",",$_GET['id']);
        $pdf = new PDF('P','mm','A4');
        foreach($arr as $oid){

            $pdf->AddPage();
            $query=mysqli_query($conn,"SELECT * FROM orderp inner join timeslot on orderp.timeslot=timeslot.timeSlot 
            inner join payment on payment.orderID=orderp.orderID inner join paymentmethod on
            payment.pmID=paymentmethod.pmID inner join customer on customer.cusID=orderp.cusID 
            where orderp.orderID=$oid");

            $row=mysqli_fetch_array($query);

            //set font to arial, bold, 14pt
            $pdf->SetFont('Arial','B',14);

            //Cell(width , height , text , border , end line , [align] )
            $pdf->Cell(130	,5,'Fresh Grocers',0,0);
            $pdf->Cell(59	,5,'Order',0,1);//end of line

            //set font to arial, regular, 12pt
            $pdf->SetFont('Arial','',12);

            $date = explode(" ", $row['orderDate']);
            $pdf->Cell(130	,5,'50, Jalan Kemunting, Taman Kebun Teh,',0,0);
            $pdf->Cell(59	,5,"",0,1);//end of line

            $pdf->Cell(130	,5,'80250 Johor Bahru, Johor.',0,0);
            $pdf->Cell(25	,5,'Date',0,0);
            $pdf->Cell(34	,5,$date[0],0,1);//end of line

            $pdf->Cell(130	,5,'Phone: +60-16 612 2132',0,0);
            $pdf->Cell(25	,5,'Order ',0,0);
            $pdf->Cell(34	,5,"#".$row['orderID'],0,1);//end of line

            $pdf->Cell(130	,5,'Email: ffreshgrocers@gamil.com',0,0);
            $pdf->Cell(25	,5,'Customer ID',0,0);
            $pdf->Cell(34	,5,$row['cusID'],0,1);//end of line

            $pdf->Cell(130	,5,'',0,0);
            $pdf->Cell(25	,5,'Payment',0,0);
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(90	,5,$row['pmName'],0,1);

            //make a dummy empty cell as a vertical spacer
            $pdf->Cell(189	,10,'',0,1);//end of line

            //billing address
            $pdf->Cell(100	,5,'Deliver to',0,1);//end of line

            $pdf->SetFont('Arial','',12);
            //add dummy cell at beginning of each line for indentation
            $pdf->Cell(10	,5,'',0,0);
            $pdf->Cell(120	,5,$row['receiverName'],0,0);
            
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(10	,5,'Delivery Date & Time',0,1);
            $pdf->SetFont('Arial','',12);
            $pdf->Cell(10	,5,'',0,0);
            $pdf->Cell(120	,5,$row['receiverPhoneNo'],0,0);
            $pdf->Cell(10	,5,$row['shipDate']." ".$row['timeRange'],0,1);

        
            $pdf->Cell(10	,5,'',0,0);
            $pdf->Cell(90	,5,$row['street'],0,1);

            $pdf->Cell(10	,5,'',0,0);
            $pdf->Cell(90	,5,$row['postcode']." ".$row['city'].",",0,1);

            $pdf->Cell(10	,5,'',0,0);
            $pdf->Cell(90	,5,$row['state'].".",0,1);
            $pdf->Cell(189	,10,'',0,1);//end of line

            //make a dummy empty cell as a vertical spacer


            //Cell(width , height , text , border , end line , [align] )
            $pdf->Cell(189	,10,'',0,1);//end of line
            $pdf->SetFont('Arial','B',12);

            $pdf->Cell(70	,5,'Name',1,0);
            $pdf->Cell(12	,5,'Qty',1,0);
            $pdf->Cell(21	,5,'Price',1,0);
            $pdf->Cell(21	,5,'Disocunt',1,0);
            $pdf->Cell(40	,5,'Discounted Price',1,0);
            $pdf->Cell(25	,5,'Amount',1,1);
            //end of line

            $pdf->SetFont('Arial','',12);

            //Numbers are right-aligned so we give 'R' after new line parameter

            //items
            $query=mysqli_query($conn,"select * from orderdetail,product where orderdetail.productID=product.productID and orderID=$oid");
            $tax=$amount=0;
            while($item=mysqli_fetch_array($query)){
                $pdf->Cell(70	,5,$item['pName'],1,0);
                $pdf->Cell(12	,5,$item['qty'],1,0);
                $pdf->Cell(21	,5,"RM ".number_format($item['price_used'],2),1,0);
                $pdf->Cell(21	,5,$item['discount']."%",1,0);
                $pdf->Cell(40	,5,"RM ".number_format($item['oDPrice'],2),1,0);
                $pdf->Cell(25	,5,"RM ".number_format($item['oDttl'],2),1,1,'R');
                
            }

            //summary
            $pdf->Cell(125	,5,'',0,0);
            $pdf->Cell(30	,5,'Subtotal',0,0);
            $pdf->Cell(9	,5,'RM',1,0);
            $pdf->Cell(25	,5,number_format($row['ttlorder'],2),1,1,'R');//end of line

            $pdf->Cell(125	,5,'',0,0);
            $pdf->Cell(30	,5,'Shipping Fee',0,0);
            $pdf->Cell(9	,5,'RM',1,0);
            $pdf->Cell(25	,5,number_format($row['shipping_fee'],2),1,1,'R');//end of line


            $pdf->Cell(125	,5,'',0,0);
            $pdf->Cell(30	,5,'Total',0,0);
            $pdf->Cell(9	,5,'RM',1,0);
            $pdf->Cell(25	,5,number_format($row['totalPrice'],2),1,1,'R');//end of line

            //make a dummy empty cell as a vertical spacer
            $pdf->Cell(189	,10,'',0,1);//end of line

        }
        $pdf->Output();
    }else{
        echo "error";
    }
   
?>
