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
                        <h3 class="text-themecolor">Customer</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Customer</li>
                        </ol>
                    </div>
                    <!--<div class="col-md-7 align-self-center">
                        <a href="" class="btn waves-effect waves-light btn btn-info pull-right hidden-sm-down"> Add Customer</a>
                    </div>-->
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <?php 
                    $sql="SELECT * FROM customer where cusID!='' ";
                    $customerPage=10;
                    if(isset($_GET['skeyword']) && !empty($_GET['skeyword'])){
                        $sql.=" AND (cusID like '%".$_GET['skeyword']."%' OR cusEmail like '%".$_GET['skeyword']."%' 
                        or cusFName like '%".$_GET['skeyword']."%' 
                        or cusLName like '%".$_GET['skeyword']."%' or 
                        cusGender like '%".$_GET['skeyword']."%' or cusPhoneNo like '%".$_GET['skeyword']."%') ";
                    }
                    if(isset($_GET['sort']) && !empty($_GET['sort'])){
                        switch($_GET['sort']){
                            case '1':
                                $sql.=" and cstatus=1";
                                break;
                            case '2':
                                $sql.=" and cstatus=0";
                                break;
                        }
                    }

                    $res=mysqli_query($conn,$sql); 
                    if($res){
                        $ttl=mysqli_num_rows($res);
                    }else{
                        $ttl=0;
                    }

                    $numPage = ceil($ttl/$customerPage);

                    if(isset($_GET['page']) && is_numeric($_GET['page'])){
                        $page=$_GET['page'];
                    }else{
                        $page=1;
                    }

                    $starting_page_result=($page-1)*$customerPage;

                    $sql7=$sql." LIMIT ".$starting_page_result.','.$customerPage;

                    $res7=mysqli_query($conn,$sql7);
                    
                ?>

                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Customer</h4>
                                <div class="block">
                                    <form action="" method="post">
                                        <div class="wrap">
                                            <div class="search">
                                                <input type="text" class="searchTerm" placeholder="Search customer..." name="skey" <?php if(isset($_GET['skeyword'])){ ?> value="<?php echo $_GET['skeyword'];?>" <?php }?>>
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
                                                <option value="1" <?php if(isset($_GET['sort'])){ if($_GET['sort']==1){?> selected <?php }} ?>>Sort By Active</option>
                                                <option value="2" <?php if(isset($_GET['sort'])){ if($_GET['sort']==2){?> selected <?php }} ?>>Sort By Inactive</option>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
												<th>#</th>
                                                <th>Customer ID</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
												<th>Email</th>
												<th>Phone Number</th>
												<th>Gender</th>
                                                <th>Status</th>
                                                <th>Action</th>
												
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php 
                                                $count=0;
                                                if($res7){ if(mysqli_num_rows($res7)>0){
                                                while($row=mysqli_fetch_assoc($res7)){ ?>

                                            <tr>
                                                <td><?php echo ++$count; ?></td>
                                                <td><?php echo $row['cusID']; ?></td>
                                                <td><?php echo $row['cusFName']; ?></td>
												<td><?php echo $row['cusLName']; ?></td>
												<td><?php echo $row['cusEmail']; ?></td>
												<td><?php echo $row['cusPhoneNo']; ?></td>
												<td><?php echo $row['cusGender']; ?></td>
                                                <td><?php if($row['cstatus']=='1') echo "Active"; else echo "Inactive"; ?></td>
                                                <td>
                                                <a href="viewcus.php?cusid=<?php echo $row['cusID']; ?>"> <button class="btn btn btn-primary check_out" type="button"><i class="fa fa-eye"></i>&nbsp;<i class="fa fa-pencil"></i></button></a>
                                                </td>
                                            </tr>
                                            <?php }}}?> 
                                            <?php 

                                                if(mysqli_num_rows($res7)<=0){?>
                                                    <tr>
                                                        <td></td>
                                                        <td><strong>No result Found!<strong></td>
                                                    </tr>
                                                <?php $numPage=1; } ?>
                                        </tbody>
                                    </table>
                                </div>
                                    <!-- Pagination -->
                                    <?php 
                                    $url="customer.php?";
                                    
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
<?php include('partials/footer.php');?>

<!--<?php 
    if(isset($_SESSION['add'])){?>
    <script>
        swal({
            title: "Admin Added Success",
            icon: "success",
            button: "Ok",
        });
    </script>
<?php unset($_SESSION['add']); }?>

<script>
    $(document).ready(function(){

        $('.dltbtn').on('click',function(){

        swal({
            title: "Are you sure?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) { 

            swal("Delete Succcessful", {
            icon: "success",
            });
        } else {
            swal("Error", {
                icon: "warning",
            });
        }
        });


        })



    });

</script>-->

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
            header("location:".SITEURL."admin/customer.php?skeyword=".$keyw);
        }else{
            header("location:customer.php");
        }
    }
?>

<!-- sort form -->
<?php
    if(isset($_POST['sort'])){

        $sort=$_POST['sort'];
        $url=SITEURL."admin/customer.php?";

        if($_GET['skeyword']){
            $url.="skeyword=".$_GET['skeyword']."&";
        }

        header("location:".$url."sort=".$sort);
    }
?>