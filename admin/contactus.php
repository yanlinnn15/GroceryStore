<?php include('partials/header.php');?>
<script type="text/javascript">

    function confirmation()
    {
        answer = confirm("Do you want to delete this contact?");
        return answer;
    }

</script>

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
            $reply=$_POST['replyc'];
            $roid=$_POST['rid'];
            $res=mysqli_query($conn,"UPDATE contact set status=1 where contactID=$roid");
            if(mysqli_affected_rows($conn)>0){ 

                $res1=mysqli_query($conn,"SELECT * FROM contact  where contactID=$roid");
                $row1=mysqli_fetch_assoc($res1);
                $message=$row1['cmessage'];
                $name=$row1['cname'];
                $to=$row1['email'];
                $subject="Fresh Grocers -- #$roid";
                $message="
                    Hi $name,<br><br>

                    $reply<br><br>

                    Thanks! &#8211; FreshGrocers<br>
                ";
                $headers ="From: ffreshgrocers@gmail.com \r\n";
                $headers = "MIME-Version: 1.0" . "\r\n"; //set content type when sending html email
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                mail($to,$subject,$message,$headers); ?>
                <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '<?php echo "Reply Successful"; ?>',
                    showConfirmButton: false,
                    timer: 1500
                });
                </script>
        <?php }else{ ?>

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
                        <h3 class="text-themecolor">Contact Us</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Contact Us</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
				<?php 
                    $sql="SELECT * FROM contact where contactID!='' ";
                    $contactPage=10;

                    $res=mysqli_query($conn,$sql); 
                    if($res){
                        $ttl=mysqli_num_rows($res);
                    }else{
                        $ttl=0;
                    }

                    $numPage = ceil($ttl/$contactPage);

                    if(isset($_GET['page']) && is_numeric($_GET['page'])){
                        $page=$_GET['page'];
                    }else{
                        $page=1;
                    }

                    $starting_page_result=($page-1)*$contactPage;

                    $sql7=$sql." LIMIT ".$starting_page_result.','.$contactPage;

                    $res7=mysqli_query($conn,$sql7);
                    
                    ?>
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Date</th>
                                                <th>Message</th>
                                                <th>Reply</th>
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
                                                <td><?php echo $row['contactID']?></td>
                                                <td><?php echo $row['cname']?></td>
                                                <td><?php echo $row['email']?></td>
                                                <td><?php echo $row['Date']?></td>
                                                <td><?php echo $row['cmessage']?></td>
                                                <td><?php 

                                                   if($row['status']==0){
                                                    echo "No";

                                                   }else{
                                                       echo "Yes";
                                                   }
                                                
                                                ?></td>
                                                <td>
                                                <?php if($row['status']==0){ ?>
                                                    <button class="btn btn-success" data-toggle="modal" data-target="#reply<?php echo $row['contactID']; ?>">Reply</button>	

                                                <?php } ?>			
                                                <a href="contactus.php?del&bid=<?php echo $row['contactID']; ?>"> <button class="btn btn btn-danger check_out" type="button">Delete</button></a>

                                                <!--Modal Reply -->
                                                <div class="modal fade" id="reply<?php echo $row['contactID']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Reply</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                            <form method="post">
                                                            <div class="form-group">
                                                                <label class="col-md-12">Reply to </label>
                                                                <label class="col-md-12">Email : <?php echo $row['email']?> </label>
                                                                <label class="col-md-12">Name : <?php echo $row['cname']?> </label>
                                                                <div class="col-md-12">
                                                                    <textarea rows="5" class="form-control form-control-line" name="replyc"></textarea>
                                                                </div>
                                                                <input type="hidden" name="rid" value="<?php echo $row['contactID']; ?>">
                                                            </div>                
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" name="submitreply">Send</button>
                                                    </div>
                                                    </form>
                                                    </div>
                                                </div>
                                                </div>
                                                <!-- End -->
                                            </tr>
                                            <?php
											}
											?>

                                           
                                        </tbody>
                                    </table>
                               
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
	$contactid = $_REQUEST["bid"];
   
    $res1=mysqli_query($conn, "delete from contact where contactID = $contactid");
    if($res1){
        $_SESSION['success']="Deleted Successful!";
    }else{
        $_SESSION['fail']="Something went wrong...";
    }
	
	header("Location: " . $_SERVER["HTTP_REFERER"]);
}
?>