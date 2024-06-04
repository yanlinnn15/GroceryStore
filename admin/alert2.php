<?php

if(isset($_SESSION['success'])){?>
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: '<?php echo $_SESSION['success']; ?>',
            showConfirmButton: false,
            timer: 1500
        })
    </script>
<?php unset($_SESSION['success']);}

if(isset($_SESSION['wrong'])){?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong!',
        });
    </script>
    
<?php unset($_SESSION['wrong']);}

if(isset($_SESSION['fail'])){?>
    <script>
         Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: '<?php echo $_SESSION['fail']?>',
            showConfirmButton: false,
            timer: 1500
        })
    </script>

<?php unset($_SESSION['fail']);}




?>