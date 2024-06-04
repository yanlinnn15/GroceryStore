<?php include('partials/header.php'); ?>
<link rel="stylesheet" href="css/review1.css">
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
        <h3 class="text-themecolor">Review & Rating</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="reviewproduct.php">Product Review List</a></li>
            <li class="breadcrumb-item active">Review & Rating</li>
        </ol>
    </div>
  
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<div class="row">
    <!-- column -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
            <div class="container">
            <section class="followers">
      <div class="container">
      <section class="section about-section gray-bg" id="about">
    <div class="container">
        <?php 

        if(isset($_GET['pid'])){

            $pid=$_GET['pid'];
            $res=mysqli_query($conn,"SELECT pName,pImage1,round(avg(rating),2) as rate, count(*) as ttl FROM review,product where product.productID=review.productID and review.productID=$pid group by product.productID");
            $row=mysqli_fetch_assoc($res);
        ?>
        <div class="row align-items-center justify-content-around flex-row-reverse">
            <div class="col-lg-6">
                <div class="about-text">
                    <p>
                    <strong>Name: </strong> <?php echo $row['pName']; ?>
                    </p>
                    <p>
                    <strong>Total Rate: </strong> <?php echo $row['rate']; ?>
                    </p> 
                    <p>
                    <strong>Total Rating & Review:</strong> <?php echo $row['ttl']; ?>
                    </p>
                  
                </div>
            </div>
            <div class="col-lg-5 text-center">
                <div class="about-img">
                    <img src="<?php echo $row['pImage1']; ?>" style="width: 200px;">
                </div>
            </div>
        </div>
    </div>
</section>
       <div class="row">
       
       <div class="container">
<div class="row">
    <div class="col-xl-12">
        <div class="card card-lg">
        	<h6 class="card-header">
            <div class="row">
               <div class="block">
                    <div style="padding: 12px;">
                        <form action="" name="sort" onchange="submit_form()" id="sort" method="post">
                            <select name="sort" id="" class="custom-select">
                                <option value="" selected>All</option>
                                <?php 
                                    for($i=1;$i<=5;$i++){ ?>
                                        <option value="<?php echo $i;?>" <?php if(isset($_GET['sort'])){ if($_GET['sort']==$i){?> selected <?php }} ?>><?php echo $i." star(s)";?></option>
                                    <?php } ?>
                            </select>
                        </form>
                    </div>
                </div>
               </div>
			</h6>							
			<div class="card-body">
				<div class="user-activity">
                <?php 
                    $sql="SELECT * FROM review,customer where productID=$pid and customer.cusID=review.cusID ";
                    $reviewPage=5;

                    if(isset($_GET['sort']) && !empty($_GET['sort'])){
                        
                        $sql.=" and rating='".$_GET['sort']."'";
                        
                    }

                    $res=mysqli_query($conn,$sql); 
                    if($res){
                        $ttl=mysqli_num_rows($res);
                    }else{
                        $ttl=0;
                    }

                    $numPage = ceil($ttl/$reviewPage);

                    if(isset($_GET['page']) && is_numeric($_GET['page'])){
                        $page=$_GET['page'];
                    }else{
                        $page=1;
                    }

                    $starting_page_result=($page-1)*$reviewPage;

                    $sql7=$sql." LIMIT ".$starting_page_result.','.$reviewPage;

                    $res7=mysqli_query($conn,$sql7);
                    
                    ?>
                
                    <?php    while($row=mysqli_fetch_assoc($res7)){ ?>
                    <div class="media">
						<div class="media-img-wrap">
							<div class="avatar avatar-sm">
								<img src="assets/images/avartar.png" alt="user" class="avatar-img rounded-circle">
							</div>
						</div>
						<div class="media-body">
							<div>
								<span class="d-block mb-5"><span class="font-weight-500 text-dark text-capitalize"><?php echo $row['cusLName']; ?> #<?php echo $row['cusID']; ?></span> <span class="pl-5">
                                    <div class="dropdown" style="float: right;">
                                    <button class="dropbtn"><i class="fa fa-ellipsis-v" style="font-size:24px;"></i></button>
                                    <div class="dropdown-content">
                                        <?php
                                            if($row['status']==1){ ?>
                                                <a href="viewreview.php?del&bid=<?php echo $row['reviewID']; ?>&s=0">Block the content</a>
                                            <?php }else{ ?>
                                                <a href="viewreview.php?del&bid=<?php echo $row['reviewID']; ?>&s=1">Enable the content</a>
                                            <?php } ?>
                                    </div>
                                    </div>
                                    <span ><?php echo $row['rtime']; ?></span>
                                    <?php
                                      
                                      $front=intval($row['rating']);
                                      if($row['rating']>$front){
                                          $end2=5;
                                      }else{
                                          $end2=0;
                                      } ?>

                                      <div class="stars-rating">
                                          <div class="star-rating">
                                              <span class="star-<?php echo $front; ?>-<?php echo $end2; ?>"></span>

                                          </div>
                                          <div class="count-star">
                                          </div>
                                      </div></span>
                                <p><span><?php if($row['comment']==""){
                                            echo "No comment";
                                        }else{
                                            echo $row['comment']; } ?>
                                            <?php if($row['status']==0){ ?>
                                                <span style="color: red;">&nbsp;--(Content Blocked)</span>
                                       <?php    } ?>
                                        </label></span></span></p>
								<hr>
                                

                                        <?php
                                            
                                            if($row['reply']!=""){ ?>
                                                <span class="d-block font-13">Replied :
                                                    <?php echo $row['reply']; ?>
                                                    <span style="float: right;"><?php echo $row['retime']; ?></span>

                                        <?php    }else{ ?>
                                            <button class="btn btn-success" data-toggle="modal" data-target="#reply<?php echo $row['reviewID']; ?>">Reply</button>	

                                  <?php      } ?>

                                  <!--Modal Reply -->
                                  <div class="modal fade" id="reply<?php echo $row['reviewID']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Review</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                                <form method="post">
                                                <div class="form-group">
                                                    <label class="col-md-12">Reply Review #<?php echo $row['reviewID']; ?></label>
                                                    <div class="col-md-12">
                                                        <textarea rows="5" class="form-control form-control-line" name="replyc"></textarea>
                                                    </div>
                                                    <input type="hidden" name="rid" value="<?php echo $row['reviewID']; ?>">
                                                </div>                
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="submitreply">Save</button>
                                        </div>
                                        </form>
                                        </div>
                                    </div>
                                    </div>
                                    <!-- End -->
                                     
                            
                                </span>
							</div>
						</div>
					</div>

                  <?php }  
                  if(mysqli_num_rows($res7)<=0){?>
                    <strong style="margin-left:50px;">No result Found!</strong>
                <?php $numPage=1; } ?>
                 <!-- Column -->
                <!-- Row -->
                </div>
                <!-- Pagination -->
                <?php 
                $url="viewreview.php?pid=".$_GET['pid']."&";
                
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
	</div>
</div>
</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <?php
        }else{
            header('pages-error-404.php');
        }
        ?>
            
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->

