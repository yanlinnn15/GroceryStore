<?php

    if(isset($_SESSION['wrong'])){?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
                footer: '<a href="">Why do I have this issue?</a>'
            });
        </script>
        
    <?php unset($_SESSION['wrong']);}


?>