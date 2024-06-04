<?php include('partials/header.php');?>
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
                <!-- Row -->
                <?php 
                    $res=mysqli_query($conn,"SELECT * FROM contact"); 
                    while($row=mysqli_fetch_assoc($res)){ ?>

<div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-2 col-md-4">
                        <div class="card">
                            <div class="card-body">
                                    <p>Name: <?php echo $row['cname']; ?></p>
                                    <p>E-mail:  <?php echo $row['email']; ?> </p>
                                    <p>Phone Number:  <?php echo $row['pNum']; ?></p>
                                    <h6 class="card-subtitle"> <?php echo $row['Date']; ?></h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Tab panes -->
                            <div class="card-body">
                                <form class="form-horizontal form-material">
                                    <div class="form-group">
                                        <h4><label>Message</label></h4>
                                        
                                        </div>
										
									<div class="form-group">
                                        <label> <?php echo $row['cmessage']; ?></label>
                                        
                                    </div>
										
                                    <div class="form-group">
                                        <label class="col-md-12">Reply</label>
                                        <div class="col-md-12">
                                            <textarea rows="5" class="form-control form-control-line"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success">Send</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
				
                </div>



                        
            <?php  }

                    

                ?>
		
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
<?php include('partials/footer.php');?>