<?php 
include('partials/footer.php');
include('alert2.php');
?>

<?php
    if(isset($_POST['submitreply'])){
        if(empty($_POST['replyc'])){ ?>
            <script>
            Swal.fire({
                position: 'top-end',
                icon: 'info',
                title: '<?php echo "Write Something"; ?>',
                showConfirmButton: false,
                timer: 1500
            });
            </script>
        <?php }else{
            $reply=mysqli_real_escape_string($conn,$_POST['replyc']);
            $roid=$_POST['rid'];
            $res=mysqli_query($conn,"UPDATE review set reply='$reply',retime=current_timestamp where reviewID=$roid;");
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
            
        <?php header("refresh:0.5");}else{ ?>

            <script>
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: '<?php echo "Something went wrong"; ?>',
                showConfirmButton: false,
                timer: 1500
            });
            </script>

       <?php  }
    }
}
?>
<?php
//block or unblock the review
if (isset($_REQUEST["del"])) 
{
	$id = $_REQUEST["bid"];
    $s= $_REQUEST["s"];
   
    $res1=mysqli_query($conn, "UPDATE review set status=$s where reviewID=$id");
    if($res1){
        $_SESSION['success']="Update Successful!";
    }else{
        $_SESSION['fail']="Something went wrong...";
    }
	
	header("Location: " . $_SERVER["HTTP_REFERER"]);
}
?>

<script>
    function submit_form(){
        var form = document.getElementById("sort");
        form.submit();
    }
</script>

<!-- sort form -->
<?php
    if(isset($_POST['sort'])){

        $sort=$_POST['sort'];
        $url=SITEURL."admin/viewreview.php?pid=".$_GET['pid']."&";


        header("location:".$url."sort=".$sort);
    }
?>