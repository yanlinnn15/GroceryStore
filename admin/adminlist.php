<?php include('partials/header.php');?>
<?php 
    if($_SESSION['adminType']=="Admin"){
        header('location: pages-error-404.php');
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
                        <h3 class="text-themecolor">Admin List</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Admin List</li>
                        </ol>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <?php if($_SESSION['adminType']=="SuperAdmin"){?>
                            <a href="addadmin.php" class="btn btn-primary waves-effect waves-light pull-right hidden-sm-down">Add Admin</a>
                        <?php }?>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <?php 
                    $sql="SELECT * FROM admin";
                    $res=mysqli_query($conn,$sql); ?>

                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Admin List</h4>
                                
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
												<th>Email</th>
												<th>Type</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php 
                                                $count=0;
                                                if($res){ if(mysqli_num_rows($res)>0){
                                                while($row=mysqli_fetch_assoc($res)){ ?>

                                            <tr>
                                                <td><?php echo ++$count; ?></td>
                                                <td><?php echo $row['aName']; ?></td>
												<td><?php echo $row['email']; ?></td>
												<td><?php echo $row['adminType']; ?></td>
                                                <td><?php echo $row['aStatus']; ?></td>
                                                <?php if($_SESSION['adminType']=="SuperAdmin"){
                                                    if($row['adminType']=="Admin"){ ?>
                                                <td><a class="btn btn-primary" style="color: white;" href="<?php echo SITEURL;?>admin/editadmin.php?id=<?php echo $row['adminID'];?>"><i class="fa fa-pencil"></i></a>
                                                <button class="btn btn-danger dltbtn" style="color: white;" data-id="<?php echo $row['adminID']; ?>"><i class="fa fa-trash"></i></button></td>
                                                <?php }else{ ?>
                                                    
                                                    <td></td><?php }} else{ ?>
                                                    
                                                    <td></td>
                                                <?php }?>
                                               
                                            </tr>
                                            <?php }}}?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Page Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
<?php 
include('partials/footer.php');
include('alert2.php');
?>

<script>
    $(document).ready(function(){

        $('.dltbtn').on('click',function(){

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true
                })

                swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
                }).then((result) => {
                if (result.isConfirmed) {
                        window.location.href="dltadmin.php?dltid="+$(this).data("id")
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                    'Cancelled',
                    '',
                    'error'
                    )
                }
                });
            });
    });

</script>