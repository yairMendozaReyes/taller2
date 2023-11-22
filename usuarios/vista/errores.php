<?php if (isset($_SESSION['mjs'])) {
       $error=$_SESSION['mjs']; ?>
        <script>
           swal({
                title: "!ERROR¡",
                text: "<?php echo $error; ?>",
                icon: "warning",
                button: "OK",
                });
        </script>
<?php
 unset($_SESSION['mjs']);
            }elseif (isset($_SESSION['exito'])) {
                $exito=$_SESSION['exito']; ?>
                <script>
                   swal({
                        title: "Correcto",
                        text: "<?php echo $exito; ?>",
                        icon: "success",
                        button: "OK",
                        });
                </script>
<?php  
          
    unset($_SESSION['exito']);
  }
  ?>