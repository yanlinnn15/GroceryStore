<?php

include('../config/connect.php');

if(isset($_SESSION['user'])){

	$rescheck=mysqli_query($conn,"SELECT * from customer where cstatus=1 and cusID='".$_SESSION['user']."'");
	if(mysqli_num_rows($rescheck)!=1){
		unset($_SESSION['user']);
		$_SESSION['inactive']="Your account is inactive!";
		die(header("HTTP/1.0 404 Not Found"));
	}else{
		function delete($uid,$pid,$conn){
	
			/* check whether cus had added the certain product before */	
			$sql3="SELECT * FROM cart where cusID='$uid' and productID='$pid' limit 1";
			$res3=mysqli_query($conn,$sql3);
			if(mysqli_num_rows($res3)==1){ //if return 1
			$sql4="DELETE from cart where productID='$pid' and cusID='$uid'";
			$res4=mysqli_query($conn,$sql4);
			}
		
		}
	
		function add($uid,$pid,$conn,$updatetime,$pqty,$qty){
			
			/* check whether cus had added the certain product before */	
			$sql2="SELECT * FROM cart where cusID='$uid' and productID='$pid' limit 1";
			$res2=mysqli_query($conn,$sql2);
			if(mysqli_num_rows($res2)==1){ //if return 1
				$row2=mysqli_fetch_assoc($res2); 
				$cqty=$row2['qty']; //get current quantity added to the cart
				$aqty=$row2['qty'];
				$cqty += $qty; 
				if($pqty>=$cqty){ //if stock enough, then update new quantity
					$sql3="UPDATE cart set qty='$cqty', updateTime='$updatetime' where cusID='$uid' and productID='$pid'";
					$res3=mysqli_query($conn,$sql3);
				}else{ 
					//$sql3="UPDATE cart set qty='$pqty', updateTime='$updatetime' where cusID='$uid' and productID='$pid'";
					//$res3=mysqli_query($conn,$sql3);
					$data = $aqty;
					echo $data;
					
				}
				
			}else{
				if($pqty>=$qty){
					//if the product doesn't exist in the cart, insert itttt
					$sql4="INSERT INTO cart (qty, cusID, productID) values 
					($qty,$uid,$pid);
					";
					$res4=mysqli_query($conn,$sql4);
				}else{
					$data = 0;
					echo $data;
					/*if($pqty!=0){
						$sql4="INSERT INTO cart (qty, cusID, productID) values 
						($pqty,$uid,$pid);
						";
						$res4=mysqli_query($conn,$sql4);
					}*/
				}
			}
		}
	
		function update($uid,$pid,$conn,$updatetime,$qty){
			$sql5="UPDATE cart set qty='$qty', updateTime='$updatetime' where cusID='$uid' and productID='$pid'";
			$res5=mysqli_query($conn,$sql5);	
		}
	
		if(isset($_POST["action"])){
			//get data
			$uid=$_SESSION['user'];
			$pid = $_POST["productID"];
			$updatetime=date('Y-m-d');
			$qty=$_POST["productQuantity"];
	
			//check current stock
			$sql5="SELECT pqty from product where productID='$pid'";
			$res5=mysqli_query($conn,$sql5);
			$row=mysqli_fetch_assoc($res5);
			$pqty=$row['pqty'];
			switch($_POST['action']){
				case 'add':
					add($uid,$pid,$conn,$updatetime,$pqty,$qty);
					break;
				case 'delete':
					delete($uid,$pid,$conn);
					break;
				case 'update':
					update($uid,$pid,$conn,$updatetime,$qty);
	
			}
				
		}

	}
	
}else{
	die(header("HTTP/1.0 404 Not Found")); //throw error
}

?>