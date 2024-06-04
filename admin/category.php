<?php include('partials/header.php');?>
<script type="text/javascript">

    function confirmation()
    {
        answer = confirm("Do you want to delete this category?");
        return answer;
    }

</script>

        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Category</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Category</li>
                        </ol>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <a href="addcategory.php"><button type="button" class="btn btn-primary" style="float:right;">
						Add category </button></a>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
				<?php 
                    $sql="SELECT * FROM category where categoryID!='' ";
                    $categoryPage=10;
                    if(isset($_GET['skeyword']) && !empty($_GET['skeyword'])){
                        $sql.=" AND categoryName like '%".$_GET['skeyword']."%'";
                    }
                    if(isset($_GET['sort']) && !empty($_GET['sort'])){
                        switch($_GET['sort']){
                            case '1':
                                $sql.=" order by categoryName ASC";
                                break;
                            case '2':
                                $sql.=" order by categoryName DESC";
                                break;
                        }
                    }

                    $res=mysqli_query($conn,$sql); 
                    if($res){
                        $ttl=mysqli_num_rows($res);
                    }else{
                        $ttl=0;
                    }

                    $numPage = ceil($ttl/$categoryPage);

                    if(isset($_GET['page']) && is_numeric($_GET['page'])){
                        $page=$_GET['page'];
                    }else{
                        $page=1;
                    }

                    $starting_page_result=($page-1)*$categoryPage;

                    $sql7=$sql." LIMIT ".$starting_page_result.','.$categoryPage;

                    $res7=mysqli_query($conn,$sql7);
                    
                    ?>
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="block">
                                    <form action="" method="post">
                                        <div class="wrap">
                                            <div class="search">
                                                <input type="text" class="searchTerm" placeholder="Search category..." name="skey" <?php if(isset($_GET['skeyword'])){ ?> value="<?php echo $_GET['skeyword'];?>" <?php }?>>
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
                                                <option value="1" <?php if(isset($_GET['sort'])){ if($_GET['sort']==1){?> selected <?php }} ?>>Sort By Name ASC</option>
                                                <option value="2" <?php if(isset($_GET['sort'])){ if($_GET['sort']==2){?> selected <?php }} ?>>Sort By Name DESC</option>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                                
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Category ID</th>
                                                <th>Category Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
			
                                            $c=0;
											while($row = mysqli_fetch_assoc($res7))
											{	
										?>
                                            <tr>
                                                <td><?php echo $row['categoryID']?></td>
                                                <td><?php echo $row['categoryName']?></td>
                                                <td>
													<a href="editcategory.php?id=<?php echo $row['categoryID']?>"> <button class="btn btn btn-primary check_out" type="button"><i class="fa fa-pencil"></i></button></a>				
													<a href="category.php?del&bid=<?php echo $row['categoryID']; ?>" onclick="return confirmation();" class="btn btn btn-danger delete_cat"><i class="fa fa-trash"></i></a></td>
                                            </tr>
                                            <?php
											}
											?>

                                            <?php 

                                                if(mysqli_num_rows($res7)<=0){?>
                                                    <tr>
                                                        <td></td>
                                                        <td><strong>No result Found!<strong></td>
                                                    </tr>
                                                <?php 
                                                    if(mysqli_num_rows(mysqli_query($conn,"SELECT * from category"))<=0){
                                                        $numPage=1;
                                                    }
                                                
                                                } 
                                                
                                                ?>
                                           
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Pagination -->
                                <?php 
                                $url="category.php?";
                                
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
                
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->

<?php 
include('partials/footer.php');
include('alert2.php');
?>
<?php

if (isset($_REQUEST["del"])) 
{
	$categoryid = $_REQUEST["bid"];
    //check product link to category or not
    $res=mysqli_query($conn,"SELECT * FROM product WHERE categoryID='$categoryid'");
    if(mysqli_num_rows($res)<=0){
        //no linking
        $res1=mysqli_query($conn, "delete from category where categoryID = $categoryid");
        if($res1){
            $_SESSION['success']="Deleted Successful!";
        }
    }else{
        $_SESSION['fail']="This category cannot be deleted!";
    }
	
	header("Location: " . $_SERVER["HTTP_REFERER"]);
}
?>

<!-- submit sort form when onchange -->
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
            header("location:".SITEURL."admin/category.php?skeyword=".$keyw);
        }else{
            header("location:category.php");
        }
    }
?>

<!-- sort form -->
<?php
    if(isset($_POST['sort'])){

        $sort=$_POST['sort'];
        $url=SITEURL."admin/category.php?";

        if($_GET['skeyword']){
            $url.="skeyword=".$_GET['skeyword']."&";
        }

        header("location:".$url."sort=".$sort);
    }
?>