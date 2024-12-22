<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
if (isset($errMsg) && !empty($errMsg)) {
    echo "
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '$errMsg',
            confirmButtonText: 'OK'
        });
    </script>
    ";
}
?>
