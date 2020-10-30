<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();
?>
<script>
    // alert("Terima Kasih Atas Kunjungannya!");
    document.location = 'login.php';
</script>