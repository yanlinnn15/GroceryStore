<?php include('partials/header.php');?>

<!-- Page of Product Review List -->
<div class="page-wrapper">
<div class="container-fluid">
    
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Product Review List</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active"> <a href="reviewproduct.php">Product Review List</a></li>
            </ol>
        </div>
        
    </div>

    <?php 
        $sql="SELECT * FROM product,review where product.productID=review.productID ";
        $productPage=10;
        if(isset($_GET['skeyword']) && !empty($_GET['skeyword'])){
            $sql.=" AND (pName like '%".$_GET['skeyword']."%' or product.productID like '%".$_GET['skeyword']."%')";
        }
        $sql.=" group by product.productID ";
        if(isset($_GET['sort']) && !empty($_GET['sort'])){
            switch($_GET['sort']){
                case '1':
                    $sql.=" order by avg(rating) desc ";
                    break;
                case '2':
                    $sql.=" order by avg(rating) asc";
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
                    <h4 class="card-title">Product Review List</h4>

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
                                    <option value="1" <?php if(isset($_GET['sort'])){ if($_GET['sort']==1){?> selected <?php }} ?>>Sort By Top Rated</option>
                                    <option value="2" <?php if(isset($_GET['sort'])){ if($_GET['sort']==2){?> selected <?php }} ?>>Sort By Low Rated</option>
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
                                    <th>Rating(s)</th>
                                    <th>Total Review(s)</th>
                                    <th>Total Reply(s)</th>
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
                                    <?php
                                            $resrw=mysqli_query($conn,"select ROUND(avg(rating),2) as 'rate',count(*) as 'ttl', reviewID from review where productID='".$row['productID']."'");
                                            if(mysqli_num_rows($resrw)>0){
                                                $rowrw=mysqli_fetch_assoc($resrw);
                                                if($rowrw['ttl']>0){ ?>
                                                    <td><?php echo $rowrw['rate']; ?></td>
                                                    <td><?php echo $rowrw['ttl']; ?></td>
                                                    <td><?php
                                                            $resrw1=mysqli_query($conn,"select count(*) as 'ttl1' from review,product where product.productID=review.productID and product.productID='".$row['productID']."' and reply!=' ' ");
                                                            if(mysqli_num_rows($resrw1)>0){
                                                                $rowrw1=mysqli_fetch_assoc($resrw1);
                                                                echo $rowrw1['ttl1'];
                                                            }else{
                                                                echo "0";
                                                            }
                                                            

                                                    ?></td>
                                                    
                                                <?php }else{ ?>
                                                <td>No rating</td>
                                                <td>0</td>
                                                <td>0</td>

                                            

                                            <?php } }?>
                                    
                                        <td>
                                        <a href="viewreview.php?pid=<?php echo $row["productID"]?>"><button class="btn btn btn-primary check_out" type="button"><i class="fa fa-eye"></i></button></a>		
                                        </td>
                                    
                                        
                                </tr>
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
    $url="reviewproduct.php?";
    
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
            header("location:".SITEURL."admin/reviewproduct.php?skeyword=".$keyw);
        }else{
            header("location:reviewproduct.php");
        }
    }
?>

<!-- sort form -->
<?php
    if(isset($_POST['sort'])){

        $sort=$_POST['sort'];
        $url=SITEURL."admin/reviewproduct.php?";

        if($_GET['skeyword']){
            $url.="skeyword=".$_GET['skeyword']."&";
        }

        header("location:".$url."sort=".$sort);
    }
?>
