<?php 
include('../config/connect.php');

if(isset($_GET['dltid'])){

$did=$_GET['dltid'];
$sql="DELETE from admin where adminID='$did' limit 1";
$res=mysqli_query($conn,$sql);

if($res){
    header("location:".SITEURL."admin/adminlist.php");
    $_SESSION['success']="Delete Successful";
}
}?>