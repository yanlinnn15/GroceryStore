<?php include('partials/header.php');?>
<script type="text/javascript">

function confirmation()
{
    answer = confirm("Do you want to delete this product?");
    return answer;
}

</script>
        
        <div class="page-wrapper">
            
            <div class="container-fluid">
                
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Product - Low Stock</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Product - Low Stock</li>
                        </ol>
                    </div>
                </div>

                <?php 
                    $sql="SELECT * FROM product where pQty<=5 ";
                    $productPage=10;
                    if(isset($_GET['skeyword']) && !empty($_GET['skeyword'])){
                        $sql.=" AND (pName like '%".$_GET['skeyword']."%' or productID like '%".$_GET['skeyword']."%')";
                    }
                    if(isset($_GET['sort']) && !empty($_GET['sort'])){
                        switch($_GET['sort']){
                            case '1':
                                $sql.=" order by pQty ASC";
                                break;
                            case '2':
                                $sql.=" order by pQty DESC";
                                break;
                        }
                    }

                    $res=mysqli_query($conn,$sql); 
                    if($res){
                        $ttl=mysqli_num_rows($res);
                    }else{
                        $ttl=0;
                    }

                    $numPage = ceil($ttl/$productPage);

                    if(isset($_GET['page']) && is_numeric($_GET['page'])){
                        $page=$_GET['page'];
                    }else{
                        $page=1;
                    }

                    $starting_page_result=($page-1)*$productPage;

                    $sql7=$sql." LIMIT ".$starting_page_result.','.$productPage;

                    $res7=mysqli_query($conn,$sql7);
                    
                    ?>

                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Product - Low Stock</h4>

                                <div class="block">
                                    <form action="" method="post">
                                        <div class="wrap">
                                            <div class="search">
                                                <input type="text" class="searchTerm" placeholder="Name or ID..." name="skey" <?php if(isset($_GET['skeyword'])){ ?> value="<?php echo $_GET['skeyword'];?>" <?php }?>>
                                                <button input type="submit" class="searchButton" name="submitsearch">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                           
                                            </div>
                                        </div>
                                    </form>
                                    <div style="float: left;">
                                        <form action="" name="sort" onchange="submit_form()" id="sort" method="post">
                                            <select name="sort" id="" class="custom-select">
                                                <option value="" selected disabled hidden>Select Sort...</option>
                                                <option value="1" <?php if(isset($_GET['sort'])){ if($_GET['sort']==1){?> selected <?php }} ?>>Sort By Qty ASC</option>
                                                <option value="2" <?php if(isset($_GET['sort'])){ if($_GET['sort']==2){?> selected <?php }} ?>>Sort By Qty DESC</option>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                                
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
												<th>Image</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Price</th>
												<th>Quantity</th>
                                                <th>Discount(%)</th>
                                                <th>Status</th>
												<th>Action</th>
												
                                            </tr>
                                        </thead>
									
                                        <tbody>
										<?php
			
											$result= mysqli_query($conn, $sql7);	
											 while($row = mysqli_fetch_assoc($result))
											 {
												
										?>
                                            <tr>
                                                <td><?php echo $row['productID']?></td>
												<td>
                                                    <img width="80px;" src ="<?php echo $row['pImage1'];?>">
                                                   
                                                </td>
                                                <td><?php echo $row['pName']?></td>
                                                <td><?php 
                                                    $row2=mysqli_fetch_assoc(mysqli_query($conn,"SELECT categoryName from category,product where category.categoryID=product.categoryID and productID='".$row['productID']."'"));
                                                    echo $row2['categoryName'];
                                                ?></td>
                                                <td><?php echo $row['pPrice']?></td>
                                                <td><?php echo $row['pQty']?></td>
                                                <td><?php echo $row['discountPercent']?></td>
                                                <td><?php echo $row['productStatus']?></td>
												
												<td>

                                                    <button class="btn btn-success" data-toggle="modal" data-target="#reply<?php echo $row['productID']; ?>">Restock</button>	
													<a href="product.php?del&pid=<?php echo $row['productID']; ?>" onclick="return confirmation();" class="btn btn btn-danger delete_cat"><i class="fa fa-trash"></i></a></td>
                                            </tr>
                                             <!--Modal Reply -->
                                  <div class="modal fade" id="reply<?php echo $row['productID']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Restock <?php echo $row['pName']; ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                                <form method="post">
                                                <div class="form-group">
                                                    <label class="col-md-12">Quantity (Min 1 Max 5000)<?php echo $row['productID']; ?></label>
                                                    <div class="col-md-12">
                                                        <input type="number" max="5000" min="1" name="qty" class="form-row" class="form-control form-control-line" required>
                                                    </div>
                                                    <input type="hidden" name="rid" value="<?php echo $row['productID']; ?>">
                                                </div>                
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="submit">Restock</button>
                                        </div>
                                        </form>
                                        </div>
                                    </div>
                                    </div>
                                    <!-- End -->
                                     
											<?php
											}
											?>

                                                <?php 

                                                if(mysqli_num_rows($result)<=0){?>
                                                    <tr>
                                                        <td></td>
                                                        <td><strong>No result Found!<strong></td>
                                                    </tr>
                                                <?php $numPage=1; } ?>
                                                                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                

                <!-- Pagination -->
                <?php 
                $url="productlowstock.php?";
                
                if(isset($_GET['skeyword'])){
                    $url.="skeyword=".$_GET['skeyword']."&";
                }
                if(isset($_GET['sort'])){
                    $url.="sort=".$_GET['sort']."&";
                }

                ?>

                <div class="pagination">
                    <a href="<?php echo $url;?>page=<?php if(isset($_GET['page'])){$current=$_GET['page'];}else{$current=1;} if($current==1){echo 1; }else{echo $current=$current-1;}?>">&laquo;</a>
                    <?php
                    if(isset($_GET['page'])){$current=$_GET['page'];}else{$current=1;}
                    for($page=1;$page<=$numPage;$page++){ 
                        if($current==$page){?>
                            <a href="<?php echo $url;?>page=<?php echo $page;?>" class="active"><?php echo $page; ?></a>
                        <?php }else{ ?>
                            <a href="<?php echo $url;?>page=<?php echo $page;?>"><?php echo $page; ?></a>
                        <?php }} ?>
                    <a href="<?php echo $url;?>page=<?php if(isset($_GET['page'])){$current=$_GET['page'];}else{$current=1;} if($current==$numPage){echo $numPage; }else{echo $current=$current+1;} ?>">&raquo;</a>
                </div>
                <!--Pagination-->
            </div>
                    </div>
<?php 
    include('partials/footer.php');
    require('alert2.php');
?>
<?php

if (isset($_REQUEST["del"])) 
{
	$pid = $_REQUEST["pid"]; 
    
    //check pid link with product or not
    $res= mysqli_query($conn, "select * from orderdetail where productID = $pid");
    if(mysqli_num_rows($res)<=0){
        //brand have no link to product
        $res2=mysqli_query($conn, "delete from product where productID = $pid");
        if($res2){
            $_SESSION['success']="Delete Successful!";
        }else{
            $_SESSION['wrong']="Something Went Wrong!";
        }
    }else{
        $_SESSION['fail']="Sorry, this product cannot be deleted!";
    }

	header("Location: ". $_SERVER["HTTP_REFERER"]);
}


?>

<script>
    function submit_form(){
        var form = document.getElementById("sort");
        form.submit();
    }
</script>

<!-- search form -->
<?php
    if(isset($_POST['submitsearch'])){

        $keyw=$_POST['skey'];

        if(!empty(trim($keyw))){
            $keyw1=mysqli_real_escape_string($conn,$keyw);
            header("location:".SITEURL."admin/productlowstock.php?skeyword=".$keyw);
        }else{
            header("location:product.php");
        }
    }
?>

<!-- sort form -->
<?php
    if(isset($_POST['sort'])){

        $sort=$_POST['sort'];
        $url=SITEURL."admin/productlowstock.php?";

        if($_GET['skeyword']){
            $url.="skeyword=".$_GET['skeyword']."&";
        }

        header("location:".$url."sort=".$sort);
    }
?>

<?php
    if(isset($_POST['submit'])){
       
        $qty=$_POST['qty'];
        $id=$_POST['rid'];
        $res=mysqli_query($conn,"UPDATE product set pQty=pQty+$qty where productID=$id");
        if(mysqli_affected_rows($conn)==1){ ?>
            <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '<?php echo "Reply Successful"; ?>',
                showConfirmButton: false,
                timer: 1500
            });
            </script>
            
        <?php header("refresh:0.5");}else{
            $_SESSION['fail']="Something went wrong...";
        }
}
?>